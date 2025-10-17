<?php
namespace Tests\Feature;

use App\Models\PaqueteTuristico;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PaqueteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear y autenticar usuario para las pruebas
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    #[Test]
    public function puede_listar_paquetes()
    {
        PaqueteTuristico::factory()->count(3)->create();

        $response = $this->get(route('paquetes.index'));

        $response->assertStatus(200);
        $response->assertViewIs('paquetes.index');
        $response->assertViewHas('paquetes');

        $paquetes = $response->viewData('paquetes');
        $this->assertCount(3, $paquetes->items());
    }

    #[Test]
    public function puede_crear_un_paquete()
    {
        $data = [
            'nombre' => 'Escapada Andina',
            'descripcion' => 'Tour de 5 días por la sierra.',
            'precio' => 299.99,
            'duracion' => '5',
            'destino' => 'Cusco',
            'fecha_inicio' => now()->addMonth()->format('Y-m-d'),
            'capacidad_maxima' => 20,
        ];

        $response = $this->post(route('paquetes.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('paquetes.show', PaqueteTuristico::first()));
        $response->assertSessionHas('success', 'Paquete creado');

        $this->assertDatabaseHas('paquete_turisticos', [
            'nombre' => 'Escapada Andina',
            'precio' => 299.99,
        ]);
    }

    #[Test]
    public function validacion_al_crear_paquete()
    {
        $data = [
            'precio' => 'no-numero', // inválido
            // faltan 'nombre' (requerido) y 'duracion' es opcional
        ];

        $response = $this->post(route('paquetes.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['nombre', 'precio']);
    }

    #[Test]
    public function puede_mostrar_un_paquete()
    {
        $paquete = PaqueteTuristico::factory()->create([
            'nombre' => 'Tour Test',
            'descripcion' => 'Descripción test',
            'precio' => 150.0,
            'duracion' => 3,
        ]);

        $response = $this->get(route('paquetes.show', $paquete));

        $response->assertSuccessful();
        $response->assertViewIs('paquetes.show');

        $paqueteEnVista = $response->viewData('paquete');
        $this->assertEquals($paquete->id, $paqueteEnVista->id);
        $this->assertEquals('Tour Test', $paqueteEnVista->nombre);
    }

    #[Test]
    public function puede_actualizar_un_paquete()
    {
        $paquete = PaqueteTuristico::factory()->create();

        $data = [
            'nombre' => 'Nombre Actualizado',
            'descripcion' => 'Desc actualizada',
            'precio' => 199.5,
            'duracion' => '7',
        ];

        $response = $this->put(route('paquetes.update', $paquete), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('paquetes.show', $paquete));
        $response->assertSessionHas('success', 'Paquete actualizado');

        $this->assertDatabaseHas('paquete_turisticos', [
            'id' => $paquete->id,
            'nombre' => 'Nombre Actualizado',
            'precio' => 199.5,
        ]);
    }

    #[Test]
    public function puede_eliminar_un_paquete()
    {
        $paquete = PaqueteTuristico::factory()->create();

        $response = $this->delete(route('paquetes.destroy', $paquete));

        $response->assertStatus(302);
        $response->assertRedirect(route('paquetes.index'));
        $response->assertSessionHas('success', 'Paquete eliminado');

        $this->assertDatabaseMissing('paquete_turisticos', [
            'id' => $paquete->id,
        ]);
    }

    #[Test]
    public function usuario_no_autenticado_no_puede_acceder()
    {
        // Cerrar sesión
        $this->post('/logout');

        $paquete = PaqueteTuristico::factory()->create();

        $this->get(route('paquetes.index'))->assertRedirect('/login');
        $this->get(route('paquetes.create'))->assertRedirect('/login');
        $this->get(route('paquetes.show', $paquete))->assertRedirect('/login');
        $this->get(route('paquetes.edit', $paquete))->assertRedirect('/login');
        $this->post(route('paquetes.store'), [])->assertRedirect('/login');
        $this->put(route('paquetes.update', $paquete), [])->assertRedirect('/login');
        $this->delete(route('paquetes.destroy', $paquete))->assertRedirect('/login');
    }
}