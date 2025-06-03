<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DireccionAdicionalController;

// RUTAS TEMPORALES PARA CLIENTES

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/direcciones-adicionales', [DireccionAdicionalController::class, 'index'])->name('direcciones.index');
    Route::post('/direcciones-adicionales', [DireccionAdicionalController::class, 'store'])->name('direcciones.store');
    Route::delete('/direcciones-adicionales/{id_direccion}', [DireccionAdicionalController::class, 'destroy'])->name('direcciones.destroy');

    Route::get('/clientes/{id_cliente}/direcciones', [DireccionAdicionalController::class, 'direccionCliente'])->name('clientes.direcciones');


});