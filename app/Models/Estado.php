<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
    ];

    public function estudianteAsistencias()
    {
        return $this->hasMany(EstudianteAsistencia::class, 'id_estado');
    }

    public function estudianteTransportes()
    {
        return $this->hasMany(EstudianteTransporte::class, 'id_estado');
    }
}
