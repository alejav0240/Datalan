<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use Http;
use Illuminate\Http\Request;

class PredecirController extends Controller
{
    public function predecirTiempoApi(Request $request)
    {
        $request->validate([
            'cantidad_empleados' => 'required|integer|min:1',
            'tipo_trabajo' => 'required|string',
            'prioridad' => 'required|string',
        ]);
        $cant_tipo_trabajo = Trabajo::where('tipo_trabajo', $request->tipo_trabajo)->count();
        $cant_prioridad = Trabajo::where('prioridad', $request->prioridad)->count();


        $response = Http::post('http://127.0.0.1:8000/predecir-tiempo', [
            'cantidad_empleados' => $request->cantidad_empleados,
            'cant_tipo_trabajo' => $cant_tipo_trabajo,
            'cant_prioridad' => $cant_prioridad,
            'tipo_trabajo' => $request->tipo_trabajo,
            'prioridad' => $request->prioridad,
        ]);

        $tiempo = $response->json('tiempo_resolucion_estimado');

        return response()->json([
            'tiempo_estimado' => $tiempo
        ]);
    }

}
