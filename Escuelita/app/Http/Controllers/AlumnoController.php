<?php

 namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller {
    public function index() {
        $alumnos = Alumno::all();
        return view('alumnos.index', compact('alumnos'));
    }

    public function create() {
        return view('alumnos.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:alumnos',
            'fecha_nacimiento' => 'required|date',
            'ciudad' => 'required|string|max:255',
        ]);

        Alumno::create($request->all());
        return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente');
    }

    public function show(Alumno $alumno) {
        return view('alumnos.show', compact('alumno'));
    }

    public function edit(Alumno $alumno) {
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, Alumno $alumno) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:alumnos,correo,'.$alumno->id,
            'fecha_nacimiento' => 'required|date',
            'ciudad' => 'required|string|max:255',
        ]);

        $alumno->update($request->all());
        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente');
    }

    public function destroy(Alumno $alumno) {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente');
    }
}