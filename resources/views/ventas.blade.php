<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TourCRM - Gestión de Agencia de Turismo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        :root {
            --color-humo: #F0F0F0;
            --color-rojo: #E7473C;
            --color-humo-dark: #e0e0e0;
            --color-rojo-dark: #d43c31;
        }
        
        body {
            background-color: var(--color-humo);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            min-height: 100vh;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar .nav-link {
            color: #333;
            border-radius: 5px;
            margin: 5px 0;
            transition: all 0.2s;
        }
        
        .sidebar .nav-link:hover {
            background-color: var(--color-humo);
        }
        
        .sidebar .nav-link.active {
            background-color: var(--color-rojo);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            background-color: var(--color-humo);
            min-height: 100vh;
        }
        
        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary-custom {
            background-color: var(--color-rojo);
            border-color: var(--color-rojo);
            color: white;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--color-rojo-dark);
            border-color: var(--color-rojo-dark);
            color: white;
        }
        
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stats-card {
            border-left: 4px solid var(--color-rojo);
        }
        
        .module-section {
            display: none;
            animation: fadeIn 0.5s;
        }
        
        .module-section.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .table-custom thead {
            background-color: var(--color-rojo);
            color: white;
        }
        
        .badge-reserva {
            background-color: var(--color-rojo);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box input {
            padding-left: 40px;
            border-radius: 20px;
        }
        
        .search-box i {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #aaa;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--color-rojo);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .welcome-banner {
            background: linear-gradient(135deg, var(--color-rojo) 0%, #ff6b6b 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                width: 250px;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .overlay {
                display: none;
                position: fixed;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }
            
            .overlay.show {
                display: block;
            }
            
            .main-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="p-3">
                <h4 class="text-center mb-4">
                    <i class="fas fa-globe-americas text-primary-custom"></i>
                    <span class="ms-2 d-none d-md-inline">TourCRM</span>
                </h4>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" data-module="dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="d-none d-md-inline">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-module="clientes">
                            <i class="fas fa-users"></i>
                            <span class="d-none d-md-inline">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-module="reservas">
                            <i class="fas fa-calendar-check"></i>
                            <span class="d-none d-md-inline">Reservas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-module="ventas">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="d-none d-md-inline">Ventas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-module="logistica">
                            <i class="fas fa-truck"></i>
                            <span class="d-none d-md-inline">Logística</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-module="proveedores">
                            <i class="fas fa-handshake"></i>
                            <span class="d-none d-md-inline">Proveedores</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-module="reportes">
                            <i class="fas fa-chart-bar"></i>
                            <span class="d-none d-md-inline">Reportes</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content w-100" style="margin-left: 0;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid">
                    <button class="btn btn-sm" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="d-flex align-items-center">
                        <div class="search-box me-3">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control form-control-sm" placeholder="Buscar...">
                        </div>
                        
                        <div class="dropdown me-3">
                            <a href="#" class="position-relative" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                                <li><a class="dropdown-item" href="#">Nueva reserva de María García</a></li>
                                <li><a class="dropdown-item" href="#">Pago confirmado de Viaje a Cancún</a></li>
                                <li><a class="dropdown-item" href="#">Recordatorio: Reunión con proveedor</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name=Usuario&background=E7473C&color=fff" alt="Usuario" class="profile-img">
                                <span class="ms-2 d-none d-md-inline">Usuario</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Perfil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="container-fluid p-4">
                <!-- Dashboard Module -->
                <div id="dashboard" class="module-section active">
                    <div class="welcome-banner">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3>¡Bienvenido de nuevo!</h3>
                                <p class="mb-0">Aquí tienes un resumen de las operaciones de tu agencia de turismo.</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <button class="btn btn-light">Ver reporte completo</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card card-custom stats-card">
                                <div class="card-body">
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
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card card-custom stats-card">
                                <div class="card-body">
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
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card card-custom stats-card">
                                <div class="card-body">
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
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card card-custom stats-card">
                                <div class="card-body">
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
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <div class="card card-custom">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0">Reservas Recientes</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Destino</th>
                                                    <th>Fecha</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>María García</td>
                                                    <td>Cancún, México</td>
                                                    <td>15/08/2023</td>
                                                    <td><span class="badge bg-success">Confirmada</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Carlos López</td>
                                                    <td>París, Francia</td>
                                                    <td>22/09/2023</td>
                                                    <td><span class="badge bg-warning">Pendiente</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Ana Rodríguez</td>
                                                    <td>Machu Picchu, Perú</td>
                                                    <td>05/10/2023</td>
                                                    <td><span class="badge bg-info">Pagado</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                        <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card card-custom">
                                <div class="card-header bg-white">
                                    <h5 class="card-title mb-0">Próximos Tours</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="https://via.placeholder.com/60x60" class="rounded" alt="Tour">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Tour Cancún Premium</h6>
                                            <small class="text-muted">15 Ago 2023 - 22 Ago 2023</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="https://via.placeholder.com/60x60" class="rounded" alt="Tour">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Europa Clásica</h6>
                                            <small class="text-muted">22 Sep 2023 - 05 Oct 2023</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="https://via.placeholder.com/60x60" class="rounded" alt="Tour">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Aventura en Perú</h6>
                                            <small class="text-muted">05 Oct 2023 - 15 Oct 2023</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clientes Module -->
                <div id="clientes" class="module-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>Gestión de Clientes</h3>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addClientModal">
                            <i class="fas fa-plus me-2"></i>Nuevo Cliente
                        </button>
                    </div>

                    <div class="card card-custom">
                        <div class="card-header bg-white">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="card-title mb-0">Lista de Clientes</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="search-box">
                                        <i class="fas fa-search"></i>
                                        <input type="text" class="form-control" placeholder="Buscar cliente...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Última reserva</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>María García</td>
                                            <td>maria@example.com</td>
                                            <td>+1 234 567 890</td>
                                            <td>15/08/2023</td>
                                            <td><span class="badge bg-success">Activo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Carlos López</td>
                                            <td>carlos@example.com</td>
                                            <td>+1 234 567 891</td>
                                            <td>22/09/2023</td>
                                            <td><span class="badge bg-success">Activo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ana Rodríguez</td>
                                            <td>ana@example.com</td>
                                            <td>+1 234 567 892</td>
                                            <td>05/10/2023</td>
                                            <td><span class="badge bg-warning">Inactivo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservas Module -->
                <div id="reservas" class="module-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>Gestión de Reservas</h3>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addReservationModal">
                            <i class="fas fa-plus me-2"></i>Nueva Reserva
                        </button>
                    </div>

                    <div class="card card-custom">
                        <div class="card-header bg-white">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="card-title mb-0">Lista de Reservas</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="search-box">
                                        <i class="fas fa-search"></i>
                                        <input type="text" class="form-control" placeholder="Buscar reserva...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Cliente</th>
                                            <th>Tour</th>
                                            <th>Fecha</th>
                                            <th>Personas</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>RES-001</td>
                                            <td>María García</td>
                                            <td>Cancún Premium</td>
                                            <td>15/08/2023</td>
                                            <td>2</td>
                                            <td><span class="badge bg-success">Confirmada</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>RES-002</td>
                                            <td>Carlos López</td>
                                            <td>Europa Clásica</td>
                                            <td>22/09/2023</td>
                                            <td>4</td>
                                            <td><span class="badge bg-warning">Pendiente</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>RES-003</td>
                                            <td>Ana Rodríguez</td>
                                            <td>Aventura en Perú</td>
                                            <td>05/10/2023</td>
                                            <td>1</td>
                                            <td><span class="badge bg-info">Pagado</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ventas Module -->
                <div id="ventas" class="module-section">
                    <h3 class="mb-4">Gestión de Ventas</h3>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Módulo de ventas - En construcción
                    </div>
                </div>

                <!-- Logística Module -->
                <div id="logistica" class="module-section">
                    <h3 class="mb-4">Operaciones Logísticas</h3>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Módulo de logística - En construcción
                    </div>
                </div>

                <!-- Reportes Module -->
                <div id="reportes" class="module-section">
                    <h3 class="mb-4">Reportes y Estadísticas</h3>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>Módulo de reportes - En construcción
                    </div>
                </div>

                <!-- Proveedores Module -->
                <div id="proveedores" class="module-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3>Gestión de Proveedores</h3>
                        <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addProviderModal">
                            <i class="fas fa-plus me-2"></i>Nuevo Proveedor
                        </button>
                    </div>
                    <div class="card card-custom">
                        <div class="card-header bg-white">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="card-title mb-0">Lista de Proveedores</h5>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Servicio</th>
                                                        <th>Contacto</th>
                                                        <th>Teléfono</th>
                                                        <th>Email</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Proveedor A</td>
                                                        <td>Transporte</td>
                                                        <td>Juan Pérez</td>
                                                        <td>+1 234 567 893</td>
                                                        <td><a href="mailto:juan.perez@example.com">juan.perez@example.com</a></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></      button>
                                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Proveedor B</td>
                                                        <td>Alojamiento</td>
                                                        <td>María López</td>
                                                        <td>+1 234 567 894</td>
                                                        <td><a href="mailto:maria.lopez@example.com">maria.lopez@example.com</a></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="clientForm">
                        <div class="mb-3">
                            <label for="clientName" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="clientName" required>
                        </div>
                        <div class="mb-3">
                            <label for="clientEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="clientEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="clientPhone" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="clientPhone">
                        </div>
                        <div class="mb-3">
                            <label for="clientAddress" class="form-label">Dirección</label>
                            <textarea class="form-control" id="clientAddress" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary-custom" id="saveClient">Guardar Cliente</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        // Database connection setup (simulated for future implementation)
        class DatabaseConnection {
            constructor() {
                this.connected = false;
            }
            
            connect() {
                // Simulate connection
                return new Promise((resolve) => {
                    setTimeout(() => {
                        this.connected = true;
                        console.log("Connected to database");
                        resolve(true);
                    }, 1000);
                });
            }
            
            disconnect() {
                this.connected = false;
                console.log("Disconnected from database");
            }
            
            isConnected() {
                return this.connected;
            }
            
            // Generic method to execute queries (simulated)
            async executeQuery(query, params = []) {
                if (!this.connected) {
                    await this.connect();
                }
                
                // Simulate query execution
                return new Promise((resolve) => {
                    setTimeout(() => {
                        console.log(`Executing query: ${query}`, params);
                        resolve({ success: true, data: [] });
                    }, 500);
                });
            }
        }

        // Initialize database connection
        const db = new DatabaseConnection();
        
        // DOM manipulation and event handling
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize database connection
            db.connect().then(() => {
                console.log("Database connection established");
            });
            
            // Module navigation
            const moduleLinks = document.querySelectorAll('.nav-link[data-module]');
            const moduleSections = document.querySelectorAll('.module-section');
            
            moduleLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Update active link
                    moduleLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show corresponding module
                    const moduleId = this.getAttribute('data-module');
                    moduleSections.forEach(section => {
                        section.classList.remove('active');
                        if (section.id === moduleId) {
                            section.classList.add('active');
                        }
                    });
                    
                    // Close sidebar on mobile after selection
                    if (window.innerWidth < 768) {
                        document.getElementById('sidebar').classList.remove('show');
                        document.querySelector('.overlay').classList.remove('show');
                    }
                });
            });
            
            // Sidebar toggle for mobile
            document.getElementById('sidebarToggle').addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.querySelector('.overlay');
                
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });
            
            // Close sidebar when clicking on overlay
            document.querySelector('.overlay').addEventListener('click', function() {
                document.getElementById('sidebar').classList.remove('show');
                this.classList.remove('show');
            });
            
            // Save client form
            document.getElementById('saveClient').addEventListener('click', function() {
                const clientName = document.getElementById('clientName').value;
                const clientEmail = document.getElementById('clientEmail').value;
                
                if (!clientName || !clientEmail) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor complete todos los campos obligatorios'
                    });
                    return;
                }
                
                // Simulate saving to database
                db.executeQuery(
                    'INSERT INTO clients (name, email, phone, address) VALUES (?, ?, ?, ?)',
                    [clientName, clientEmail, document.getElementById('clientPhone').value, document.getElementById('clientAddress').value]
                ).then(result => {
                    if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Cliente agregado correctamente'
                        }).then(() => {
                            // Close modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('addClientModal'));
                            modal.hide();
                            
                            // Reset form
                            document.getElementById('clientForm').reset();
                        });
                    }
                });
            });
            
            // Example of using SweetAlert for confirmation
            const deleteButtons = document.querySelectorAll('.btn-outline-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se puede deshacer",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#E7473C',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                '¡Eliminado!',
                                'El elemento ha sido eliminado.',
                                'success'
                            );
                        }
                    });
                });
            });
            
            // Responsive adjustments
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    document.getElementById('sidebar').classList.remove('show');
                    document.querySelector('.overlay').classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>