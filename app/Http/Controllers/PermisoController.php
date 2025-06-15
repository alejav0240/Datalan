<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Http\Requests\StorePermisoRequest;
use App\Http\Requests\UpdatePermisoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;

class PermisoController extends Controller
{

    public function index()
    {
        // Si el usuario no es administrador, obtener los permisos del usuario
        if (Auth::user()->role !== 'administrador') {
            // Obtiene el empleado relacionado con el usuario actual
            $empleado = Empleado::where('user_id', Auth::id())->first();
            
            // Obtiene los permisos asociados a ese empleado
            $permisos = $empleado ? $empleado->permisos : collect(); // Si no se encuentra el empleado, retorna una colección vacía
        }
        // Si el usuario es administrador, obtiene todos los permisos
        else {
            $permisos = Permiso::all();
        }

        // Devuelve la vista con los permisos
        return view('pages.permisos.index', compact('permisos'));
    }


    // =========== Formulario para crear un nuevo permiso =========== //
    public function create()
    {
        return view('pages.permisos.formulario_permisos');
    }


    // =========== Almacena un nuevo permiso =========== //
    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'motivo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',    
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ], [
            'empleado_id.required' => 'El campo empleado es obligatorio.',
            'empleado_id.exists' => 'El empleado seleccionado no existe.',
            'motivo.required' => 'El motivo del permiso es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',       
        ]);

        // Verificar lo que llega en los datos (esto puede ser removido después de la prueba)
        // dd([
        //     'empleado_id' => $request->empleado_id,
        //     'motivo' => $request->motivo,
        //     'fecha_inicio' => $fecha_inicio,
        //     'fecha_fin' => $fecha_fin
        // ]);

        // Crear el permiso
        Permiso::create([
            'empleado_id' => $request->empleado_id,
            'motivo' => $request->motivo,
            'fecha_inicio' => $request->fecha_inicio, // Fecha en formato 'Y-m-d'
            'fecha_fin' => $request->fecha_fin, // Fecha en formato 'Y-m-d'
        ]);

        return redirect()->route('permisos.index')->with('success', 'Permiso registrado correctamente.');
    }


    // =========== Muestra un permiso específico =========== //

    public function show(Permiso $permiso)
    {
        //
    }


    // =========== Edita un permiso específico =========== //
    public function edit(Permiso $permiso)
    {
        return view('pages.permisos.formulario_permisos', compact('permiso'));
    }

    // =========== Actualiza un permiso específico =========== //
    public function update(Request $request, Permiso $permiso)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'motivo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',    
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ], [
            'empleado_id.required' => 'El campo empleado es obligatorio.',
            'empleado_id.exists' => 'El empleado seleccionado no existe.',
            'motivo.required' => 'El motivo del permiso es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',       
        ]);

        // Actualizar el permiso
        $permiso->update([
            'empleado_id' => $request->empleado_id,
            'motivo' => $request->motivo,
            'fecha_inicio' => $request->fecha_inicio, // Fecha en formato 'Y-m-d'
            'fecha_fin' => $request->fecha_fin, // Fecha en formato 'Y-m-d'
        ]);

        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado correctamente.');
    }

    public function destroy(Permiso $permiso)
    {
        // Verificar si el permiso ya ha sido procesado
        if ($permiso->estado !== 'pendiente') {
            return redirect()->route('permisos.index')->with('error', 'No se puede eliminar un permiso que ya ha sido procesado.');
        }

        // Eliminar el permiso
        $permiso->delete();

        return redirect()->route('permisos.index')->with('success', 'Permiso eliminado correctamente.');
    }

    // =========== Aprobar un permiso =========== //
    public function aprobar(Permiso $permiso)
    {
        // Verificar si el permiso ya está aprobado o rechazado
        if ($permiso->estado !== 'pendiente') {
            return redirect()->route('permisos.index')->with('error', 'El permiso ya ha sido procesado.');
        }

        // Actualizar el estado del permiso a 'aprobado'
        $permiso->update(['estado' => 'aprobado']);

        return redirect()->route('permisos.index')->with('success', 'Permiso aprobado.');
    }

    // =========== Rechazar un permiso =========== //
    public function rechazar(Permiso $permiso)
    {
        // Verificar si el permiso ya está aprobado o rechazado
        if ($permiso->estado !== 'pendiente') {
            return redirect()->route('permisos.index')->with('error', 'El permiso ya ha sido procesado.');
        }

        // Actualizar el estado del permiso a 'rechazado'
        $permiso->update(['estado' => 'rechazado']);

        return redirect()->route('permisos.index')->with('success', 'Permiso rechazado.');
    }

    // =========== Generar PDF del permiso =========== //
    public function generarPermisoPDF(Permiso $permiso)
    {
        if (!$permiso) {
            return redirect()->route('permisos.index')->with('error', 'Permiso no encontrado.');
        }

        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetMargins(25, 25, 25);

        // Logo de Datalan Bolivia
        $pdf->Image(public_path('images/logodatalan.png'), 25, 10, 30); // X=25, Y=10, Ancho=30mm
        $pdf->Ln(25); // Espacio después del logo

        // Encabezado
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->SetTextColor(40, 40, 40);
        $pdf->Cell(0, 15, mb_convert_encoding('SOLICITUD DE PERMISO LABORAL', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        // Línea decorativa
        $pdf->SetDrawColor(79, 129, 189);
        $pdf->SetLineWidth(0.75);
        $pdf->Line(25, $pdf->GetY(), 190, $pdf->GetY());
        $pdf->Ln(15);

        // Información
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetTextColor(60, 60, 60);

        $nombre = mb_convert_encoding($permiso->empleado->user->name, 'ISO-8859-1', 'UTF-8');
        $cargo = mb_convert_encoding($permiso->empleado->cargo, 'ISO-8859-1', 'UTF-8');
        $carnet = mb_convert_encoding($permiso->empleado->ci, 'ISO-8859-1', 'UTF-8');
        $motivo = mb_convert_encoding($permiso->motivo, 'ISO-8859-1', 'UTF-8');
        $fechaInicio = Carbon::parse($permiso->fecha_inicio)->format('d/m/Y');
        $fechaFin = $permiso->fecha_fin ? Carbon::parse($permiso->fecha_fin)->format('d/m/Y') : 'N/A';
        $estado = mb_convert_encoding(ucfirst($permiso->estado), 'ISO-8859-1', 'UTF-8');

        $pdf->SetFillColor(245, 245, 245);
        $pdf->SetDrawColor(200, 200, 200);
        $pdf->Rect(25, $pdf->GetY(), 160, 80, 'DF');

        $pdf->SetXY(30, $pdf->GetY() + 10);
        $texto = "Yo, $nombre, identificado con documento No. $carnet, cargo $cargo, solicito permiso laboral por el siguiente motivo:";
        $pdf->MultiCell(0, 7, $texto, 0, 'L');

        $pdf->SetXY(30, $pdf->GetY() + 5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(0, 7, $motivo, 0, 'L');

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(30, $pdf->GetY() + 5);
        $pdf->MultiCell(0, 7, "Periodo solicitado: Desde el $fechaInicio hasta el $fechaFin.", 0, 'L');

        $pdf->SetXY(30, $pdf->GetY() + 5);
        $pdf->MultiCell(0, 7, "Estado actual de la solicitud: $estado.", 0, 'L');

        // Firma del solicitante más abajo
        $pdf->SetY(-75);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(100, 100, 100);

        $pdf->Cell(0, 7, mb_convert_encoding('Firma del Solicitante', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $pdf->Ln(20);
        $pdf->Cell(0, 1, '', 'B', 1, 'C'); // Línea de firma
        $pdf->Ln(5);
        $pdf->Cell(0, 7, $nombre, 0, 1, 'C');
        $pdf->Cell(0, 7, mb_convert_encoding('Empleado', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

        $pdf->Output('I', 'Solicitud_Permiso_' . $permiso->id . '.pdf');
        exit;
    }


   

}
