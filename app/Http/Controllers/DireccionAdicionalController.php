<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DireccionAdicional;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class DireccionAdicionalController extends Controller
{

    public function index()
    {
        $nombre = Auth::user()->name;
        $cliente = Cliente::where('nombre_cliente', $nombre)->first();


        if (!$cliente){
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $direcciones = DireccionAdicional::where('id_cliente', $cliente->id_cliente)->get();
        
        return response()->json($direcciones);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string',
            'direccion' => 'required|string',
        ]);

        // Buscar cliente por nombre
        $cliente = Cliente::where('nombre_cliente', $request->nombre_cliente)->first();

        if (!$cliente) {
            return redirect()->back()->withErrors(['cliente' => 'No se encontró un cliente con ese nombre.']);
        }

        DireccionAdicional::create([
            'id_cliente' => $cliente->id_cliente,
            'direccion' => $request->direccion,
        ]);

        return redirect()->back()->with('success', 'Dirección adicional registrada correctamente.');
    }

    public function destroy($id)
    {
        $direccion = DireccionAdicional::find($id);

        if (!$direccion) {
            return response()->json(['error' => 'Dirección no encontrada'], 404);
        }

        $direccion->delete();

        return redirect()->back()->with('success', 'Dirección adicional eliminada correctamente.');
    }


    
}
