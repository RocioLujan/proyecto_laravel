@extends('layouts.app')

@section('content')
<h1>Crear Alumno</h1>
<form action="{{ route('alumnos.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
            value="{{ old('nombre') }}">
        @error('nombre')
        <small class="text-danger">{{ $message }}</small>

        @enderror
    </div>
    <div class="form-group">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" class="form-control @error('apellido') is-invalid @enderror"
            value="{{ old('apellido') }}">
        @error('apellido')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
            class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}">
        @error('fecha_nacimiento')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="dni">DNI</label>
        <input type="number" name="dni" id="dni" class="form-control @error('dni') is-invalid @enderror"
            value="{{ old('dni', $alumno->dni ?? '') }}">
        @error('dni')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="activo">Activo</label>
        <select name="activo" id="activo" class="form-control @error('activo') is-invalid @enderror">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
        @error('activo')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}">
        @error('email')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="curso_id">Curso</label>
        <select name="curso_id" id="curso_id" class="form-control @error('curso_id') is-invalid @enderror">
            <option value="" disabled selected>Seleccione un curso</option>
            @foreach ($cursos as $curso)
            <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
            @endforeach
        </select>
        @error('curso_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
</form>
@endsection

@section('scripts')
<script>
document.getElementById('fecha_nacimiento').addEventListener('change', function() {
    let date = new Date(this.value);
    let day = String(date.getDate()).padStart(2, '0');
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let year = date.getFullYear();
    this.value = `${month}/${day}/${year}`; // Formato mes/día/año para ser procesado
});
</script>
@endsection