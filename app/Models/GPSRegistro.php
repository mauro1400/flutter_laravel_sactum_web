<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GPSRegistro extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_gps_registro';
    protected $fillable = [
        'id_transporte',
        'lat',
        'lng',
        'registro',
        'estado',
    ];

    public function transporte()
    {
        return $this->belongsTo(Transporte::class, 'id_transporte');
    }
}
