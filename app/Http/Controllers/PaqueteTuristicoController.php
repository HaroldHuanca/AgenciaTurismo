<?php

namespace App\Http\Controllers;

use App\Models\PaqueteTuristico; // Asegúrate de tener el modelo
use Illuminate\Http\Request;

class PaqueteTuristicoController extends Controller
{
    // Muestra la lista de paquetes
    public function index()
    {
        $paquetes = PaqueteTuristico::all();
        return view('paquetes-turisticos.index', compact('paquetes'));
    }

    // Muestra el formulario de creación
    public function create()
    {
        $paquetes = PaqueteTuristico::all(); // También pasamos la lista para que no dé error en el @foreach
        return view('paquetes-turisticos.index', [
            'accion' => 'create',
            'paquetes' => $paquetes // La tabla no se mostrará, pero la variable debe existir
        ]);
    }

    // Almacena un nuevo paquete
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'duracion' => 'required|integer',
            'destino' => 'required',
            'fecha_inicio' => 'required|date',
            'capacidad_maxima' => 'required|integer',
            'estado' => 'required|boolean',
        ]);

        PaqueteTuristico::create($request->all());

        return redirect()->route('paquetes-turisticos.index')
                         ->with('success', 'Paquete turístico creado exitosamente.');
    }

    // Muestra los detalles de un paquete
    public function show(PaqueteTuristico $paquetes_turistico) // Laravel 8+ usa el nombre de la variable del resource
    {
        $paquetes = PaqueteTuristico::all();
        return view('paquetes-turisticos.index', [
            'accion' => 'show',
            'paqueteTuristico' => $paquetes_turistico,
            'paquetes' => $paquetes
        ]);
    }

    // Muestra el formulario de edición
    public function edit(PaqueteTuristico $paquetes_turistico)
    {
        $paquetes = PaqueteTuristico::all();
        return view('paquetes-turisticos.index', [
            'accion' => 'edit',
            'paqueteTuristico' => $paquetes_turistico,
            'paquetes' => $paquetes
        ]);
    }

    // Actualiza un paquete
    public function update(Request $request, PaqueteTuristico $paquetes_turistico)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'duracion' => 'required|integer',
            'destino' => 'required',
            'fecha_inicio' => 'required|date',
            'capacidad_maxima' => 'required|integer',
            'estado' => 'required|boolean',
        ]);

        $paquetes_turistico->update($request->all());

        return redirect()->route('paquetes-turisticos.index')
                         ->with('success', 'Paquete turístico actualizado exitosamente.');
    }

    // Elimina un paquete
    public function destroy(PaqueteTuristico $paquetes_turistico)
    {
        $paquetes_turistico->delete();

        return redirect()->route('paquetes-turisticos.index')
                         ->with('success', 'Paquete turístico eliminado exitosamente.');
    }
}