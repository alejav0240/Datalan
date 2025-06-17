<?php

namespace App\Http\Controllers;

use App\Models\ReporteFalla;
use App\Models\Cliente;
use App\Models\DireccionAdicional;
use App\Http\Requests\StoreReporteFallaRequest;
use App\Http\Requests\UpdateReporteFallaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteFallaController extends Controller
{
    // MÉTODOS PARA ADMINISTRADORES
    // Obtener reportes
    public function index(Request $request)
    {
        // Consulta base
        $query = ReporteFalla::with(['cliente', 'direccionAdicional']);

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Búsqueda por descripción o nombre del cliente
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('descripcion', 'like', '%' . $search . '%')
                  ->orWhereHas('cliente', function($q) use ($search) {
                      $q->where('nombre', 'like', '%' . $search . '%');
                  });
            });
        }

        // Ordenar por fecha de creación y paginar
        $reportes = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.reportes.index', compact('reportes'));
    }
    // Editar
    public function edit(ReporteFalla $reporte)
    {

        $clientes = Cliente::all();
        $direcciones = DireccionAdicional::where('id_cliente', $reporte->cliente_id)->get();
        return view('pages.reportes.edit', compact('reporte', 'clientes', 'direcciones'));
    }
    // Actualizar
    public function update(UpdateReporteFallaRequest $request, ReporteFalla $reporte)
    {

        try {
            // El administrador solo puede cambiar el estado
            $reporte->update([
                'estado' => $request->estado ?? $reporte->estado,
            ]);
            return redirect()->route('reportes.index')
                ->with('success', 'Estado del reporte actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el reporte de falla: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    // Obtener direcciones por cliente (para AJAX)
    public function getDireccionesPorCliente($clienteId)
    {
        $direcciones = DireccionAdicional::where('id_cliente', $clienteId)->get();
        return response()->json($direcciones);
    }
    
    // MÉTODOS PARA CLIENTES
    // Guardar reporte
    public function clienteStore(Request $request)
    {
        // Validar datos
        $request->validate([
            'tipo_falla' => 'required|string|in:hardware,software,conectividad,otro',
            'direccion_adicional_id' => 'required|exists:direcciones_adicionales,id',
            'descripcion' => 'required|string|max:500',
        ]);
        try {
            // Obtener el cliente autenticado
            $cliente = Cliente::where('user_id', Auth::user()->id)->first();
            
            if (!$cliente) {
                return redirect()->back()->with('error', 'No se encontró información de cliente asociada a su cuenta.')->withInput();
            }
            // Verificar que la dirección pertenezca al cliente
            $direccion = DireccionAdicional::where('id', $request->direccion_adicional_id)
                ->where('id_cliente', $cliente->id)
                ->first();   
            if (!$direccion) {
                return redirect()->back()->with('error', 'La dirección seleccionada no es válida.')->withInput();
            }
            // Crear el reporte
            $reporte = ReporteFalla::create([
                'cliente_id' => $cliente->id,
                'direccion_adicional_id' => $request->direccion_adicional_id,
                'tipo_falla' => $request->tipo_falla,
                'descripcion' => $request->descripcion,
                'estado' => 'pendiente', 
            ]);
            
            return redirect()->route('inicio')->with('success', 'Reporte de falla creado exitosamente. Pronto nos pondremos en contacto con usted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el reporte de falla: ' . $e->getMessage())->withInput();
        }
    }
    
    // Eliminar reporte (para clientes)
    public function clienteDestroy($id)
    {
        try {
            // Obtener el cliente autenticado
            $cliente = Cliente::where('user_id', Auth::user()->id)->first();
            if (!$cliente) {
                return redirect()->route('inicio')->with('error', 'No se encontró información de cliente asociada a su cuenta.');
            }
            // Obtener el reporte asegurándose que pertenezca al cliente
            $reporte = ReporteFalla::where('id', $id)
                ->where('cliente_id', $cliente->id)
                ->first();
                
            if (!$reporte) {
                return redirect()->route('inicio')->with('error', 'El reporte solicitado no existe o no tiene permisos para eliminarlo.');
            }
            // Si el reporte no está en estado pendiente, no se puede eliminar
            if ($reporte->estado != 'pendiente') {
                return redirect()->route('inicio')->with('error', 'Solo puede eliminar reportes en estado pendiente.');
            }
            // Eliminar el reporte
            $reporte->delete();
            return redirect()->route('inicio')->with('success', 'Reporte de falla eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('inicio')->with('error', 'Error al eliminar el reporte de falla: ' . $e->getMessage());
        }
    }
    
    // Obtener reportes del cliente
    public function clienteReportes()
    {
        // Obtener el cliente autenticado
        $cliente = Cliente::where('user_id', Auth::user()->id)->first();
        if (!$cliente) {
            return response()->json([]);
        }
        // Obtener los reportes del cliente
        $reportes = ReporteFalla::where('cliente_id', $cliente->id)
            ->with('direccionAdicional')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($reportes);
    }
}
