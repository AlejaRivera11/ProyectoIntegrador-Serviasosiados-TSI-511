<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    #[Test]
    public function registrar_cliente_correctamente()
    {
        Role::create(['name' => 'cliente']);

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('cliente.store'), [
            'tipo_documento' => 'CC',
            'documento' => '123456789',
            'nombre_cliente' => 'Alejandra Rivera',
            'telefono_cliente' => '3001234567',
            'correo_cliente' => 'aleja@gmail.com',
            'direccion_cliente' => 'Cali',
        ]);

        $response->assertRedirect(route('cliente.index'));

        $this->assertDatabaseHas('clientes', [
            'documento' => '123456789',
            'correo_cliente' => 'aleja@gmail.com',
        ]);
    }

    #[Test]
    public function valida_campos_obligatorios_vacios()
    {
        $user = User::factory()->create(); 
        $this->actingAs($user);

        $response = $this->post(route('cliente.store'), []);

        $response->assertSessionHasErrors([
            'tipo_documento',
            'documento',
            'nombre_cliente',
            'telefono_cliente',
            'correo_cliente',
            'direccion_cliente',
        ]);
    }

    #[Test]
    public function no_permite_documento_duplicado()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Cliente::factory()->create([
            'documento' => '123456789',
        ]);

        $response = $this->post(route('cliente.store'), [
            'tipo_documento' => 'CC',
            'documento' => '123456789',
            'nombre_cliente' => 'Cliente Duplicado',
            'telefono_cliente' => '3001234567',
            'correo_cliente' => 'duplicado@test.com',
            'direccion_cliente' => 'Cali',
        ]);

        $response->assertSessionHasErrors('documento');
    }

    #[Test]
    public function listar_cliente_existente()
    {
        Cliente::factory()->create([
            'nombre_cliente' => 'Alejandra Rivera',
        ]);

        $response = $this->get(route('cliente.index'));

        $response->assertStatus(200);

        $response->assertSee('Alejandra Rivera');
    }

    #[Test]
    public function buscar_cliente_por_documento()
    {
        Cliente::factory()->create([
            'documento' => '123456789',
            'nombre_cliente' => 'Cliente Buscado',
        ]);

        $response = $this->get(route('cliente.index'), [
            'documento' => '123456789',
        ]);

        $response->assertStatus(200);

        $response->assertSee('Cliente Buscado');
    }

    #[Test]
    public function actualizar_cliente_con_campos_vacios()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->put(route('cliente.update', $cliente->id), []);

        $response->assertSessionHasErrors([
            'tipo_documento',
            'documento',
            'nombre_cliente',
            'telefono_cliente',
            'correo_cliente',
            'direccion_cliente',
        ]);
    }

    #[Test]
    public function actualizar_cliente_con_documento_repetido()
    {
        Cliente::factory()->create([
            'documento' => '123456789',
        ]);

        $cliente = Cliente::factory()->create([
            'documento' => '987654321',
        ]);

        $response = $this->put(route('cliente.update', $cliente->id), [
            'tipo_documento' => 'CC',
            'documento' => '123456789',
            'nombre_cliente' => 'Cliente',
            'telefono_cliente' => '3001234567',
            'correo_cliente' => 'cliente@test.com',
            'direccion_cliente' => 'Cali',
        ]);

        $response->assertSessionHasErrors('documento');
    }

    #[Test]
    public function actualizar_cliente_con_correo_repetido()
    {
        Cliente::factory()->create([
            'correo_cliente' => 'correo@test.com',
        ]);

        $cliente = Cliente::factory()->create([
            'correo_cliente' => 'otro@test.com',
        ]);

        $response = $this->put(route('cliente.update', $cliente->id), [
            'tipo_documento' => 'CC',
            'documento' => '123456789',
            'nombre_cliente' => 'Cliente',
            'telefono_cliente' => '3001234567',
            'correo_cliente' => 'correo@test.com',
            'direccion_cliente' => 'Cali',
        ]);

        $response->assertSessionHasErrors('correo_cliente');
    }

    #[Test] // actualizar cliente registrar_cliente_correctamente
    public function actualizar_cliente_correctamente()
    {
        $cliente = Cliente::factory()->create([
            'tipo_documento' => 'CC',
            'documento' => '123456789',
            'nombre_cliente' => 'Alejandra Rivera',
            'telefono_cliente' => '3001234567',
            'correo_cliente' => 'aleja@gmail.com',
            'direccion_cliente' => 'Cali',
        ]);

        $response = $this->put(route('cliente.update', $cliente->id), [
            'tipo_documento' => 'CC',
            'documento' => '123456789',
            'nombre_cliente' => 'Alejandra Rivera Actualizada',
            'telefono_cliente' => '3007654321',
            'correo_cliente' => 'aleja@gmail.com',
            'direccion_cliente' => 'Cali',
        ]);

        $response->assertRedirect(route('cliente.index'));
    }
}
