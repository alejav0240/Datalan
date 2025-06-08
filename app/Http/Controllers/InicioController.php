<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\DireccionAdicional;
use App\Models\ReporteFalla;

class InicioController extends Controller
{
    public function index()
    {
        if (!Auth::check()){
            return view('inicio');
        }

        if (Auth::user()->role == 'cliente'){
            $cliente = Cliente::where('user_id', Auth::user()->id)->first();
            $direcciones = DireccionAdicional::where('id_cliente', $cliente->id)->get();
            $reportes = ReporteFalla::where('cliente_id', $cliente->id)
                ->with('direccionAdicional')
                ->orderBy('created_at', 'desc')
                ->get();
            return view ('inicio', compact('cliente', 'direcciones', 'reportes'));
        }

        return redirect()->route('dashboard');
    }
}
