<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserDatabaseTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function se_puede_conectar_y_consultar_usuarios() 
    {
        $this->assertTrue(DB::connection()->getPdo() !== null, 'No se pudo establecer conexión a la base de datos');

        try {
            $users = DB::table('users')->get();
            $this->assertIsObject($users, 'La consulta no devolvió un objeto válido');
        } catch (\Exception $e) {
            $this->fail("No se pudo consultar la tabla users: " . $e->getMessage());
        }
    }
}