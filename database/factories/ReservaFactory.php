<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaqueteTuristico;
use App\Models\Cliente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paquete = PaqueteTuristico::inRandomOrder()->first() ?? PaqueteTuristico::factory()->create();
        $numPersonas = $this->faker->numberBetween(1, 5);

        return [
            'cliente_id' => Cliente::inRandomOrder()->first()->id ?? Cliente::factory()->create()->id,
            'paquete_turistico_id' => $paquete->id,
            'fecha_viaje' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            'num_personas' => $numPersonas,
            'total_precio' => $paquete->precio * $numPersonas,
        ];
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function paqueteTuristico()
    {
        return $this->belongsTo(PaqueteTuristico::class);
    }

}
