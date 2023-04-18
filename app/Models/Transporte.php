<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transporte';

    protected $fillable = [
        'id_chofer',
        'modelo',
        'placa',
        'cant_persona',
        'estado',
        'created_at',
        'updated_at',
    ];

    // Relación muchos a uno con la tabla "Choferes"
    public function chofer()
    {
        return $this->belongsTo(Chofer::class, 'id_chofer');
    }

    // Relación muchos a muchos con la tabla "EstudianteTransporte"
    public function estudiantes()
    {
        return $this->belongsToMany(EstudianteTransporte::class, 'estudiante_transportes', 'id_transporte', 'id_estudiante');
    }

    // Relación uno a muchos con la tabla "GpsRegistro"
    public function gpsRegistros()
    {
        return $this->hasMany(GpsRegistro::class, 'id_transporte');
    }
}
