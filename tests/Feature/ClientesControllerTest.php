<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Cliente;
use App\Models\User;

class ClientesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/clientes', [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'telefono' => '123456789',
        ]);
        $response->assertStatus(302); // Redirección tras crear
        $this->assertDatabaseHas('clientes', [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
        ]);
    }

    public function test_show_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $cliente = Cliente::factory()->create();
        $response = $this->get("/clientes/{$cliente->id}");
        $response->assertStatus(200);
        $response->assertSee($cliente->nombre);
    }

    public function test_edit_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $cliente = Cliente::factory()->create();
        $response = $this->get("/clientes/{$cliente->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($cliente->nombre);
    }

    public function test_update_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $cliente = Cliente::factory()->create();
        $response = $this->put("/clientes/{$cliente->id}", [
            'nombre' => 'Carlos',
            'apellido' => $cliente->apellido,
            'email' => $cliente->email,
            'telefono' => $cliente->telefono,
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'nombre' => 'Carlos',
        ]);
    }

    public function test_destroy_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $cliente = Cliente::factory()->create();
        $response = $this->delete("/clientes/{$cliente->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('clientes', [
            'id' => $cliente->id,
        ]);
    }
}
