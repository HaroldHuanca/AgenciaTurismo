@extends('layouts.app')

@section('title', 'Dashboard - Agencia de Turismo')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Bienvenido, {{ Auth::user()->name }}</h5>
            </div>
            <div class="card-body">
                <p>Has iniciado sesión correctamente en el sistema de la agencia de turismo.</p>
                
                <div class="row mt-4">
                    <div class="col-md-3 mb-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h6>Total Clientes</h6>
                                <h3>{{ App\Models\Cliente::count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h6>Paquetes Activos</h6>
                                <h3>{{ App\Models\PaqueteTuristico::count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h6>Empleados</h6>
                                <h3>{{ App\Models\Empleado::count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <h6>Proveedores</h6>
                                <h3>{{ App\Models\Proveedor::count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection