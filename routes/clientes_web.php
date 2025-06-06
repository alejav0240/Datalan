<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DireccionAdicionalController;
use App\Http\Controllers\ClienteController;

// RUTAS TEMPORALES PARA CLIENTES

Route::middleware(['auth:sanctum', 'verified'])->group(function () {


    // RUTAS NUEVAS PARA EL REGISTRO DE CLIENTES

    Route::get('/clientes/registrar/', [ClienteController::class, 'create'])->name('clientes.create');
    Route::get('/clientes/{cliente}/editar', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    


    Route::get('/direcciones-adicionales', [DireccionAdicionalController::class, 'index'])->name('direcciones.index');
    Route::post('/direcciones-adicionales', [DireccionAdicionalController::class, 'store'])->name('direcciones.store');
    Route::delete('/direcciones-adicionales/{id_direccion}', [DireccionAdicionalController::class, 'destroy'])->name('direcciones.destroy');

    Route::get('/clientes/{id_cliente}/direcciones', [DireccionAdicionalController::class, 'direccionCliente'])->name('clientes.direcciones');


});