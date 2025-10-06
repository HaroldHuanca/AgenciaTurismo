@extends('layouts.app')

@section('title', 'Crear Nuevo Paquete Turístico')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear Nuevo Paquete Turístico</h1>
        <a href="{{ route('paquetes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a la lista
        </a>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información del Paquete Turístico</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('paquetes.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Paquete *</label>
                            <input type="text" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre') }}" 
                                   required 
                                   maxlength="255"
                                   placeholder="Ej: Tour Europa Clásica, Aventura en la Selva">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="3" 
                                      placeholder="Describe los detalles del paquete, itinerario, servicios incluidos, etc.">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Opcional - Descripción detallada del paquete</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label">Precio *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           class="form-control @error('precio') is-invalid @enderror" 
                                           id="precio" 
                                           name="precio" 
                                           value="{{ old('precio') }}" 
                                           required 
                                           min="0" 
                                           step="0.01"
                                           placeholder="0.00">
                                    @error('precio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="duracion" class="form-label">Duración</label>
                                <input type="text" 
                                       class="form-control @error('duracion') is-invalid @enderror" 
                                       id="duracion" 
                                       name="duracion" 
                                       value="{{ old('duracion') }}" 
                                       maxlength="50"
                                       placeholder="Ej: 7 días/6 noches, 15 días">
                                @error('duracion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opcional - Duración del viaje</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="destino" class="form-label">Destino</label>
                                <input type="text" 
                                       class="form-control @error('destino') is-invalid @enderror" 
                                       id="destino" 
                                       name="destino" 
                                       value="{{ old('destino') }}" 
                                       maxlength="255"
                                       placeholder="Ej: París, Francia - Cancún, México">
                                @error('destino')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opcional - Destino principal del paquete</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" 
                                       class="form-control @error('fecha_inicio') is-invalid @enderror" 
                                       id="fecha_inicio" 
                                       name="fecha_inicio" 
                                       value="{{ old('fecha_inicio') }}">
                                @error('fecha_inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opcional - Fecha de inicio del paquete</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="capacidad_maxima" class="form-label">Capacidad Máxima</label>
                            <input type="number" 
                                   class="form-control @error('capacidad_maxima') is-invalid @enderror" 
                                   id="capacidad_maxima" 
                                   name="capacidad_maxima" 
                                   value="{{ old('capacidad_maxima') }}" 
                                   min="1" 
                                   placeholder="Ej: 20">
                            @error('capacidad_maxima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Opcional - Número máximo de personas. Dejar vacío para capacidad ilimitada.</div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-save"></i> Guardar Paquete
                                </button>
                                <a href="{{ route('paquetes.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection