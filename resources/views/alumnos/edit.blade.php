@extends('layouts.app')

@section('content')
    <h1>Editar Alumno</h1>
    <form action="{{ route('alumnos.update', $alumno) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $alumno->nombre) }}">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido', $alumno->apellido) }}">
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}">
            @error('fecha_nacimiento')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="number" name="dni" id="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni', $alumno->dni ?? '') }}">
            @error('dni')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="activo">Activo</label>
            <select name="activo" id="activo" class="form-control">
                <option value="1" {{ $alumno->activo ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$alumno->activo ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $alumno->email }}">
        </div>
        <div class="form-group">
            <label for="curso_id">Curso</label>
            <select name="curso_id" id="curso_id" class="form-control">
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $alumno->curso_id == $curso->id ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    </form>
@endsection