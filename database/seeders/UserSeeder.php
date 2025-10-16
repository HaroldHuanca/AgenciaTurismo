<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@agencia.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Crear usuario de prueba
        User::create([
            'name' => 'Usuario Demo',
            'email' => 'usuario@agencia.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Crear usuarios adicionales con factory
        User::factory(3)->create();

        $this->command->info('Usuarios de prueba creados exitosamente!');
        $this->command->info('Email: admin@tourcrm.com | Password: admin123');
        $this->command->info('Email: demo@tourcrm.com | Password: demo123');
    }
}