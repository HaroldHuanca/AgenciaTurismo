<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Paquetes Turísticos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">

    {{-- TÍTULO DINÁMICO --}}
    @if(isset($accion) && $accion == 'create')
        <h1>Crear Nuevo Paquete Turístico</h1>
    @elseif(isset($accion) && $accion == 'edit')
        <h1>Editar Paquete Turístico</h1>
    @elseif(isset($accion) && $accion == 'show')
        <h1>Mostrar Paquete Turístico</h1>
    @else
        <h1>Paquetes Turísticos</h1>
    @endif

    {{-- MOSTRAR ERRORES DE VALIDACIÓN (PARA CREATE Y EDIT) --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups!</strong> Hubo algunos problemas con tu entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- MOSTRAR MENSAJES DE ÉXITO --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    {{-- SECCIÓN PARA CREAR O EDITAR --}}
    @if(isset($accion) && ($accion == 'create' || $accion == 'edit'))

        <form action="{{ isset($paqueteTuristico) ? route('paquetes-turisticos.update', $paqueteTuristico->id) : route('paquetes-turisticos.store') }}" method="POST">
            @csrf
            @if(isset($paqueteTuristico))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $paqueteTuristico->nombre ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $paqueteTuristico->descripcion ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="{{ old('precio', $paqueteTuristico->precio ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración (días):</label>
                <input type="number" class="form-control" id="duracion" name="duracion" value="{{ old('duracion', $paqueteTuristico->duracion ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="destino" class="form-label">Destino:</label>
                <input type="text" class="form-control" id="destino" name="destino" value="{{ old('destino', $paqueteTuristico->destino ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $paqueteTuristico->fecha_inicio ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="capacidad_maxima" class="form-label">Capacidad Máxima:</label>
                <input type="number" class="form-control" id="capacidad_maxima" name="capacidad_maxima" value="{{ old('capacidad_maxima', $paqueteTuristico->capacidad_maxima ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-control" id="estado" name="estado">
                    <option value="1" {{ old('estado', $paqueteTuristico->estado ?? '1') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado', $paqueteTuristico->estado ?? '1') == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($paqueteTuristico) ? 'Actualizar' : 'Guardar' }}</button>
            <a href="{{ route('paquetes-turisticos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>

    {{-- SECCIÓN PARA MOSTRAR DETALLES --}}
    @elseif(isset($accion) && $accion == 'show')

        <div class="mb-3">
            <strong>Nombre:</strong> {{ $paqueteTuristico->nombre }}
        </div>
        <div class="mb-3">
            <strong>Descripción:</strong> {{ $paqueteTuristico->descripcion }}
        </div>
        <div class="mb-3">
            <strong>Precio:</strong> {{ $paqueteTuristico->precio }}
        </div>
        <div class="mb-3">
            <strong>Duración:</strong> {{ $paqueteTuristico->duracion }} días
        </div>
        <div class="mb-3">
            <strong>Destino:</strong> {{ $paqueteTuristico->destino }}
        </div>
        <div class="mb-3">
            <strong>Fecha de Inicio:</strong> {{ $paqueteTuristico->fecha_inicio }}
        </div>
        <div class="mb-3">
            <strong>Capacidad Máxima:</strong> {{ $paqueteTuristico->capacidad_maxima }}
        </div>
        <div class="mb-3">
            <strong>Estado:</strong> {{ $paqueteTuristico->estado ? 'Activo' : 'Inactivo' }}
        </div>

        <a href="{{ route('paquetes-turisticos.index') }}" class="btn btn-primary">Volver</a>

    {{-- VISTA PRINCIPAL (TABLA) --}}
    @else
        <a href="{{ route('paquetes-turisticos.create') }}" class="btn btn-success mb-3">Crear Nuevo Paquete</a>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Duración</th>
                <th>Destino</th>
                <th>Fecha Inicio</th>
                <th>Capacidad Máxima</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            @foreach ($paquetes as $paquete)
                <tr>
                    <td>{{ $paquete->id }}</td>
                    <td>{{ $paquete->nombre }}</td>
                    <td>{{ $paquete->precio }}</td>
                    <td>{{ $paquete->duracion }}</td>
                    <td>{{ $paquete->destino }}</td>
                    <td>{{ $paquete->fecha_inicio }}</td>
                    <td>{{ $paquete->capacidad_maxima }}</td>
                    <td>{{ $paquete->estado ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        <form action="{{ route('paquetes-turisticos.destroy',$paquete->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('paquetes-turisticos.show',$paquete->id) }}">Mostrar</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('paquetes-turisticos.edit',$paquete->id) }}">Editar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</div>
</body>
</html>