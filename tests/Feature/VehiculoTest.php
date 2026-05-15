<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VehiculoTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    #[Test]
    public function registrar_vehiculo_correctamente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->post(route('vehiculo.store'), [
            'placa' => 'ABC123',
            'marca' => 'Toyota',
            'modelo' => '2020',
            'referencia' => 'Hilux',
            'color' => 'Blanco',
            'kilometraje' => 50000,
            'cliente_id' => $cliente->documento,
        ]);

        $response->assertRedirect(route('vehiculo.index'));

        $this->assertDatabaseHas('vehiculos', [
            'placa' => 'ABC123',
            'cliente_id' => $cliente->id,
        ]);
    }

    #[Test]
    public function valida_campos_obligatorios_vacios()
    {

        $response = $this->post(route('vehiculo.store'), []);

        $response->assertSessionHasErrors([
            'placa',
            'marca',
            'modelo',
            'referencia',
            'color',
            'kilometraje',
            'cliente_id',
        ]);
    }

    #[Test]
    public function no_permite_placa_duplicada()
    {
        $cliente = Cliente::factory()->create();

        Vehiculo::factory()->create([
            'placa' => 'ABC123',
            'cliente_id' => $cliente->id,
        ]);

        $response = $this->post(route('vehiculo.store'), [
            'placa' => 'ABC123',
            'marca' => 'Toyota',
            'modelo' => '2020',
            'referencia' => 'Hilux',
            'color' => 'Blanco',
            'kilometraje' => 50000,
            'cliente_id' => $cliente->documento,
        ]);

        $response->assertSessionHasErrors('placa');
    }

    #[Test]
    public function listar_vehiculos()
    {
        Vehiculo::factory()->create([
            'placa' => 'XYZ999',
        ]);

        $response = $this->get(route('vehiculo.index'));

        $response->assertStatus(200);
        $response->assertSee('XYZ999');
    }

    #[Test]
    public function buscar_vehiculo_por_placa()
    {
        Vehiculo::factory()->create([
            'placa' => 'AAA111',
        ]);

        $response = $this->get(route('vehiculo.index'));

        $response->assertStatus(200);
        $response->assertSee('AAA111');
    }

    #[Test]
    public function cliente_solo_ve_sus_vehiculos()
    {
        $user = User::factory()->create();

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id,
        ]);

        Vehiculo::factory()->create([
            'cliente_id' => $cliente->id,
        ]);

        $this->actingAs($user);

        $response = $this->get(route('perfilCliente.misVehiculos'));

        $response->assertStatus(200);
    }
}
