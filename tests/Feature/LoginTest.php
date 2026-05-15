<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function usuario_puede_iniciar_sesion()
    {
        $user = User::factory()->create([
            'documento' => '123456',
            'password' => bcrypt('12345678'),
            'estado' => 'activo',
        ]);

        $response = $this->post('/login', [
            'documento' => '123456',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/');

        $this->assertAuthenticated();
    }

    #[Test]
    public function no_permite_login_con_password_incorrecta()
    {
        $user = User::factory()->create([
            'documento' => '123456',
            'password' => bcrypt('12345678'),
            'estado' => 'activo',
        ]);

        $response = $this->post('/login', [
            'documento' => '123456',
            'password' => 'incorrecta',
        ]);

        $this->assertGuest();
    }

    #[Test]
    public function no_permite_login_con_documento_no_registrado()
    {
        $response = $this->post('/login', [
            'documento' => '999999',
            'password' => '12345678',
        ]);

        $this->assertGuest();
    }

    #[Test]
    public function valida_campos_obligatorios_login()
    {
        $response = $this->post('/login', []);

        $response->assertSessionHasErrors([
            'documento',
            'password',
        ]);
    }

    #[Test]
    public function usuario_es_redirigido_segun_rol()
    {
        $user = User::factory()->create([
            'documento' => '123456',
            'password' => bcrypt('12345678'),
            'estado' => 'activo',
            'rol' => 'administrador',
        ]);

        $response = $this->post('/login', [
            'documento' => '123456',
            'password' => '12345678',
        ]);

        $response->assertRedirect(); 
    }

    #[Test]
    public function no_permite_login_usuario_inactivo()
    {
        $user = User::factory()->create([
            'documento' => '123456',
            'password' => bcrypt('12345678'),
            'estado' => 'inactivo',
        ]);

        $response = $this->post('/login', [
            'documento' => '123456',
            'password' => '12345678',
        ]);

        $this->assertGuest();
    }
}
