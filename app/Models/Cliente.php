<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'preferencias',
        'estado',
    ];

    protected $casts = [
        'preferencias' => 'array',
        'estado' => 'boolean',
        'fecha_nacimiento' => 'date',
    ];
}
