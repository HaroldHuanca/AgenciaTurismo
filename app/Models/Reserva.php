<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    /** @use HasFactory<\Database\Factories\ReservaFactory> */
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'paquete_turistico_id',
        'fecha_viaje',
        'num_personas',
        'total_precio',
    ];

    protected $casts = [
        'fecha_viaje' => 'date',
        'total_precio' => 'decimal:2',
    ];
}
