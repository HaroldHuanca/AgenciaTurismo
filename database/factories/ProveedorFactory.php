<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company(),
            'tipo' => $this->faker->randomElement(['Transporte', 'Hotel', 'Guía', 'Agencia', 'Restaurante']),
            'contacto' => $this->faker->phoneNumber(),
            'comision_agencia' => $this->faker->randomFloat(2, 5, 20), // Comisión entre 5% y 20%
        ];
    }
}
