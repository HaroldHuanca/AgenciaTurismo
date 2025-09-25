<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProveedorDatabaseTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function se_puede_conectar_y_consultar_proveedores()
    {
        // Verifica que la conexión a la BD funcione
        $this->assertTrue(DB::connection()->getPdo() !== null, 'No se pudo establecer conexión a la base de datos');

        // Intenta consultar la tabla proveedores
        try {
            $proveedores = DB::table('proveedores')->get();
            $this->assertIsObject($proveedores, 'La consulta no devolvió un objeto válido');
        } catch (\Exception $e) {
            $this->fail("No se pudo consultar la tabla proveedores: " . $e->getMessage());
        }
    }
}
