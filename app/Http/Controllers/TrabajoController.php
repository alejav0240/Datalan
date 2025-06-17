<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Empleado;
use App\Models\ReporteFalla;
use App\Http\Requests\StoreTrabajoRequest;
use App\Http\Requests\UpdateTrabajoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;

class TrabajoController extends Controller
{
    // Filtros
    public function index(Request $request)
    {
        // Consulta base
        $query = Trabajo::with(['reporte', 'empleados']);

        // Solo mostrar trabajos asignados 
        if (auth()->user()->role === 'empleado') {
            $query->whereHas('empleados', function($q) {
                $q->where('user_id', auth()->user()->id);
            });
        }

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
            $query->whereHas('reporte', function ($q) use ($request) {
                $q->where('estado', $request->estado);
            });
        }
        // Buscar
        if ($request->filled('search')) {
            $query->where('descripcion', 'like', '%' . $request->search . '%');
        }
        // Ordenar y paginar
        $trabajos = $query->orderBy('created_at', 'desc')->paginate(10);
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

    // Reportes de trabajo
    public function generarTrabajosPDF()
    {
        // Traer todos los trabajos con empleados y datos relacionados para optimizar consultas
        $trabajos = Trabajo::with(['empleados.user', 'reporte.cliente'])->get();

        if ($trabajos->isEmpty()) {
            return redirect()->back()->with('error', 'No hay trabajos para generar el reporte.');
        }

        $pdf = new Fpdf('L');
        $pdf->AddPage();
        $pdf->SetMargins(25, 25, 25);

        // Logo y fecha en la parte superior
        $pdf->Image(public_path('images/logodatalan.png'), 25, 10, 30);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(100, 100, 100);
        $fecha = date('d/m/Y H:i:s');
        $pdf->SetXY(0, 15);
        $pdf->Cell(0, 10, 'Fecha: ' . $fecha, 0, 1, 'R');

        $pdf->Ln(10);

        // Título del reporte
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->SetTextColor(40, 40, 40);
        $pdf->Cell(0, 15, mb_convert_encoding('REPORTE GENERAL DE TRABAJOS', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        // Línea decorativa
        $pdf->SetDrawColor(79, 129, 189);
        $pdf->SetLineWidth(0.75);
        $pdf->Line(25, $pdf->GetY(), 270, $pdf->GetY());
        $pdf->Ln(15);

        // Encabezados de tabla
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetDrawColor(180, 180, 180);
        $pdf->Cell(40, 10, 'Tipo de Trabajo', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Prioridad', 1, 0, 'C', true);
        $pdf->Cell(50, 10, mb_convert_encoding('Descripción Error', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Cliente', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'Estado', 1, 0, 'C', true);
        $pdf->Cell(65, 10, 'Empleados', 1, 1, 'C', true);

        // Cuerpo de la tabla con datos
        $pdf->SetFont('Arial', '', 11);
        foreach ($trabajos as $trabajo) {
            $tipoTrabajo = mb_convert_encoding($trabajo->tipo_trabajo ?? '', 'ISO-8859-1', 'UTF-8');
            $prioridad = mb_convert_encoding($trabajo->prioridad ?? '', 'ISO-8859-1', 'UTF-8');
            $descripcionError = mb_convert_encoding($trabajo->reporte->descripcion ?? '', 'ISO-8859-1', 'UTF-8');
            $cliente = mb_convert_encoding($trabajo->reporte->cliente->nombre ?? '', 'ISO-8859-1', 'UTF-8');
            $estado = mb_convert_encoding($trabajo->reporte->estado ?? '', 'ISO-8859-1', 'UTF-8');

            // Preparar lista de empleados con saltos de línea
            $nombres = '';
            foreach ($trabajo->empleados as $empleado) {
                $nombres .= ($empleado->user->name ?? '') . "\n";
            }
            $nombres = mb_convert_encoding(trim($nombres), 'ISO-8859-1', 'UTF-8');

            // Altura estimada de la fila (por ejemplo 6 por línea)
            $lineHeight = 6;
            $lineCount = substr_count($nombres, "\n") + 1;
            $cellHeight = $lineHeight * $lineCount;

            // Imprimir las celdas que son de una sola línea
            $pdf->Cell(40, $cellHeight, $tipoTrabajo, 1);
            $pdf->Cell(30, $cellHeight, $prioridad, 1);
            $pdf->Cell(50, $cellHeight, $descripcionError, 1);
            $pdf->Cell(40, $cellHeight, $cliente, 1);
            $pdf->Cell(25, $cellHeight, $estado, 1);

            // Imprimir lista de empleados con MultiCell
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell(65, $lineHeight, $nombres, 1);

            // Mover cursor a la derecha para la siguiente fila
            $pdf->SetXY($x + 65, $y + $cellHeight);

            // Nueva línea para la siguiente fila
            $pdf->Ln(0);
        }


        // Enviar el PDF al navegador
        $pdf->Output('I', 'Reporte_Trabajos.pdf');
        exit;
    }
}
