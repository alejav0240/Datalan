<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Auth;


// CONTROLADORES DE LOS MODULOS

use App\Http\Controllers\ClienteController;

Route::redirect('/', 'inicio');

Route::get('/inicio', function () {
    // Si no está autenticado, redirige al inicio
    if (!Auth::check()) {
        return view('inicio');
    }

    // Verificar el nivel de acceso del usuario
    if (Auth::user()->role == 'cliente') {
        return view('inicio');
    }
    else{
        // Si es un usuario autenticado pero no es cliente, redirigir a la vista de dashboard
        return redirect()->route('dashboard');
    }

})->name('inicio');


// ESTAS RUTAS SON PARA EL REGISTRO DE CLIENTES
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/dashboard/fintech', [DashboardController::class, 'fintech'])->name('fintech');

    // RUTAS DE CLIENTE
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::put('/clientes/{id_cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id_cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::post('/clientes/{id_cliente}', [ClienteController::class, 'enable'])->name('clientes.enable');

    // Rutas de empleados
    Route::resource('empleados', \App\Http\Controllers\EmpleadoController::class);

});
