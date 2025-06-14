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
        // Consulta
        $query = Trabajo::with(['reporte', 'empleados']);
        // Prioridad
        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }
        // Tipo de trabajo
        if ($request->filled('tipo_trabajo')) { 
            $query->where('tipo_trabajo', $request->tipo_trabajo);
        }
        // Estado
        if ($request->filled('estado')) {
            $query->whereHas('reporte', function($q) use ($request) {
                $q->where('estado', $request->estado);
            });
        }
        // Buscar
        if ($request->filled('search')) {
            $query->where('descripcion', 'like', '%' . $request->search . '%');
        }
        // Ordenar
        $trabajos = $query->orderBy('created_at', 'desc')->get();
        return view('pages.trabajos.index', compact('trabajos'));
    }

    // Crear
    public function create()
    {
        // Reportes en estado pendiente
        $reportes = ReporteFalla::where('estado', 'pendiente')->get();
        // Empleados
        $empleados = Empleado::with('user')->get();
        return view('pages.trabajos.create', compact('reportes', 'empleados'));
    }

    // Guardar
    public function store(StoreTrabajoRequest $request)
    {
        try {
            DB::beginTransaction();
            // Crear trabajo
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
                    // Asignar encargado
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
        // Cargar relaciones
        $trabajo->load('reporte', 'empleados', 'reporte.cliente', 'reporte.direccionAdicional');
        return view('pages.trabajos.show', compact('trabajo'));
    }

    // Editar
    public function edit(Trabajo $trabajo)
    {
        // Cargar relaciones
        $trabajo->load('reporte', 'empleados');
        // Reportes
        $reportes = ReporteFalla::all();
        // Empleados
        $empleados = Empleado::with('user')->get();
        // Empleados asignados
        $empleadosAsignados = $trabajo->empleados->pluck('id')->toArray();
        // Encargado
        $encargado = $trabajo->empleados->where('pivot.is_encargado', true)->first();
        return view('pages.trabajos.edit', compact('trabajo', 'reportes', 'empleados', 'empleadosAsignados', 'encargado'));
    }

    // Actualizar
    public function update(UpdateTrabajoRequest $request, Trabajo $trabajo)
    {
        try {
            DB::beginTransaction();
            // Actualizar campos
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
