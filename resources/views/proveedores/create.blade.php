@extends('layouts.app')

@section('title', 'Crear Nuevo Proveedor')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear Nuevo Proveedor</h1>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a la lista
        </a>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información del Proveedor</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('proveedores.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Proveedor *</label>
                            <input type="text" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre') }}" 
                                   required 
                                   maxlength="255"
                                   placeholder="Ej: Hotel Paradise, Aerolíneas XYZ">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label">Tipo de Proveedor</label>
                                <select class="form-control @error('tipo') is-invalid @enderror" 
                                        id="tipo" 
                                        name="tipo">
                                    <option value="">Seleccionar tipo...</option>
                                    <option value="Hotel" {{ old('tipo') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                    <option value="Aerolínea" {{ old('tipo') == 'Aerolínea' ? 'selected' : '' }}>Aerolínea</option>
                                    <option value="Transporte" {{ old('tipo') == 'Transporte' ? 'selected' : '' }}>Transporte</option>
                                    <option value="Tour Operador" {{ old('tipo') == 'Tour Operador' ? 'selected' : '' }}>Tour Operador</option>
                                    <option value="Restaurante" {{ old('tipo') == 'Restaurante' ? 'selected' : '' }}>Restaurante</option>
                                    <option value="Guía Turístico" {{ old('tipo') == 'Guía Turístico' ? 'selected' : '' }}>Guía Turístico</option>
                                    <option value="Otro" {{ old('tipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opcional</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="comision_agencia" class="form-label">Comisión de la Agencia (%)</label>
                                <input type="number" 
                                       class="form-control @error('comision_agencia') is-invalid @enderror" 
                                       id="comision_agencia" 
                                       name="comision_agencia" 
                                       value="{{ old('comision_agencia') }}" 
                                       min="0" 
                                       max="100" 
                                       step="0.01"
                                       placeholder="Ej: 15.5">
                                @error('comision_agencia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opcional - Porcentaje de comisión</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contacto" class="form-label">Persona de Contacto</label>
                            <input type="text" 
                                   class="form-control @error('contacto') is-invalid @enderror" 
                                   id="contacto" 
                                   name="contacto" 
                                   value="{{ old('contacto') }}" 
                                   maxlength="255"
                                   placeholder="Nombre del contacto principal">
                            @error('contacto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Opcional - Nombre de la persona de contacto</div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-save"></i> Guardar Proveedor
                                </button>
                                <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">
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