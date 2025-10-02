<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;

Route::get('/', function () {
    return view('whatsapp');
})->name('whatsapp.index');

Route::get('/ventas', function () {
    return view('ventas');
});

// WhatsApp Routes
Route::prefix('/whatsapp')->group(function () {
    Route::get('/', [WhatsAppController::class, 'index'])->name('whatsapp.blade.php');
    // Puedes agregar más rutas aquí según lo que necesites
});
