<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Empleado;
use App\Models\ReporteFalla;
use App\Http\Requests\StoreTrabajoRequest;
use App\Http\Requests\UpdateTrabajoRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use Str;

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
        $fechaLimite = Carbon::now()->subMonths(3);

        $trabajos = Trabajo::with(['empleados.user', 'reporte.cliente'])
            ->whereHas('reporte', fn($q) => $q->whereDate('created_at', '>=', $fechaLimite))
            ->get();

        if ($trabajos->isEmpty()) {
            return redirect()->back()->with('error', 'No hay trabajos en los últimos 3 meses.');
        }

        $pdf = new Fpdf('L');
        $pdf->AddPage();
        $pdf->SetMargins(20, 20, 20);

        // Encabezado
        $pdf->Image(public_path('images/logodatalan.png'), 20, 10, 30);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->SetXY(0, 15);
        $pdf->Cell(0, 10, 'Fecha: ' . now()->format('d/m/Y H:i:s'), 0, 1, 'R');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(34, 34, 34);
        $titulo = 'REPORTE DE TRABAJOS (Últimos 3 meses desde ' . $fechaLimite->format('d/m/Y') . ')';
        $pdf->Cell(0, 12, utf8_decode($titulo), 0, 1, 'C');
        $pdf->SetDrawColor(100, 100, 255);
        $pdf->SetLineWidth(0.6);
        $pdf->Line(20, $pdf->GetY(), 285, $pdf->GetY());
        $pdf->Ln(10);

        // Estilos de tabla
        $headers = [
            ['label' => 'Tipo de Trabajo',     'width' => 40],
            ['label' => 'Prioridad',           'width' => 30],
            ['label' => 'Descripción Error',   'width' => 55],
            ['label' => 'Cliente',             'width' => 45],
            ['label' => 'Estado',              'width' => 30],
            ['label' => 'Empleados',           'width' => 65],
        ];

        // Encabezado de tabla
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(54, 79, 107); // Azul oscuro
        $pdf->SetTextColor(255);
        foreach ($headers as $h) {
            $pdf->Cell($h['width'], 10, utf8_decode($h['label']), 1, 0, 'C', true);
        }
        $pdf->Ln();

        // Filas de datos
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(30);
        $fill = false;

        foreach ($trabajos as $trabajo) {
            $tipo = utf8_decode($trabajo->tipo_trabajo ?? '');
            $prioridad = utf8_decode($trabajo->prioridad ?? '');
            $descripcion = utf8_decode(Str::limit($trabajo->reporte->descripcion ?? '', 60));
            $cliente = utf8_decode($trabajo->reporte->cliente->nombre ?? '');
            $estado = utf8_decode($trabajo->reporte->estado ?? '');

            $empleadosTexto = collect($trabajo->empleados)
                ->map(fn($e) => $e->user->name ?? '')
                ->filter()
                ->implode("\n");
            $empleadosTexto = utf8_decode($empleadosTexto);

            $lineHeight = 6;
            $lineCount = max(
                substr_count($empleadosTexto, "\n") + 1,
                1
            );
            $cellHeight = $lineHeight * $lineCount;

            // Alternar color de fondo
            $pdf->SetFillColor($fill ? 245 : 255, $fill ? 245 : 255, $fill ? 245 : 255);

            $pdf->Cell($headers[0]['width'], $cellHeight, $tipo, 1, 0, 'L', true);
            $pdf->Cell($headers[1]['width'], $cellHeight, $prioridad, 1, 0, 'L', true);
            $pdf->Cell($headers[2]['width'], $cellHeight, $descripcion, 1, 0, 'L', true);
            $pdf->Cell($headers[3]['width'], $cellHeight, $cliente, 1, 0, 'L', true);
            $pdf->Cell($headers[4]['width'], $cellHeight, $estado, 1, 0, 'L', true);

            // MultiCell para empleados
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell($headers[5]['width'], $lineHeight, $empleadosTexto, 1, 'L', true);
            $pdf->SetXY($x + $headers[5]['width'], $y);

            $pdf->Ln($cellHeight);
            $fill = !$fill;
        }

        $pdf->Output('I', 'Reporte_Trabajos_Ultimos_3_Meses.pdf');
        exit;
    }

}
