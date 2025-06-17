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

        $empleadosConMasTrabajos = Empleado::select(
            'empleados.id',
            'cargo','ci',
            'empleados.user_id',
            DB::raw('COUNT(trabajos.id) as cantidad_trabajos')
        )
            ->join('equipos', 'empleados.id', '=', 'equipos.empleado_id') // Relación con la tabla intermedia
            ->join('trabajos', 'trabajos.id', '=', 'equipos.trabajo_id') // Relación con trabajos
            ->where('trabajos.created_at', '>=', now()->startOfMonth()) // Filtrar por el mes actual
            ->groupBy('empleados.id', 'empleados.user_id') // Agrupar por empleado
            ->orderByDesc('cantidad_trabajos') // Ordenar por cantidad de trabajos
            ->take(5) // Limitar al top 5
            ->get();

        //dd($empleadosConMasTrabajos);

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

            'empleadosConMasTrabajos' => $empleadosConMasTrabajos,

            'trabajosPorMes' => $trabajosPorMes,

        ]);
    }

    public function trabajosPorMes()
    {
        $trabajosPorMes = Trabajo::select(
            DB::raw("strftime('%m', created_at) as mes"),
            DB::raw('COUNT(*) as cantidad')
        )
            ->groupBy('mes')
            ->get();
        return response()->json($trabajosPorMes);
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
