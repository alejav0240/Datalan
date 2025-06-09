<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\DireccionAdicional;
use App\Models\ReporteFalla;


// CONTROLADORES DE LOS MODULOS
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReporteFallaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PermisoController;

Route::redirect('/', 'inicio');

Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');



// ESTAS RUTAS SON PARA EL REGISTRO DE CLIENTES
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

// RUTAS PARA DIRECCIONES ADICIONALES
Route::post('/direcciones', [\App\Http\Controllers\DireccionAdicionalController::class, 'store'])->name('direcciones.store');
Route::delete('/direcciones-adicionales/{id}', [\App\Http\Controllers\DireccionAdicionalController::class, 'destroy']);

// RUTAS PARA REPORTES DE CLIENTES
Route::middleware(['auth'])->group(function () {
    // Crear
    Route::post('/reportes-cliente', [ReporteFallaController::class, 'clienteStore'])->name('reportes.cliente.store');
    Route::put('/reportes-cliente/{id}', [ReporteFallaController::class, 'clienteUpdate'])->name('reportes.cliente.update');
    // Eliminar
    Route::delete('/reportes-cliente/{id}', [ReporteFallaController::class, 'clienteDestroy'])->name('reportes.cliente.destroy');
    // Obtener reportes (para AJAX)
    Route::get('/reportes-cliente', [ReporteFallaController::class, 'clienteReportes'])->name('reportes.cliente.index');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/dashboard/fintech', [DashboardController::class, 'fintech'])->name('fintech');

    // RUTAS DE CLIENTE
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::put('/clientes/{id_cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id_cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::post('/clientes/{id_cliente}', [ClienteController::class, 'enable'])->name('clientes.enable');
    Route::get('/api/direcciones-por-cliente/{clienteId}', [ReporteFallaController::class, 'getDireccionesPorCliente'])->name('api.direcciones-por-cliente');

    // Rutas de empleados
    Route::resource('empleados', EmpleadoController::class);

    Route::resource('trabajos', \App\Http\Controllers\TrabajoController::class);

    // Rutas de reportes de fallas (solo para administradores)
    Route::resource('reportes', ReporteFallaController::class);

    // Rutas de permisos
    Route::resource('permisos', PermisoController::class);
});
