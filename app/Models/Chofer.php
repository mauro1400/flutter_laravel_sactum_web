<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_chofer';

    protected $fillable = [
        'id_persona',
        'celular',
        'pin',
        'estado',
        'created_at',
        'updated_at',
    ];

    // Relación muchos a uno con la tabla "Personas"
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    // Relación uno a muchos con la tabla "Transportes"
    public function transportes()
    {
        return $this->hasMany(Transporte::class, 'id_chofer');
    }
}
