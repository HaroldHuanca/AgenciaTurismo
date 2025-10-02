<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Método para listar clientes
    public function index()
    {
        $clientes = Cliente::all(); // Obtiene todos los clientes
        return view('clientes.index', compact('clientes')); // Envía a la vista
    }
}
