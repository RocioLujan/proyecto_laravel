<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Curso;


class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::all();
        return view('alumnos.index', compact('alumnos')); 
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('alumnos.create', compact('cursos'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) > time()) {
                        $fail(__('La fecha de nacimiento no puede ser una fecha futura.'));
                    }
                },
            ],
            'dni' => [
                'required',
                'digits:8',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value < 10000000) {
                        $fail(__('El DNI debe ser mayor o igual a 10000000.'));
                    }
                },
            ],
            'email' => 'required|email|max:255|unique:alumnos,email',
            'activo' => 'required|boolean',
            'curso_id' => 'required|exists:cursos,id',
        ], [
            'fecha_nacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
            'fecha_nacimiento.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.digits' => 'El campo DNI debe tener exactamente 8 dígitos.',
            'dni.numeric' => 'El campo DNI debe ser numérico.',
        ]);
        
    
        Alumno::create($request->all());
        return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente.');
    }

    public function show(Alumno $alumno)
    {
        return view('alumnos.show', compact('alumno'));
    }

    public function show_id(string $id)
    {
        $alumno = Alumno::find($id); 
        return view('alumnos.show', compact('alumno')); 
    }

    public function edit_id(string $id)
    {
        $alumno = Alumno::find($id);
        return view('alumnos.edit', compact('alumno'));
    }
    public function edit(Alumno $alumno)
    {
        $cursos = Curso::all();
        return view('alumnos.edit', compact('alumno', 'cursos'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) > time()) {
                        $fail(__('La fecha de nacimiento no puede ser una fecha futura.'));
                    }
                },
            ],
            'dni' => [
                'required',
                'digits:8',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value < 10000000) {
                        $fail(__('El DNI debe ser mayor o igual a 10000000.'));
                    }
                },
            ],
            'email' => 'required|email|max:255|',
            'activo' => 'required|boolean',
            'curso_id' => 'required|exists:cursos,id',
        ], [
            'fecha_nacimiento.required' => 'El campo fecha de nacimiento es obligatorio.',
            'fecha_nacimiento.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.digits' => 'El campo DNI debe tener exactamente 8 dígitos.',
            'dni.numeric' => 'El campo DNI debe ser numérico.',
        ]);

        $alumno = Alumno::find($id);
        $alumno->update($request->all());
        return redirect()->route('alumnos.index')->with('success', 'Datos del alumno actualizados correctamente.');
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente');
    }
}
