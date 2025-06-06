<?php

namespace App\Http\Controllers;

use App\Models\ReporteFalla;
use App\Models\Cliente;
use App\Http\Requests\StoreReporteFallaRequest;
use App\Http\Requests\UpdateReporteFallaRequest;
use Illuminate\Http\Request;

class ReporteFallaController extends Controller
{
    // Obtener reportes
    public function index(Request $request)
    {
        $reportes = ReporteFalla::with('cliente')->get(); // cargar cliente
        return view('pages.reportes.index', compact('reportes')); // reportes y clientes relacionados
    }

    // Crear
    public function create()
    {
        $clientes = Cliente::all(); // obtener clientes
        return view('pages.reportes.create', compact('clientes')); // lista de clientes
    }

    // Guardar
    public function store(StoreReporteFallaRequest $request)
    {
        try {
            $reporte = ReporteFalla::create([
                'cliente_id' => $request->cliente_id,
                'tipo_falla' => $request->tipo_falla,
                'descripcion' => $request->descripcion,
                'direccion' => $request->direccion,
                'estado' => 'pendiente', // Estado inicial
            ]); // crear reporte
            return redirect()->route('reportes.index')->with('success', 'Reporte de falla creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el reporte de falla: ' . $e->getMessage())->withInput();
        }
    }

    // Mostrar
    public function show(ReporteFalla $reporte)
    {
        $reporte->load('cliente', 'trabajo'); // cargar cliente y trabajo
        return view('pages.reportes.show', compact('reporte'));
    }

    // Editar
    public function edit(ReporteFalla $reporte)
    {
        $clientes = Cliente::all(); // obtener clientes
        return view('pages.reportes.edit', compact('reporte', 'clientes')); // lista de clientes
    }

    // Actualizar
    public function update(UpdateReporteFallaRequest $request, ReporteFalla $reporte) // recibir reporte
    {
        try {
            $reporte->update([ // actualizar reporte
                'cliente_id' => $request->cliente_id,
                'tipo_falla' => $request->tipo_falla,
                'descripcion' => $request->descripcion,
                'direccion' => $request->direccion,
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
}
