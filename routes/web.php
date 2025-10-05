<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PaqueteTuristicoController;
use App\Http\Controllers\ProveedorController;


Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::resource('/paquetes-turisticos', PaqueteTuristicoController::class);

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');

//Route::get('/paquetes-turisticos/{paqueteTuristico}', [PaqueteTuristicoController::class, 'show'])->name('paquetes-turisticos.show');
//Route::put('/paquetes-turisticos/{paqueteTuristico}', [PaqueteTuristicoController::class, 'update'])->name('paquetes-turisticos.update');

Route::get('/', function () {
    return view('welcome');    
});

Route::get('/ventas', function () {
    return view('ventas');
});
