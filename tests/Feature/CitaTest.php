<?php

namespace Tests\Feature;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CitaTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    private function setupBase()
    {
        $user = User::factory()->create();

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id,
        ]);

        $vehiculo = Vehiculo::factory()->create([
            'cliente_id' => $cliente->id,
        ]);

        Servicio::factory()->create(['tiempo' => 60]);

        Estado::create(['nombre_estado' => 'Agendada']);
        Estado::create(['nombre_estado' => 'Cancelada']);
        Estado::create(['nombre_estado' => 'En curso']);
        Estado::create(['nombre_estado' => 'Completada']);

        return compact('user', 'cliente', 'vehiculo');
    }

    #[Test]
    public function cliente_solo_ve_sus_citas()
    {
        $data = $this->setupBase();
        $user = $data['user'];
        $vehiculo = $data['vehiculo'];

        Cita::create([
            'vehiculo_id' => $vehiculo->id,
            'user_id' => $user->id,
            'estado_id' => Estado::first()->id,
            'fecha_cita' => now()->addDay(),
            'hora_cita' => '10:00',
        ]);

        $response = $this->actingAs($user)
            ->get(route('cita.index'));

        $response->assertStatus(200);
    }
}
