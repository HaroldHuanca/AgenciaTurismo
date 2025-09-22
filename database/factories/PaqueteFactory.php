<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paquete>
 */
class PaqueteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+3 months');
        $endDate   = (clone $startDate)->modify('+5 days');

        return [
            'nombre'      => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph,
            'precio'      => $this->faker->randomFloat(2, 100, 3000),
            'fecha_inicio'=> $startDate,
            'fecha_fin'   => $endDate,
        ];
    }
}
