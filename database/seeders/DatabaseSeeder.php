<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\PaqueteTuristico;
use App\Models\Destino;
use App\Models\Proveedor;
use App\Models\Reserva;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primero creamos datos independientes
        Cliente::factory(15)->create();
        Empleado::factory(5)->create();
        PaqueteTuristico::factory(8)->create();
        Destino::factory(10)->create();
        Proveedor::factory(5)->create();

        // Luego las reservas (dependen de clientes y paquetes)
        Reserva::factory(20)->create();
    }
}
