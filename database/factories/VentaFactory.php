<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;
use App\Models\Paquete;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cliente = Cliente::inRandomOrder()->first() ?? Cliente::factory()->create();
        $paquete = Paquete::inRandomOrder()->first() ?? Paquete::factory()->create();
        $cantidad = $this->faker->numberBetween(1, 5);

        return [
            'cliente_id'  => $cliente->id,
            'paquete_id'  => $paquete->id,
            'cantidad'    => $cantidad,
            'total'       => $paquete->precio * $cantidad,
            'fecha_venta' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
