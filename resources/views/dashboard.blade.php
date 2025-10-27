<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Agencia de Turismo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <main class="py-4">
        <div class="container">
            <div class="row">
                <!-- Barra vertical de navegación -->
                <div class="col-md-3 mb-4">
                    <div class="vertical-bar d-flex flex-column gap-2">
                        <a class="nav-btn btn-clientes" href="{{ route('clientes.index') }}">
                            <i class="fas fa-users"></i>
                            <span class="btn-text">Clientes</span>
                        </a>
                        <a class="nav-btn btn-empleados" href="{{ route('empleados.index') }}">
                            <i class="fas fa-user-tie"></i>
                            <span class="btn-text">Empleados</span>
                        </a>
                        <a class="nav-btn btn-paquetes" href="{{ route('paquetes.index') }}">
                            <i class="fas fa-box"></i>
                            <span class="btn-text">Paquetes</span>
                        </a>
                        <a class="nav-btn btn-proveedores" href="{{ route('proveedores.index') }}">
                            <i class="fas fa-truck"></i>
                            <span class="btn-text">Proveedores</span>
                        </a>
                    </div>
                </div>
                <!-- Contenido principal del dashboard -->
                <div class="col-md-9">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Bienvenido, {{ Auth::user()->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p>Has iniciado sesión correctamente en el sistema de la agencia de turismo.</p>

                            <div class="row mt-4">
                                <div class="col-md-3 mb-3">
                                    <div class="card metric-card bg-primary text-white">
                                        <div class="card-body">
                                            <h6>Total Clientes</h6>
                                            <h3>{{ App\Models\Cliente::count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card metric-card bg-success text-white">
                                        <div class="card-body">
                                            <h6>Paquetes Activos</h6>
                                            <h3>{{ App\Models\PaqueteTuristico::count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card metric-card bg-info text-white">
                                        <div class="card-body">
                                            <h6>Empleados</h6>
                                            <h3>{{ App\Models\Empleado::count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card metric-card bg-warning text-dark">
                                        <div class="card-body">
                                            <h6>Proveedores</h6>
                                            <h3>{{ App\Models\Proveedor::count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>