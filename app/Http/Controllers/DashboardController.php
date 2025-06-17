<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Permiso;
use App\Models\ReporteFalla;
use App\Models\Trabajo;
use DB;
use Illuminate\Http\Request;
use App\Models\DataFeed;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->role == 'administrador') {
            return redirect('/trabajos');
        }

        $totalClientes = Cliente::count();
        $totalEmpleados = Empleado::count();
        $totalPermisos = Permiso::where('created_at', '>=', now()->subDays(30))->count();
        $totalTrabajos = Trabajo::where('created_at', '>=', now()->subDays(30))->count();
        $totalReportes = ReporteFalla::where('created_at', '>=', now()->subDays(30))->count();

        $trabajosPorMes = Trabajo::select(
            DB::raw("strftime('%m', created_at) as mes"),
            DB::raw('COUNT(*) as cantidad')
        )
            ->groupBy('mes')
            ->get();

        //dd($trabajosPorMes, $totalClientes, $totalEmpleados, $totalPermisos, $totalTrabajos, $totalReportes);

        return view('pages/dashboard/dashboard', [
            'totalClientes' => $totalClientes,
            'totalEmpleados' => $totalEmpleados,
            'totalPermisos' => $totalPermisos,
            'totalTrabajos' => $totalTrabajos,
            'totalReportes' => $totalReportes,

            'trabajosPorMes' => $trabajosPorMes,

        ]);
    }

    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analytics()
    {
        return view('pages/dashboard/analytics');
    }

    /**
     * Displays the fintech screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fintech()
    {
        return view('pages/dashboard/fintech');
    }
}
