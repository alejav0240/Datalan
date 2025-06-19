<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los filtros desde el request
        $filters = $request->only(['cargo', 'estado_civil', 'salario_min','search','is_active']);

        $empleados = Empleado::with('user')
            ->filter($filters)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $totalEmpleados = Empleado::count();
        $salarioPromedio = Empleado::avg('salario');
        $totalCasados = Empleado::where('estado_civil', 'casado')->count();
        $totalConExperiencia = Empleado::where('experiencia', '>', 5)->count();
        $cargos = Empleado::select('cargo')->distinct()->pluck('cargo');
        $estados_civiles = Empleado::select('estado_civil')->distinct()->pluck('estado_civil');

        return view('pages.empleados.index', compact('empleados', 'totalEmpleados', 'salarioPromedio', 'totalCasados', 'totalConExperiencia', 'cargos','estados_civiles'));
    }
    public function create()
    {
        return view('pages.empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpleadoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            // Crear el usuario
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => 'empleado',
                'password' => bcrypt($validated['password']),
            ]);

            // Crear el empleado asociado al usuario
            Empleado::create(array_merge($validated, ['user_id' => $user->id]));
        });

        return redirect()->route('empleados.index')->with('success', 'Empleado y usuario creados exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        $empleado->load('user', 'trabajos', 'permisos');
        return view('pages.empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        $empleado->load('user');
        return view('pages.empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpleadoRequest $request, Empleado $empleado): RedirectResponse
    {
        // Validar los datos
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $empleado) {
            // Actualizar el usuario asociado
            $empleado->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                //'password' => isset($validated['password']) ? bcrypt($validated['password']) : $empleado->user->password,
            ]);

            // Actualizar el empleado
            $empleado->update($validated);
        });

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado): RedirectResponse
    {
        $user = User::find($empleado->user_id);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
