@extends('layouts.app')

@section('title', 'Cliente: ' . $cliente->nombre . ' ' . $cliente->apellido)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalles del Cliente</h1>
        <div>
            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Información del Cliente #{{ $cliente->id }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Datos Personales</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">ID:</th>
                                    <td>{{ $cliente->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre:</th>
                                    <td>{{ $cliente->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Apellido:</th>
                                    <td>{{ $cliente->apellido }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre Completo:</th>
                                    <td><strong>{{ $cliente->nombre }} {{ $cliente->apellido }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Información de Contacto</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Email:</th>
                                    <td>
                                        @if($cliente->email)
                                            <a href="mailto:{{ $cliente->email }}" class="text-decoration-none">
                                                {{ $cliente->email }}
                                            </a>
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>
                                        @if($cliente->telefono)
                                            <a href="tel:{{ $cliente->telefono }}" class="text-decoration-none">
                                                {{ $cliente->telefono }}
                                            </a>
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fecha Registro:</th>
                                    <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Última Actualización:</th>
                                    <td>{{ $cliente->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Nuevo Cliente
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            onclick="confirmDelete('delete-form-{{ $cliente->id }}', '{{ $cliente->nombre }} {{ $cliente->apellido }}')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                    <form action="{{ route('clientes.destroy', $cliente) }}" 
                                          method="POST" 
                                          id="delete-form-{{ $cliente->id }}" 
                                          class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection