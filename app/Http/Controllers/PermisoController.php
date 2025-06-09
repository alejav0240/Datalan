<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Http\Requests\StorePermisoRequest;
use App\Http\Requests\UpdatePermisoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
}
