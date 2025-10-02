<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Método para listar clientes
    public function ventas()
    {
        $clientes = Cliente::all(); // Obtiene todos los clientes
        return view('ventas', compact('clientes')); // Envía a la vista
    }
}
