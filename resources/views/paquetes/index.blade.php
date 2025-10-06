@extends('layouts.app')

@section('title', 'Gestión de Paquetes Turísticos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Paquetes Turísticos</h1>
        <a href="{{ route('paquetes.create') }}" class="btn btn-primary">
            <i class="fas fa-suitcase-rolling"></i> Nuevo Paquete
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Paquetes Turísticos</h6>
        </div>
        <div class="card-body">
            @if($paquetes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Destino</th>
                                <th>Precio</th>
                                <th>Duración</th>
                                <th>Fecha Inicio</th>
                                <th>Capacidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paquetes as $paquete)
                            <tr>
                                <td>{{ $paquete->id }}</td>
                                <td>
                                    <strong>{{ $paquete->nombre }}</strong>
                                    @if($paquete->descripcion)
                                        <br><small class="text-muted">{{ Str::limit($paquete->descripcion, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($paquete->destino)
                                        <span class="badge bg-info">{{ $paquete->destino }}</span>
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold text-success">${{ number_format($paquete->precio, 2) }}</span>
                                </td>
                                <td>
                                    @if($paquete->duracion)
                                        {{ $paquete->duracion }}
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($paquete->fecha_inicio)
                                        {{ \Carbon\Carbon::parse($paquete->fecha_inicio)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">No especificado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($paquete->capacidad_maxima)
                                        <span class="badge bg-warning text-dark">{{ $paquete->capacidad_maxima }} personas</span>
                                    @else
                                        <span class="text-muted">Ilimitado</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('paquetes.show', $paquete) }}" 
                                           class="btn btn-info btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('paquetes.edit', $paquete) }}" 
                                           class="btn btn-warning btn-sm" 
                                           data-bs-toggle="tooltip" 
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('paquetes.destroy', $paquete) }}" 
                                              method="POST" 
                                              id="delete-form-{{ $paquete->id }}" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="confirmDelete('delete-form-{{ $paquete->id }}', '{{ $paquete->nombre }}')"
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
                        Mostrando {{ $paquetes->firstItem() }} a {{ $paquetes->lastItem() }} de {{ $paquetes->total() }} registros
                    </div>
                    {{ $paquetes->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-suitcase-rolling fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay paquetes turísticos registrados</h4>
                    <p class="text-muted">Comienza agregando tu primer paquete turístico.</p>
                    <a href="{{ route('paquetes.create') }}" class="btn btn-primary">
                        <i class="fas fa-suitcase-rolling"></i> Agregar Primer Paquete
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete(formId, paqueteName) {
        Swal.fire({
            title: '¿Estás seguro?',
            html: `Estás por eliminar el paquete: <strong>"${paqueteName}"</strong><br>Esta acción no se puede deshacer.`,
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