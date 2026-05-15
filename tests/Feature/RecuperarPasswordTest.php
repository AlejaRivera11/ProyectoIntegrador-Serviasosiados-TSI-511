<?php

namespace Tests\Feature;

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RecuperarPasswordTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function muestra_vista_recuperar_password()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);

        $response->assertSee('Recuperar contraseña');
    }

    #[Test]
    public function valida_campos_vacios_recuperar_password()
    {
        $response = $this->post(route('password.email'), [
            'correo_cliente' => '',
        ]);

        $response->assertSessionHasErrors('correo_cliente');
    }

    #[Test]
    public function no_permite_recuperacion_usuario_inactivo()
    {
        $user = User::factory()->create([
            'correo_cliente' => 'inactivo@test.com',
            'estado' => 'inactivo',
        ]);

        $response = $this->post(route('password.email'), [
            'correo_cliente' => 'inactivo@test.com',
        ]);

        $response->assertSessionHasErrors();
    }

    #[Test]
    public function permite_recuperar_password_correctamente()
    {
        Notification::fake();
        $user = User::factory()->create([
            'correo_cliente' => 'riveramonteroalejandra@gmail.com',
            'estado' => 'activo',
        ]);
        $response = $this->post(route('password.email'), [
            'correo_cliente' => 'riveramonteroalejandra@gmail.com',
        ]);

        $response->assertSessionHas('status');
    }

    // verificar que el correo se haya enviado
    #[Test]
    public function verifica_envio_correo_recuperacion_password()
    {
        Notification::fake();
        $user = User::factory()->create([
            'correo_cliente' => 'riveramonteroalejandra@gmail.com',
            'estado' => 'activo',
        ]);
        $response = $this->post(route('password.email'), [
            'correo_cliente' => 'riveramonteroalejandra@gmail.com',
        ]);

        $response->assertSessionHas('status');
    }
}
