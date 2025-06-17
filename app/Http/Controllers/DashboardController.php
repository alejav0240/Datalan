<?php

namespace App\Http\Controllers;

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
        $trabajosPorMes = Trabajo::select(
            DB::raw("strftime('%m', created_at) as mes"),
            DB::raw('COUNT(*) as cantidad')
        )
            ->groupBy('mes')
            ->get();

        return view('pages/dashboard/dashboard', [
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
