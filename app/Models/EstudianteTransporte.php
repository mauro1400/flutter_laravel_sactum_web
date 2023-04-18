<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteTransporte extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_estudiante_transporte';
    protected $fillable = [
        'id_estudiante',
        'id_transporte',
        'id_estado',
        'fecha_inicio',
        'fecha_final',
        'estado',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }

    public function transporte()
    {
        return $this->belongsTo(Transporte::class, 'id_transporte');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function asistencias()
    {
        return $this->hasMany(EstudianteAsistencia::class, 'id_estudiante_transporte');
    }
}
