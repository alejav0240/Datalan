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
        $id = Auth::user()->id;
        $cliente = Cliente::where('user_id', $id)->first();


        if (!$cliente){
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $direcciones = DireccionAdicional::where('id_cliente', $cliente->id)->get();
        
        return response()->json($direcciones);
    }

    public function store(Request $request)
    {
        $request->validate([
            'direccion' => 'required|string',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);
        

        // Buscar cliente por nombre
        $cliente = Cliente::where('user_id', Auth::user()->id)->first();

        if (!$cliente) {
            return redirect()->back()->withErrors(['cliente' => 'No se encontró un cliente.']);
        }

        DireccionAdicional::create([
            'id_cliente' => $cliente->id,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
        ]);
        

        return redirect()->back()->with('success', 'Dirección registrada correctamente.');
    }

    public function destroy($id)
    {
        $direccion = DireccionAdicional::find($id);

        if (!$direccion) {
            return response()->json(['error' => 'Dirección no encontrada', 'id' => $id], 404);
        }

        $direccion->delete();

        return redirect()->back()->with('success', 'Dirección eliminada correctamente.');
    }

    public function direccionCliente($id_cliente)
    {
        $direcciones = DireccionAdicional::where('id_cliente', $id_cliente)->get();

        if ($direcciones->isEmpty()) {
            return response()->json(['message' => 'No se encontraron direcciones para este cliente.'], 404);
        }

        return response()->json($direcciones);
    }


    
}
