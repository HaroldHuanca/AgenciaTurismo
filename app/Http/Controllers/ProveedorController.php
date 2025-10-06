<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Especificar el nombre del parámetro de ruta
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function index()
    {
        $proveedores = Proveedor::paginate(15);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:255',
            'comision_agencia' => 'nullable|numeric',
        ]);

        $proveedor = Proveedor::create($data);

        return redirect()->route('proveedores.show', $proveedor)->with('success', 'Proveedor creado');
    }

    public function show(Proveedor $proveedore) // Cambiar a proveedore
    {
        return view('proveedores.show', compact('proveedore'));
    }

    public function edit(Proveedor $proveedore) // Cambiar a proveedore
    {
        return view('proveedores.edit', compact('proveedore'));
    }

    public function update(Request $request, Proveedor $proveedore) // Cambiar a proveedore
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:255',
            'comision_agencia' => 'nullable|numeric',
        ]);

        $proveedore->update($data);

        return redirect()->route('proveedores.show', $proveedore)->with('success', 'Proveedor actualizado');
    }

    public function destroy(Proveedor $proveedore) // Cambiar a proveedore
    {
        $proveedore->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado');
    }
}