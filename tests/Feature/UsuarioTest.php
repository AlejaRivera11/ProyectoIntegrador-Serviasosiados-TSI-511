<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();

        // roles necesarios
        Role::firstOrCreate(['name' => 'administrador']);
        Role::firstOrCreate(['name' => 'cliente']);
        Role::firstOrCreate(['name' => 'recepcionista']);
        $this->withoutMiddleware();
    }

    #[Test]
    public function test_crear_usuario_correctamente()
    {
        $response = $this->post(route('usuario.store'), [
            'documento' => '123456789',
            'correo_cliente' => 'test@gmail.com',
            'password' => '12345678',
            'rol' => 'administrador',
            'estado' => 'activo',
        ]);

        $response->assertRedirect(route('usuario.index'));

        $this->assertDatabaseHas('users', [
            'documento' => '123456789',
            'correo_cliente' => 'test@gmail.com',
        ]);
    }

    #[Test]
    public function test_valida_campos_obligatorios_vacios()
    {
        $response = $this->post(route('usuario.store'), []);

        $response->assertSessionHasErrors([
            'documento',
            'correo_cliente',
            'password',
            'rol',
            'estado',
        ]);
    }

    #[Test]
    public function test_asigna_rol_correctamente()
    {
        $this->post(route('usuario.store'), [
            'documento' => '999999',
            'correo_cliente' => 'rol@test.com',
            'password' => '12345678',
            'rol' => 'administrador',
            'estado' => 'activo',
        ]);

        $user = User::where('documento', '999999')->first();

        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('administrador'));
    }
}
