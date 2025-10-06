@extends('layouts.app')

@section('title', 'Proveedor: ' . $proveedore->nombre)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalles del Proveedor</h1>
        <div>
            <a href="{{ route('proveedores.edit', $proveedore) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Información del Proveedor #{{ $proveedore->id }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Información General</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">ID:</th>
                                    <td>{{ $proveedore->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre:</th>
                                    <td><strong>{{ $proveedore->nombre }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Tipo:</th>
                                    <td>
                                        @if($proveedore->tipo)
                                            <span class="badge bg-info">{{ $proveedore->tipo }}</span>
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Información Comercial</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Contacto:</th>
                                    <td>
                                        @if($proveedore->contacto)
                                            {{ $proveedore->contacto }}
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Comisión Agencia:</th>
                                    <td>
                                        @if($proveedore->comision_agencia)
                                            <span class="badge bg-success">{{ $proveedore->comision_agencia }}%</span>
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fecha Registro:</th>
                                    <td>{{ $proveedore->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Última Actualización:</th>
                                    <td>{{ $proveedore->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Nuevo Proveedor
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('proveedores.edit', $proveedore) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            onclick="confirmDelete('delete-form-{{ $proveedore->id }}', '{{ $proveedore->nombre }}')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                    <form action="{{ route('proveedores.destroy', $proveedore) }}" 
                                          method="POST" 
                                          id="delete-form-{{ $proveedore->id }}" 
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

@section('scripts')
<script>
    function confirmDelete(formId, proveedorName) {
        Swal.fire({
            title: '¿Estás seguro?',
            html: `Estás por eliminar al proveedor: <strong>"${proveedorName}"</strong><br>Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endsection