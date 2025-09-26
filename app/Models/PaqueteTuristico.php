<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteTuristico extends Model
{
    /** @use HasFactory<\Database\Factories\PaqueteTuristicoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion',
        'destino',
        'fecha_inicio',
        'capacidad_maxima',
        'estado',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'fecha_inicio' => 'date',
        'capacidad_maxima' => 'integer',
        'estado' => 'boolean',
    ];
}
