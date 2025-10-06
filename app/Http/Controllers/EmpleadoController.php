<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::paginate(15);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'comision' => 'nullable|numeric',
        ]);

        $empleado = Empleado::create($data);

        return redirect()->route('empleados.show', $empleado)->with('success', 'Empleado creado');
    }

    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'rol' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'comision' => 'nullable|numeric',
        ]);

        $empleado->update($data);

        return redirect()->route('empleados.show', $empleado)->with('success', 'Empleado actualizado');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado');
    }
}
