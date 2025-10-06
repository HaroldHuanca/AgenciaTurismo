@extends('layouts.app')

@section('title', 'Gestión de Proveedores')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Proveedores</h1>
        <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Proveedor
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Proveedores</h6>
        </div>
        <div class="card-body">
            @if($proveedores->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Contacto</th>
                                <th>Comisión Agencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedores as $proveedor)
                            <tr>
                                <td>{{ $proveedor->id }}</td>
                                <td>
                                    <strong>{{ $proveedor->nombre }}</strong>
                                </td>
                                <td>
                                    @if($proveedor->tipo)
                                        <span class="badge bg-info">{{ $proveedor->tipo }}</span>
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($proveedor->contacto)
                                        {{ $proveedor->contacto }}
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($proveedor->comision_agencia)
                                        <span class="badge bg-success">{{ $proveedor->comision_agencia }}%</span>
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('proveedores.show', $proveedor) }}" 
                                           class="btn btn-info btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('proveedores.edit', $proveedor) }}" 
                                           class="btn btn-warning btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('proveedores.destroy', $proveedor) }}" 
                                              method="POST" 
                                              id="delete-form-{{ $proveedor->id }}" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="confirmDelete('delete-form-{{ $proveedor->id }}', '{{ $proveedor->nombre }}')"
                                                    data-bs-toggle="tooltip" 
                                                    title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Mostrando {{ $proveedores->firstItem() }} a {{ $proveedores->lastItem() }} de {{ $proveedores->total() }} registros
                    </div>
                    {{ $proveedores->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-truck fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay proveedores registrados</h4>
                    <p class="text-muted">Comienza agregando tu primer proveedor.</p>
                    <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Primer Proveedor
                    </a>
                </div>
            @endif
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

    // Inicializar tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection