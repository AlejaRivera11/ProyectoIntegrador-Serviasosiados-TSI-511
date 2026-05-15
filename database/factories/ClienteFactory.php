<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tipo_documento' => 'CC',
            'documento' => $this->faker->unique()->numerify('##########'),
            'nombre_cliente' => $this->faker->name(),
            'telefono_cliente' => $this->faker->numerify('3#########'),
            'correo_cliente' => $this->faker->unique()->safeEmail(),
            'direccion_cliente' => $this->faker->address(),
            'user_id' => User::factory(),
        ];
    }
}