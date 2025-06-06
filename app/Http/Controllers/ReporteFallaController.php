<?php

namespace App\Http\Controllers;

use App\Models\ReporteFalla;
use App\Models\Cliente;
use App\Models\DireccionAdicional;
use App\Http\Requests\StoreReporteFallaRequest;
use App\Http\Requests\UpdateReporteFallaRequest;
use Illuminate\Http\Request;

class ReporteFallaController extends Controller
{
    // Obtener reportes
    public function index(Request $request)
    {
        $reportes = ReporteFalla::with(['cliente', 'direccionAdicional'])->get(); // cargar cliente y dirección
        return view('pages.reportes.index', compact('reportes')); // reportes y clientes relacionados
    }

    // Crear
    public function create()
    {
        $clientes = Cliente::all(); // obtener clientes
        $direcciones = collect(); // colección vacía por defecto
        // Si hay un cliente seleccionado por defecto, cargar sus direcciones
        if (old('cliente_id')) {
            $direcciones = DireccionAdicional::where('id_cliente', old('cliente_id'))->get();
        }
        return view('pages.reportes.create', compact('clientes', 'direcciones')); // lista de clientes y direcciones
    }

    // Guardar
    public function store(StoreReporteFallaRequest $request)
    {
        try {
            $reporte = ReporteFalla::create([
                'cliente_id' => $request->cliente_id,
                'direccion_adicional_id' => $request->direccion_adicional_id,
                'tipo_falla' => $request->tipo_falla,
                'descripcion' => $request->descripcion,
                'estado' => 'pendiente', 
            ]); // crear reporte
            return redirect()->route('reportes.index')->with('success', 'Reporte de falla creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el reporte de falla: ' . $e->getMessage())->withInput();
        }
    }

    // Mostrar
    public function show(ReporteFalla $reporte)
    {
        $reporte->load('cliente', 'direccionAdicional'); // cargar cliente, dirección
        return view('pages.reportes.show', compact('reporte'));
    }

    // Editar
    public function edit(ReporteFalla $reporte)
    {
        $clientes = Cliente::all(); // obtener clientes
        $direcciones = DireccionAdicional::where('id_cliente', $reporte->cliente_id)->get(); // obtener direcciones 
        return view('pages.reportes.edit', compact('reporte', 'clientes', 'direcciones')); // lista de clientes y direcciones
    }

    // Actualizar
    public function update(UpdateReporteFallaRequest $request, ReporteFalla $reporte) // recibir reporte
    {
        try {
            $reporte->update([ // actualizar reporte
                'cliente_id' => $request->cliente_id,
                'direccion_adicional_id' => $request->direccion_adicional_id,
                'tipo_falla' => $request->tipo_falla,
                'descripcion' => $request->descripcion,
                'estado' => $request->estado ?? $reporte->estado,
            ]);
            return redirect()->route('reportes.index')
                ->with('success', 'Reporte de falla actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el reporte de falla: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Eliminar
    public function destroy(ReporteFalla $reporte)
    {
        try {
            $reporte->delete(); // eliminar reporte
            return redirect()->route('reportes.index')->with('success', 'Reporte de falla eliminado exitosamente.');
        } catch (\Exception $e) { 
            return redirect()->back()->with('error', 'Error al eliminar el reporte de falla: ' . $e->getMessage());
        }
    }
    
    // Obtener direcciones por cliente (para AJAX)
    public function getDireccionesPorCliente($clienteId)
    {
        $direcciones = DireccionAdicional::where('id_cliente', $clienteId)->get();
        return response()->json($direcciones);
    }
}
