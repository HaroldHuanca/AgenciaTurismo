<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'rol' => $this->faker->randomElement(['Administrador', 'Agente de Viajes', 'Soporte', 'Marketing']),
            'email' => $this->faker->unique()->safeEmail(),
            'comision' => $this->faker->randomFloat(2, 0, 20), // Comisión entre 0% y 20%
                      
        ];
    }
}
