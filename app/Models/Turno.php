<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_turno';

    protected $fillable = [
      'turno',
      'hrs_inicio',
      'min_inicio',
      'hrs_fin',
      'min_fin',
      'estado',
    ];
}
