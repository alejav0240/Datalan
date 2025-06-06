<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\DireccionAdicional;

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
            return view ('inicio', compact('cliente', 'direcciones'));
        }

        return redirect()->route('dashboard');
    }
}
