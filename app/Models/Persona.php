<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_persona';

    protected $fillable = [
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'ci',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'celular',
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_persona');
    }

    public function apoderados()
    {
        return $this->hasMany(Apoderado::class, 'id_persona');
    }

    public function choferes()
    {
        return $this->hasMany(Chofer::class, 'id_persona');
    }
}
