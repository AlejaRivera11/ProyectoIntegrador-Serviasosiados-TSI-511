<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculoFactory extends Factory
{
    protected $model = Vehiculo::class;

    public function definition(): array
    {
        return [
            'placa' => $this->faker->unique()->bothify('ABC###'),
            'marca' => $this->faker->randomElement(['Toyota', 'Chevrolet', 'Mazda']),
            'modelo' => $this->faker->year(),
            'referencia' => $this->faker->word(),
            'color' => $this->faker->safeColorName(),
            'kilometraje' => $this->faker->numberBetween(1000, 200000),
            'cliente_id' => Cliente::factory(),
        ];
    }
}
