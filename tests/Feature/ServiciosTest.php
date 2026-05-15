<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ServiciosTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    #[Test]
    public function test_crear_servicio_correctamente()
    {
        $response = $this->post(route('servicio.store'), [
            'nombre' => 'Cambio de aceite',
            'descripcion' => 'Cambio completo de aceite',
            'tiempo' => 60,
        ]);

        $response->assertRedirect(route('servicio.index'));

        $this->assertDatabaseHas('servicios', [
            'nombre' => 'Cambio de aceite',
        ]);
    }

    #[Test]
    public function test_valida_campos_obligatorios_en_blanco()
    {
        $response = $this->post(route('servicio.store'), []);

        $response->assertSessionHasErrors([
            'nombre',
            'descripcion',
            'tiempo',
        ]);
    }
}
