@extends('layouts.app')

@section('title', 'Paquete: ' . $paquete->nombre)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalles del Paquete Turístico</h1>
        <div>
            <a href="{{ route('paquetes.edit', $paquete) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('paquetes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Información del Paquete #{{ $paquete->id }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="text-primary">{{ $paquete->nombre }}</h4>
                            
                            @if($paquete->descripcion)
                                <div class="mb-4">
                                    <h6 class="text-muted">Descripción:</h6>
                                    <p class="card-text">{{ $paquete->descripcion }}</p>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted">Información General</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Precio:</th>
                                            <td><span class="h5 text-success fw-bold">${{ number_format($paquete->precio, 2) }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Destino:</th>
                                            <td>
                                                @if($paquete->destino)
                                                    <span class="badge bg-info fs-6">{{ $paquete->destino }}</span>
                                                @else
                                                    <span class="text-muted">No especificado</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Duración:</th>
                                            <td>
                                                @if($paquete->duracion)
                                                    {{ $paquete->duracion }}
                                                @else
                                                    <span class="text-muted">No especificado</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">Detalles del Viaje</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Fecha Inicio:</th>
                                            <td>
                                                @if($paquete->fecha_inicio)
                                                    {{ \Carbon\Carbon::parse($paquete->fecha_inicio)->format('d/m/Y') }}
                                                @else
                                                    <span class="text-muted">No especificada</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Capacidad Máxima:</th>
                                            <td>
                                                @if($paquete->capacidad_maxima)
                                                    <span class="badge bg-warning text-dark">{{ $paquete->capacidad_maxima }} personas</span>
                                                @else
                                                    <span class="text-muted">Ilimitado</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Fecha Registro:</th>
                                            <td>{{ $paquete->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Última Actualización:</th>
                                            <td>{{ $paquete->updated_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-suitcase-rolling fa-3x text-primary mb-3"></i>
                                    <h5>Resumen del Paquete</h5>
                                    <div class="mt-3">
                                        <p class="mb-1"><strong>Precio por persona:</strong></p>
                                        <h4 class="text-success">${{ number_format($paquete->precio, 2) }}</h4>
                                        
                                        @if($paquete->duracion)
                                            <p class="mb-1 mt-3"><strong>Duración:</strong></p>
                                            <p class="h6">{{ $paquete->duracion }}</p>
                                        @endif

                                        @if($paquete->destino)
                                            <p class="mb-1 mt-3"><strong>Destino:</strong></p>
                                            <p class="h6 text-primary">{{ $paquete->destino }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('paquetes.create') }}" class="btn btn-primary">
                                        <i class="fas fa-suitcase-rolling"></i> Nuevo Paquete
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('paquetes.edit', $paquete) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            onclick="confirmDelete('delete-form-{{ $paquete->id }}', '{{ $paquete->nombre }}')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                    <form action="{{ route('paquetes.destroy', $paquete) }}" 
                                          method="POST" 
                                          id="delete-form-{{ $paquete->id }}" 
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
</script>
@endsection