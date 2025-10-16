<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EmpleadoDatabaseTest extends TestCase 
{
    use RefreshDatabase;

    #[Test]
    public function se_puede_conectar_y_consultar_empleados()
    {
        $this->assertTrue(DB::connection()->getPdo() !== null, 'No se pudo establecer conexión a la base de datos');

        try {
            $empleados = DB::table('empleados')->get();
            $this->assertIsObject($empleados, 'La consulta no devolvió un objeto válido');
        } catch (\Exception $e) {
            $this->fail("No se pudo consultar la tabla empleados: " . $e->getMessage());
        }
    }
}