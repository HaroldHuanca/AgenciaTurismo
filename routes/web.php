<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AuthController;

//Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');

Route::get('/', function () {
    return redirect('/login');    
});

//Route::get('/ventas', [ClienteController::class, 'ventas'])->name('ventas.index');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta del dashboard (protegida)
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');
