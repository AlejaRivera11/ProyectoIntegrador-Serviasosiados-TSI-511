<?php

namespace Database\Factories;

use App\Models\Mecanico;
use Illuminate\Database\Eloquent\Factories\Factory;

class MecanicoFactory extends Factory
{
    protected $model = Mecanico::class;

    public function definition(): array
    {
        return [
            'tipo_documento' => 'CC',
            'documento_mecanico' => $this->faker->unique()->numerify('##########'),
            'nombre_mecanico' => $this->faker->name(),
            'telefono_mecanico' => $this->faker->numerify('3#########'),
            'direccion_mecanico' => $this->faker->address(),
        ];
    }
}
