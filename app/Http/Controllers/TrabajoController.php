<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Empleado;
use App\Models\ReporteFalla;
use App\Http\Requests\StoreTrabajoRequest;
use App\Http\Requests\UpdateTrabajoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrabajoController extends Controller
{
    // Filtros
    public function index(Request $request)
    {
        $query = Trabajo::with(['reporte', 'empleados']);
        if ($request->has('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }
        if ($request->has('tipo_trabajo')) {
            $query->where('tipo_trabajo', $request->tipo_trabajo);
        }
        if ($request->has('search')) {
            $query->where('descripcion', 'like', '%' . $request->search . '%');
        }
        $trabajos = $query->orderBy('created_at', 'desc')->get();
        return view('pages.trabajos.index', compact('trabajos'));
    }

    // Crear
    public function create()
    {
        $reportes = ReporteFalla::where('estado', 'pendiente')->get();
        $empleados = Empleado::with('user')->get();
        return view('pages.trabajos.create', compact('reportes', 'empleados'));
    }

    // Guardar
    public function store(StoreTrabajoRequest $request)
    {
        try {
            DB::beginTransaction();            
            // Crear el trabajo
            $trabajo = Trabajo::create([
                'reporte_id' => $request->reporte_id,
                'tipo_trabajo' => $request->tipo_trabajo,
                'descripcion' => $request->descripcion,
                'prioridad' => $request->prioridad,
                'materiales' => $request->materiales,
                'observaciones_materiales' => $request->observaciones_materiales
            ]);
            // Actualizar reporte
            $reporte = ReporteFalla::find($request->reporte_id);
            $reporte->update(['estado' => 'en_proceso']);
            // Asignar empleados al equipo
            if ($request->has('empleados')) {
                $empleados = $request->empleados;
                $encargado = $request->encargado_id;
                foreach ($empleados as $empleadoId) {
                    $trabajo->empleados()->attach($empleadoId, [
                        'is_encargado' => ($empleadoId == $encargado)
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('trabajos.index')->with('success', 'Trabajo creado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear el trabajo: ' . $e->getMessage())->withInput();
        }
    }

    // Mostrar
    public function show(Trabajo $trabajo)
    {
        $trabajo->load('reporte', 'empleados', 'reporte.cliente', 'reporte.direccionAdicional');
        return view('pages.trabajos.show', compact('trabajo'));
    }

    // Editar
    public function edit(Trabajo $trabajo)
    {
        $trabajo->load('reporte', 'empleados');
        $reportes = ReporteFalla::all();
        $empleados = Empleado::with('user')->get();
        $empleadosAsignados = $trabajo->empleados->pluck('id')->toArray();
        $encargado = $trabajo->empleados->where('pivot.is_encargado', true)->first();
        return view('pages.trabajos.edit', compact('trabajo', 'reportes', 'empleados', 'empleadosAsignados', 'encargado'));
    }

    // Actualizar
    public function update(UpdateTrabajoRequest $request, Trabajo $trabajo)
    {
        try {
            DB::beginTransaction();
            // Actualizar trabajo
            $trabajo->update([
                'tipo_trabajo' => $request->tipo_trabajo,
                'descripcion' => $request->descripcion,
                'prioridad' => $request->prioridad,
                'materiales' => $request->materiales,
                'observaciones_materiales' => $request->observaciones_materiales
            ]);
            // Actualizar reporte
            if ($request->has('estado_reporte')) {
                $trabajo->reporte->update(['estado' => $request->estado_reporte]);
            }
            // Actualizar empleados 
            if ($request->has('empleados')) {
                // Eliminar asignaciones 
                $trabajo->empleados()->detach();
                // Crear asignaciones
                $empleados = $request->empleados;
                $encargado = $request->encargado_id;
                foreach ($empleados as $empleadoId) {
                    $trabajo->empleados()->attach($empleadoId, [
                        'is_encargado' => ($empleadoId == $encargado)
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('trabajos.index')->with('success', 'Trabajo actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar el trabajo: ' . $e->getMessage())->withInput();
        }
    }

    // Eliminar
    public function destroy(Trabajo $trabajo)
    {
        try {
            DB::beginTransaction();
            // Eliminar relaciones - empleados
            $trabajo->empleados()->detach();
            // Eliminar el trabajo
            $trabajo->delete();
            DB::commit();
            return redirect()->route('trabajos.index')->with('success', 'Trabajo eliminado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar el trabajo: ' . $e->getMessage());
        }
    }
}
