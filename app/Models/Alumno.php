<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model; // Importa el modelo base de Eloquent
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa HasFactory si quieres usar factories

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento', 'dni', 'activo', 'email', 'curso_id'];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucfirst(strtolower($value)); // Primera letra en mayúscula, resto en minúsculas
    }

    // Mutador para el campo 'apellido'
    public function setApellidoAttribute($value)
    {
        $this->attributes['apellido'] = ucfirst(strtolower($value));
    }


    public function curso()
    {
        return $this->belongsTo(Curso::class); // un alumno pertenece a un curso
    }
}
