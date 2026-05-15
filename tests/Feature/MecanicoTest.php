<?php

namespace Tests\Feature;

use App\Models\Mecanico;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MecanicoTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    #[Test]
    public function crear_mecanico_correctamente()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('mecanico.store'), [
            'tipo_documento' => 'CC',
            'documento_mecanico' => '1234567890',
            'nombre_mecanico' => 'Juan Perez',
            'telefono_mecanico' => '3001234567',
            'direccion_mecanico' => 'Calle 1234',
        ]);

        $response->assertRedirect(route('mecanico.index'));

        $this->assertDatabaseHas('mecanicos', [
            'documento_mecanico' => '1234567890',
        ]);
    }

    #[Test]
    public function campos_obligatorios_vacios()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('mecanico.store'), []);

        $response->assertSessionHasErrors([
            'tipo_documento',
            'documento_mecanico',
            'nombre_mecanico',
            'telefono_mecanico',
            'direccion_mecanico',
        ]);
    }

    #[Test]
    public function no_permite_documento_duplicado()
    {
        $user = User::factory()->create();

        Mecanico::create([
            'tipo_documento' => 'CC',
            'documento_mecanico' => '1234567890',
            'nombre_mecanico' => 'Juan',
            'telefono_mecanico' => '3001111111',
            'direccion_mecanico' => 'Dirrecion uno',
        ]);

        $response = $this->actingAs($user)->post(route('mecanico.store'), [
            'tipo_documento' => 'CC',
            'documento_mecanico' => '1234567890',
            'nombre_mecanico' => 'Pedro',
            'telefono_mecanico' => '3009999999',
            'direccion_mecanico' => 'Dirrecion dos',
        ]);

        $response->assertSessionHasErrors(['documento_mecanico']);
    }

    #[Test]
    public function actualizar_mecanico_correctamente()
    {
        $user = User::factory()->create();

        $mecanico = Mecanico::create([
            'tipo_documento' => 'CC',
            'documento_mecanico' => '1234567890',
            'nombre_mecanico' => 'Original',
            'telefono_mecanico' => '3000000000',
            'direccion_mecanico' => 'Dir',
        ]);

        $response = $this->actingAs($user)->put(route('mecanico.update', $mecanico->id), [
            'tipo_documento' => 'CC',
            'documento_mecanico' => '1234567890',
            'nombre_mecanico' => 'Actualizado',
            'telefono_mecanico' => '3001111111',
            'direccion_mecanico' => 'Nueva actualizada',
        ]);

        $response->assertRedirect(route('mecanico.index'));

        $this->assertDatabaseHas('mecanicos', [
            'id' => $mecanico->id,
            'nombre_mecanico' => 'Actualizado',
        ]);
    }

    #[Test]
    public function listar_mecanicos_existentes()
    {
        $user = User::factory()->create();

        Mecanico::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('mecanico.index'));

        $response->assertStatus(200);

        $response->assertViewHas('mecanicos');
    }

    #[Test]
    public function buscar_mecanico_por_documento()
    {
        $user = User::factory()->create();

        $mecanico = Mecanico::factory()->create([
            'documento_mecanico' => '1234567890',
            'nombre_mecanico' => 'Juan Perez',
        ]);

        $response = $this->actingAs($user)
            ->get(route('mecanico.index', [
                'buscar' => '1234567890',
            ]));

        $response->assertStatus(200);

        $response->assertSee('1234567890');
    }
}
