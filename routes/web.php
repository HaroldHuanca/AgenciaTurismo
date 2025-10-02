<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;

Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');

Route::get('/', function () {
    return view('welcome');    
});

Route::get('/ventas', function () {
    return view('ventas');
});
