<?php

namespace App\Http\Controllers;

use App\Models\PaqueteTuristico;
use Illuminate\Http\Request;

class PaqueteTuristicoController extends Controller
{
    public function index()
    {
        $paquetes = PaqueteTuristico::paginate(15);
        return view('paquetes.index', compact('paquetes'));
    }

    public function create()
    {
        return view('paquetes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'duracion' => 'nullable|string',
            'destino' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'capacidad_maxima' => 'nullable|integer',
        ]);

        $paquete = PaqueteTuristico::create($data);

        return redirect()->route('paquetes.show', $paquete)->with('success', 'Paquete creado');
    }

    public function show(PaqueteTuristico $paquete)
    {
        return view('paquetes.show', compact('paquete'));
    }

    public function edit(PaqueteTuristico $paquete)
    {
        return view('paquetes.edit', compact('paquete'));
    }

    public function update(Request $request, PaqueteTuristico $paquete)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'duracion' => 'nullable|string',
            'destino' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'capacidad_maxima' => 'nullable|integer',
        ]);

        $paquete->update($data);

        return redirect()->route('paquetes.show', $paquete)->with('success', 'Paquete actualizado');
    }

    public function destroy(PaqueteTuristico $paquete)
    {
        $paquete->delete();
        return redirect()->route('paquetes.index')->with('success', 'Paquete eliminado');
    }
}
