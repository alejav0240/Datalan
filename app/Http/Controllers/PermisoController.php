<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Http\Requests\StorePermisoRequest;
use App\Http\Requests\UpdatePermisoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermisoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permiso $permiso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermisoRequest $request, Permiso $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permiso $permiso)
    {
        //
    }
}
