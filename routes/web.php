<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');

Route::get('/', function () {
    return view('welcome');    
});

Route::get('/ventas', function () {
    return view('ventas');
});
