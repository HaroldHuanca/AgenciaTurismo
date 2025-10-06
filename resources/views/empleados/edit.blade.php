@extends('layouts.app')

@section('title', 'Editar Empleado: ' . $empleado->nombre)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Empleado</h1>
        <div>
            <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> Ver Detalles
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
                        Editando Empleado: {{ $empleado->nombre }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo *</label>
                            <input type="text" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre', $empleado->nombre) }}" 
                                   required 
                                   maxlength="255"
                                   placeholder="Ej: María González López">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label">Rol/Puesto *</label>
                                <select class="form-control @error('rol') is-invalid @enderror" 
                                        id="rol" 
                                        name="rol" 
                                        required>
                                    <option value="">Seleccionar rol...</option>
                                    <option value="Agente de Viajes" {{ old('rol', $empleado->rol) == 'Agente de Viajes' ? 'selected' : '' }}>Agente de Viajes</option>
                                    <option value="Gerente" {{ old('rol', $empleado->rol) == 'Gerente' ? 'selected' : '' }}>Gerente</option>
                                    <option value="Coordinador" {{ old('rol', $empleado->rol) == 'Coordinador' ? 'selected' : '' }}>Coordinador</option>
                                    <option value="Asesor Comercial" {{ old('rol', $empleado->rol) == 'Asesor Comercial' ? 'selected' : '' }}>Asesor Comercial</option>
                                    <option value="Guía Turístico" {{ old('rol', $empleado->rol) == 'Guía Turístico' ? 'selected' : '' }}>Guía Turístico</option>
                                    <option value="Recepcionista" {{ old('rol', $empleado->rol) == 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                                    <option value="Otro" {{ old('rol', $empleado->rol) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                                @error('rol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="comision" class="form-label">Comisión (%)</label>
                                <input type="number" 
                                       class="form-control @error('comision') is-invalid @enderror" 
                                       id="comision" 
                                       name="comision" 
                                       value="{{ old('comision', $empleado->comision) }}" 
                                       min="0" 
                                       max="100" 
                                       step="0.01"
                                       placeholder="Ej: 10.5">
                                @error('comision')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opcional - Porcentaje de comisión por ventas</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Corporativo</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $empleado->email) }}" 
                                   maxlength="255"
                                   placeholder="Ej: maria.gonzalez@agencia.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Opcional - Email corporativo del empleado</div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-save"></i> Actualizar Empleado
                                </button>
                                <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-secondary">
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