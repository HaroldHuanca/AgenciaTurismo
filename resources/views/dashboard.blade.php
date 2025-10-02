<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TourCRM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome@6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #667eea;
            --color-secondary: #764ba2;
            --color-light: #f8f9fa;
        }
        
        .sidebar {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: white;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: var(--color-light);
            min-height: 100vh;
        }
        
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--color-primary);
        }
        
        .welcome-card {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <i class="fas fa-plane fa-2x mb-2"></i>
            <h5>TourCRM</h5>
            <small class="text-light">Sistema de Gestión</small>
        </div>
        
        <nav class="nav flex-column">
            <a href="/dashboard" class="nav-link active">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="/clientes" class="nav-link">
                <i class="fas fa-users"></i> Clientes
            </a>
            <a href="/ventas" class="nav-link">
                <i class="fas fa-chart-line"></i> Ventas
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-calendar"></i> Reservas
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-box"></i> Paquetes
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-cog"></i> Configuración
            </a>
            <form method="POST" action="/logout" class="nav-link">
                @csrf
                <button type="submit" class="btn btn-link text-light p-0 m-0" style="text-decoration: none;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Dashboard</span>
                <div class="d-flex align-items-center">
                    <span class="me-3">Bienvenido, {{ Auth::user()->name }}</span>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Welcome Card -->
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>¡Bienvenido de vuelta!</h2>
                    <p class="mb-0">Aquí tienes un resumen de las operaciones de tu agencia de turismo.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <i class="fas fa-chart-bar fa-4x opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted">Clientes Activos</h6>
                            <h3>248</h3>
                            <p class="mb-0 text-success"><small><i class="fas fa-arrow-up"></i> 12% desde ayer</small></p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted">Reservas del Mes</h6>
                            <h3>56</h3>
                            <p class="mb-0 text-success"><small><i class="fas fa-arrow-up"></i> 8% desde ayer</small></p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar-check fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted">Ventas del Mes</h6>
                            <h3>$24,580</h3>
                            <p class="mb-0 text-danger"><small><i class="fas fa-arrow-down"></i> 3% desde ayer</small></p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-dollar-sign fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="stats-card">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted">Operaciones Activas</h6>
                            <h3>12</h3>
                            <p class="mb-0 text-success"><small><i class="fas fa-arrow-up"></i> 5% desde ayer</small></p>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-truck fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Actividad Reciente</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-plus text-success me-3"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Nuevo cliente registrado</h6>
                                        <small class="text-muted">María García se registró hace 2 horas</small>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-check text-primary me-3"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Reserva confirmada</h6>
                                        <small class="text-muted">Reserva #RES-001 confirmada para Cancún</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Acciones Rápidas</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="/clientes" class="btn btn-primary">
                                <i class="fas fa-users me-2"></i>Gestionar Clientes
                            </a>
                            <a href="/ventas" class="btn btn-success">
                                <i class="fas fa-chart-line me-2"></i>Ver Ventas
                            </a>
                            <a href="#" class="btn btn-info">
                                <i class="fas fa-plus me-2"></i>Nueva Reserva
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>