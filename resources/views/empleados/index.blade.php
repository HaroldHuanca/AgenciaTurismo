@extends('layouts.app')

@section('title', 'Gestión de Empleados')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Empleados</h1>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Nuevo Empleado
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Empleados</h6>
        </div>
        <div class="card-body">
            @if($empleados->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Email</th>
                                <th>Comisión</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->id }}</td>
                                <td>
                                    <strong>{{ $empleado->nombre }}</strong>
                                </td>
                                <td>
                                    @if($empleado->rol)
                                        <span class="badge bg-primary">{{ $empleado->rol }}</span>
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($empleado->email)
                                        <a href="mailto:{{ $empleado->email }}" class="text-decoration-none">
                                            {{ $empleado->email }}
                                        </a>
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($empleado->comision)
                                        <span class="badge bg-success">{{ $empleado->comision }}%</span>
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('empleados.show', $empleado) }}" 
                                           class="btn btn-info btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('empleados.edit', $empleado) }}" 
                                           class="btn btn-warning btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('empleados.destroy', $empleado) }}" 
                                              method="POST" 
                                              id="delete-form-{{ $empleado->id }}" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="confirmDelete('delete-form-{{ $empleado->id }}', '{{ $empleado->nombre }}')"
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
                        Mostrando {{ $empleados->firstItem() }} a {{ $empleados->lastItem() }} de {{ $empleados->total() }} registros
                    </div>
                    {{ $empleados->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay empleados registrados</h4>
                    <p class="text-muted">Comienza agregando tu primer empleado.</p>
                    <a href="{{ route('empleados.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Agregar Primer Empleado
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete(formId, empleadoName) {
        Swal.fire({
            title: '¿Estás seguro?',
            html: `Estás por eliminar al empleado: <strong>"${empleadoName}"</strong><br>Esta acción no se puede deshacer.`,
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