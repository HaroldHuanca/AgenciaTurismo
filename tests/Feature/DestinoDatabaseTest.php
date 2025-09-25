<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestinoDatabaseTest extends TestCase
{
     use RefreshDatabase;

    #[Test]
    public function se_puede_conectar_y_consultar_destinos()
    {
        // Verifica que la conexión a la BD funcione
        $this->assertTrue(DB::connection()->getPdo() !== null, 'No se pudo establecer conexión a la base de datos');

        // Intenta consultar la tabla destinos
        try {
            $destinos = DB::table('destinos')->get();
            $this->assertIsObject($destinos, 'La consulta no devolvió un objeto válido');
        } catch (\Exception $e) {
            $this->fail("No se pudo consultar la tabla destinos: " . $e->getMessage());
        }
    }
}
