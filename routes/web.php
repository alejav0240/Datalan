<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    InicioController,
    DashboardController,
    ClienteController,
    DireccionAdicionalController,
    ReporteFallaController,
    EmpleadoController,
    PermisoController,
    TrabajoController,
    PredecirController
};

// Redirección al inicio
Route::redirect('/', 'inicio');

// Página principal
Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

// ==============================
// RUTAS PÚBLICAS (sin autenticación)
// ==============================

// API de predicción de tiempo
Route::post('/predecir-api', [PredecirController::class, 'predecirTiempoApi'])->name('predecir.tiempo.api');

// ==============================
// RUTAS CON AUTENTICACIÓN Y VERIFICACIÓN
// ==============================

Route::middleware(['auth:sanctum', 'verified', 'auth'])->group(function () {
    // Registro de clientes y direcciones
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::post('/direcciones', [DireccionAdicionalController::class, 'store'])->name('direcciones.store');
    Route::delete('/direcciones-adicionales/{id}', [DireccionAdicionalController::class, 'destroy'])->name('direcciones.destroy');

    // Gestión de reportes por clientes
    Route::prefix('reportes-cliente')->name('reportes.cliente.')->group(function () {
        Route::post('/', [ReporteFallaController::class, 'clienteStore'])->name('store');
        Route::put('/{id}', [ReporteFallaController::class, 'clienteUpdate'])->name('update');
        Route::delete('/{id}', [ReporteFallaController::class, 'clienteDestroy'])->name('destroy');
        Route::get('/', [ReporteFallaController::class, 'clienteReportes'])->name('index');
    });

    // ==========================
    // ADMIN / EMPLEADO
    // ==========================

    Route::middleware(['role:empleado,administrador', 'is.not.cliente'])->group(function () {
        Route::resources([
            'reportes' => ReporteFallaController::class,
            'trabajos' => TrabajoController::class,
            'empleados' => EmpleadoController::class,
            'permisos' => PermisoController::class,
        ]);

        // ==========================
        // DASHBOARD
        // ==========================

        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');
            Route::get('/fintech', [DashboardController::class, 'fintech'])->name('fintech');
            Route::get('/trabajosmes', [DashboardController::class, 'trabajosPorMes'])->name('trabajosPorMes');
            Route::get('/tipos-fallas-mes', [DashboardController::class, 'tiposFallasMes'])->name('tiposFallasMes');
        });

        // ==========================
        // CLIENTES
        // ==========================

        Route::prefix('clientes')->name('clientes.')->group(function () {
            Route::get('/', [ClienteController::class, 'index'])->name('index');
            Route::put('/{id_cliente}', [ClienteController::class, 'update'])->name('update');
            Route::delete('/{id_cliente}', [ClienteController::class, 'destroy'])->name('destroy');
            Route::post('/{id_cliente}', [ClienteController::class, 'enable'])->name('enable');
        });
        Route::get('/api/direcciones-por-cliente/{clienteId}', [ReporteFallaController::class, 'getDireccionesPorCliente'])->name('api.direcciones-por-cliente');

        // ==========================
        // PERMISOS
        // ==========================

        Route::prefix('permisos')->name('permisos.')->group(function () {
            Route::post('/{permiso}/aprobar', [PermisoController::class, 'aprobar'])->name('aprobar');
            Route::post('/{permiso}/rechazar', [PermisoController::class, 'rechazar'])->name('rechazar');
            Route::get('/{permiso}/pdf', [PermisoController::class, 'generarPermisoPDF'])->name('pdf');
        });

        // ==========================
        // TRABAJOS
        // ==========================

        Route::prefix('trabajos')->name('trabajos.')->group(function () {
            Route::get('/pdf', [TrabajoController::class, 'generarTrabajosPDF'])->name('pdf');
            Route::post('/{trabajo}/cambiar-estado', [TrabajoController::class, 'cambiarEstado'])->name('cambiar-estado');
        });
    });
});
