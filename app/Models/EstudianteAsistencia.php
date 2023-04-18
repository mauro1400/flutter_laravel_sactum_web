<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteAsistencia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_estudiante_asistencia';
    protected $fillable = [
        'id_estudiante_transporte',
        'id_estado',
        'mensaje_padre',
        'estado',
    ];

    public function estudianteTransporte()
    {
        return $this->belongsTo(EstudianteTransporte::class, 'id_estudiante_transporte');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
}
