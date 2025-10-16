<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Hash;

class UnitTestProveedores extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function el_usuario_admin_puede_iniciar_sesion_con_credenciales_reales()
    {
        // Crear un usuario real en la BD de pruebas
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@agencia.com',
            'password' => Hash::make('pasword123'),
        ]);

        // Simular inicio de sesión
        $response = $this->post('/login', [
            'email' => 'admin@agencia.com',
            'password' => 'pasword123',
        ]);

        // Asegurar que redirige a la ruta de inicio
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function se_puede_crear_un_proveedor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/proveedores', [
            'nombre' => 'Agencia Los Andes',
            'tipo' => 'Transporte',
            'contacto' => '987654321',
            'comision_agencia' => 12.5,
        ]);

        $response->assertStatus(302); // Redirección después de crear
        $this->assertDatabaseHas('proveedores', [
            'nombre' => 'Agencia Los Andes',
            'tipo' => 'Transporte',
        ]);
    }

    /** @test */
    public function se_puede_listar_proveedores()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Proveedor::factory()->count(3)->create();

        $response = $this->get('/proveedores');
        $response->assertStatus(200);
        $response->assertSee('proveedores');
    }

    /** @test */
    public function se_puede_actualizar_un_proveedor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $proveedor = Proveedor::factory()->create([
            'nombre' => 'Antiguo Proveedor',
            'tipo' => 'Hospedaje',
        ]);

        $response = $this->put("/proveedores/{$proveedor->id}", [
            'nombre' => 'Proveedor Actualizado',
            'tipo' => 'Turismo',
            'contacto' => '123456789',
            'comision_agencia' => 10.0,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('proveedores', [
            'nombre' => 'Proveedor Actualizado',
            'tipo' => 'Turismo',
        ]);
    }

    /** @test */
    public function se_puede_eliminar_un_proveedor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $proveedor = Proveedor::factory()->create();

        $response = $this->delete("/proveedores/{$proveedor->id}");
        $response->assertStatus(302);

        $this->assertDatabaseMissing('proveedores', [
            'id' => $proveedor->id,
        ]);
    }
}
