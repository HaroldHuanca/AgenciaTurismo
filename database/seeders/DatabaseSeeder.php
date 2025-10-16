<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\PaqueteTuristico;
use App\Models\Destino;
use App\Models\Proveedor;
use App\Models\Reserva;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primero creamos usuarios
        $this->call(UserSeeder::class);
        
        // Luego creamos datos independientes
        User::factory(2)->create();
        Cliente::factory(15)->create();
        Empleado::factory(5)->create();
        PaqueteTuristico::factory(8)->create();
        Proveedor::factory(5)->create();
    }
}
