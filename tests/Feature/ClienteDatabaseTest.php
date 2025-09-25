<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ClienteDatabaseTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function se_puede_conectar_a_la_base_de_datos_y_consultar_clientes()
    {
        // Verifica que la conexión a la BD funcione
        $this->assertTrue(DB::connection()->getPdo() !== null, 'No se pudo establecer conexión a la base de datos');

        // Si la tabla existe, verifica que se puede consultar
        try {
            $clientes = DB::table('clientes')->get();
            $this->assertIsObject($clientes, 'La consulta no devolvió un objeto válido');
        } catch (\Exception $e) {
            $this->fail("No se pudo consultar la tabla clientes: " . $e->getMessage());
        }
    }
}
