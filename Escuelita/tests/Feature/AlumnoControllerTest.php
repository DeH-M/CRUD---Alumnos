<?php

namespace Tests\Feature;

use App\Models\Alumno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlumnoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */ 
    public function muestra_listado_alumnos(): void
    {
        $response = $this->get('/alumnos');
        $response->assertSee('Lista de Alumnos');
        $response->assertStatus(200);
    }

    /** @test */
    public function muestra_formulario_crear_alumno(): void
    {
        $response = $this->get('/alumnos/create');
        $response->assertSee('Crear Alumno')
                 ->assertSeeHtml('name="nombre"', false);
        $response->assertStatus(200);
    }

    /** @test */
    public function crear_nuevo_alumno(): void
    {
        // Dado
        $alumno = Alumno::factory()->make();

        // Acción
        $response = $this->post('/alumnos', $alumno->toArray());

        // Expectativa
        $this->assertDatabaseHas('alumnos', $alumno->toArray());
        $response->assertRedirect('/alumnos');
    }

    /** @test */
    public function muestra_formulario_editar_alumno(): void
    {
        // Dado
        $alumno = Alumno::factory()->create();

        // Acción
        $response = $this->get(route('alumnos.edit', $alumno->id));

        // Expectativa
        $response->assertSee('Editar Alumno')
                 ->assertSeeHtml($alumno->nombre)
                 ->assertSeeHtml($alumno->correo)
                 ->assertSeeHtml($alumno->fecha_nacimiento)
                 ->assertSeeHtml($alumno->ciudad)
                 ->assertStatus(200);
    }
}
