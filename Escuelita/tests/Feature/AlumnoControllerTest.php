<?php

namespace Tests\Feature;

use App\Models\Alumno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AlumnoControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function muestra_listado_alumnos(): void
    {
        Alumno::factory()->count(2)->create();

        $response = $this->get('/alumnos');

        $response->assertSee('Lista de Alumnos')
                 ->assertSee(Alumno::first()->nombre)
                 ->assertStatus(200);
    }

    #[Test]
    public function muestra_formulario_crear_alumno(): void
    {
        $response = $this->get('/alumnos/create');

        $response->assertSee('Crear Alumno')
                 ->assertSeeHtml('name="nombre"', false)
                 ->assertStatus(200);
    }

    #[Test]
    public function muestra_formulario_editar_alumno(): void
    {
        $alumno = Alumno::factory()->create();

        $response = $this->get(route('alumnos.edit', $alumno->id));

        $response->assertSee('Editar Alumno')
                 ->assertSeeHtml($alumno->nombre)
                 ->assertSeeHtml($alumno->correo)
                 ->assertSeeHtml($alumno->fecha_nacimiento)
                 ->assertSeeHtml($alumno->ciudad)
                 ->assertStatus(200);
    }

    #[Test]
    public function muestra_detalle_de_un_alumno(): void
    {
        $alumno = Alumno::factory()->create();

        $response = $this->get(route('alumnos.show', $alumno->id));

        $response->assertSee($alumno->nombre)
                 ->assertSee($alumno->correo)
                 ->assertSee($alumno->fecha_nacimiento)
                 ->assertSee($alumno->ciudad)
                 ->assertStatus(200);
    }

    #[Test]
    public function crear_nuevo_alumno(): void
    {
        $alumno = Alumno::factory()->make();

        $response = $this->post('/alumnos', $alumno->toArray());

        $this->assertDatabaseHas('alumnos', $alumno->toArray());
        $response->assertRedirect('/alumnos');
    }

    #[Test]
    public function editar_un_alumno(): void
    {
        $alumno = Alumno::factory()->create();

        $nuevosDatos = [
            'nombre' => 'Nuevo Nombre',
            'correo' => 'nuevo@correo.com',
            'fecha_nacimiento' => '2000-01-01',
            'ciudad' => 'Nueva Ciudad'
        ];

        $response = $this->put(route('alumnos.update', $alumno->id), $nuevosDatos);

        $this->assertDatabaseHas('alumnos', $nuevosDatos);
        $response->assertRedirect('/alumnos');
    }

    #[Test]
    public function eliminar_un_alumno(): void
    {
        $alumno = Alumno::factory()->create();

        $response = $this->delete(route('alumnos.destroy', $alumno->id));

        $this->assertDatabaseMissing('alumnos', ['id' => $alumno->id]);
        $response->assertRedirect('/alumnos');
    }
}
