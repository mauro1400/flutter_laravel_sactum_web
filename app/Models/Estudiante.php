<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_estudiante';

    protected $fillable = [
        'id_persona',
        'grado',
        'estado',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function apoderados()
    {
        return $this->hasMany(Apoderado::class, 'id_estudiante');
    }

    public function estudianteTransportes()
    {
        return $this->hasMany(EstudianteTransporte::class, 'id_estudiante');
    }
}
