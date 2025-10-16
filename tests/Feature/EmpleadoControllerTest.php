<?php

namespace Tests\Feature;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EmpleadoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Crear un usuario de prueba y autenticarlo para todas las pruebas
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    #[Test]
    public function puede_listar_empleados()
    {
        // Crea empleados de prueba
        Empleado::factory()->count(3)->create();

        // Llama al endpoint index del controlador
        $response = $this->get(route('empleados.index'));

        // Verifica respuesta exitosa y estructura
        $response->assertStatus(200);
        $response->assertViewIs('empleados.index');
        $response->assertViewHas('empleados');
        
        // Verifica que se muestren los empleados en la vista
        $empleados = $response->viewData('empleados');
        $this->assertCount(3, $empleados->items());
    }

    #[Test]
    public function puede_crear_un_empleado()
    {
        $data = [
            'nombre' => 'Angelo',
            'rol' => 'Desarrollador', // Campo requerido según tu controlador
            'email' => 'angelo.ccama@example.com',
            'comision' => 10.5,
        ];

        $response = $this->post(route('empleados.store'), $data);

        $response->assertStatus(302); // Redirección tras crear
        $response->assertRedirect(route('empleados.show', Empleado::first()));
        $response->assertSessionHas('success', 'Empleado creado');
        
        $this->assertDatabaseHas('empleados', [
            'email' => 'angelo.ccama@example.com',
            'nombre' => 'Angelo',
            'rol' => 'Desarrollador',
        ]);
    }

    #[Test]
    public function validacion_al_crear_empleado()
    {
        // Datos inválidos (faltan campos requeridos)
        $data = [
            'email' => 'email-invalido', // Email inválido
            // Faltan 'nombre' y 'rol' que son requeridos
        ];

        $response = $this->post(route('empleados.store'), $data);

        $response->assertStatus(302); // Redirección por error de validación
        $response->assertSessionHasErrors(['nombre', 'rol', 'email']);
    }

    #[Test]
    public function puede_mostrar_un_empleado()
    {
        // Crear un empleado de prueba con datos específicos
        $empleado = Empleado::factory()->create([
            'nombre' => 'Test Empleado',
            'email' => 'test.empleado@example.com',
            'rol' => 'Desarrollador',
            'comision' => 15.0
        ]);

        // Intentar ver el empleado
        $response = $this->get(route('empleados.show', $empleado));

        // Verificar la respuesta
        $response->assertSuccessful();
        $response->assertViewIs('empleados.show');
        
        // Verificar que el empleado en la vista es el correcto
        $empleadoEnVista = $response->viewData('empleado');
        $this->assertEquals($empleado->id, $empleadoEnVista->id);
        $this->assertEquals('Test Empleado', $empleadoEnVista->nombre);
    }

    #[Test]
    public function puede_actualizar_un_empleado()
    {
        $empleado = Empleado::factory()->create();
        $data = [
            'nombre' => 'Nombre Actualizado',
            'rol' => 'Rol Actualizado', // Campo requerido
            'email' => 'nuevo.email@example.com',
            'comision' => 15.0,
        ];

        $response = $this->put(route('empleados.update', $empleado), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('empleados.show', $empleado));
        $response->assertSessionHas('success', 'Empleado actualizado');
        
        $this->assertDatabaseHas('empleados', [
            'id' => $empleado->id,
            'nombre' => 'Nombre Actualizado',
            'rol' => 'Rol Actualizado',
            'email' => 'nuevo.email@example.com',
        ]);
    }

    #[Test]
    public function puede_eliminar_un_empleado()
    {
        $empleado = Empleado::factory()->create();

        $response = $this->delete(route('empleados.destroy', $empleado));

        $response->assertStatus(302);
        $response->assertRedirect(route('empleados.index'));
        $response->assertSessionHas('success', 'Empleado eliminado');
        
        $this->assertDatabaseMissing('empleados', [
            'id' => $empleado->id,
        ]);
    }

    #[Test]
    public function usuario_no_autenticado_no_puede_acceder()
    {
        // Cerrar sesión
        $this->post('/logout');

        $empleado = Empleado::factory()->create();

        // Intentar acceder a diferentes rutas sin autenticación
        $this->get(route('empleados.index'))->assertRedirect('/login');
        $this->get(route('empleados.create'))->assertRedirect('/login');
        $this->get(route('empleados.show', $empleado))->assertRedirect('/login');
        $this->get(route('empleados.edit', $empleado))->assertRedirect('/login');
        $this->post(route('empleados.store'), [])->assertRedirect('/login');
        $this->put(route('empleados.update', $empleado), [])->assertRedirect('/login');
        $this->delete(route('empleados.destroy', $empleado))->assertRedirect('/login');
    }
}