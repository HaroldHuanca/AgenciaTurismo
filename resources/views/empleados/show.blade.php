@extends('layouts.app')

@section('title', 'Empleado: ' . $empleado->nombre)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalles del Empleado</h1>
        <div>
            <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Información del Empleado #{{ $empleado->id }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Información Personal</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">ID:</th>
                                    <td>{{ $empleado->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre:</th>
                                    <td><strong>{{ $empleado->nombre }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Rol/Puesto:</th>
                                    <td>
                                        @if($empleado->rol)
                                            <span class="badge bg-primary">{{ $empleado->rol }}</span>
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Información Laboral</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Email:</th>
                                    <td>
                                        @if($empleado->email)
                                            <a href="mailto:{{ $empleado->email }}" class="text-decoration-none">
                                                {{ $empleado->email }}
                                            </a>
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Comisión:</th>
                                    <td>
                                        @if($empleado->comision)
                                            <span class="badge bg-success">{{ $empleado->comision }}%</span>
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fecha Registro:</th>
                                    <td>{{ $empleado->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Última Actualización:</th>
                                    <td>{{ $empleado->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Estadísticas (puedes expandir esto luego) -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Información Adicional</h6>
                                    <p class="card-text text-muted mb-0">
                                        <small>
                                            <i class="fas fa-info-circle"></i> 
                                            Aquí puedes agregar más información del empleado como ventas realizadas, 
                                            historial laboral, etc. en futuras versiones.
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('empleados.create') }}" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i> Nuevo Empleado
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            onclick="confirmDelete('delete-form-{{ $empleado->id }}', '{{ $empleado->nombre }}')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                    <form action="{{ route('empleados.destroy', $empleado) }}" 
                                          method="POST" 
                                          id="delete-form-{{ $empleado->id }}" 
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
</script>
@endsection