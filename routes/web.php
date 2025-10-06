<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PaqueteTuristicoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserController;

// Rutas públicas (acceso sin autenticación)
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Recursos CRUD
    Route::resource('clientes', ClienteController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('paquetes', PaqueteTuristicoController::class);
    Route::resource('proveedores', ProveedorController::class);
});