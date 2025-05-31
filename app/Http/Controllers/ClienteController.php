<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('pages.clientes.clientes', compact('clientes'));
        
    }

    // Guardar un nuevo cliente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_cliente' => 'required|in:empresa,gobierno,educacion,residencial',
            'nombre_cliente' => 'required|string|max:100',
            'nit_ci' => 'required|string|max:20|unique:clientes,nit_ci',
            'rubro' => 'nullable|string|max:100',
            'direccion_principal' => 'required|string',
            'telefono' => 'required|numeric|digits_between:1,20',
            'celular' => 'nullable|string|max:20',
            'email_acceso' => 'required|email|max:100|unique:clientes,email_acceso',
            'contrasena' => 'required|string|min:6',
            'referencia' => 'nullable|in:recomendacion,publicidad,busqueda,redes,otro',
            'observaciones' => 'nullable|string',
        ],[
            'tipo_cliente.required' => 'El tipo de cliente es obligatorio.',
            'nombre_cliente.required' => 'El nombre del cliente es obligatorio.',
            'nit_ci.required' => 'El NIT/CI es obligatorio.',
            'nit_ci.unique' => 'El NIT/CI ya está en uso.',
            'email_acceso.required' => 'El email de acceso es obligatorio.',
            'email_acceso.email' => 'El email de acceso debe ser una dirección de correo válida.',
            'email_acceso.unique' => 'El email de acceso ya está en uso.',
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser un número.',
            'direccion_principal.required' => 'La dirección principal es obligatoria.',
        ]);


        $validated['contrasena'] = bcrypt($validated['contrasena']);

        try {
            $cliente = Cliente::create($validated);
            return redirect()->route('clientes.index')->with('success', 'Cliente guardado exitosamente.');
        } catch (\Exception $e) {
            dd('Error al guardar cliente: ' . $e->getMessage());
        }
    }

    // Actualizar un cliente existente

    public function update(Request $request, $id)
    {
        $cliente = Cliente::where('id_cliente', $id)->firstOrFail();

        $validated = $request->validate([
            'tipo_cliente' => 'required|in:empresa,gobierno,educacion,residencial',
            'nombre_cliente' => 'required|string|max:100',
            'nit_ci' => 'required|string|max:20|unique:clientes,nit_ci,' . $cliente->id_cliente . ',id_cliente',
            'rubro' => 'nullable|string|max:100',
            'direccion_principal' => 'required|string',
            'telefono' => 'required|numeric|digits_between:1,20',
            'celular' => 'nullable|string|max:20',
            'email_acceso' => 'required|email|max:100|unique:clientes,email_acceso,' . $cliente->id_cliente . ',id_cliente',
            'contrasena' => 'nullable|string|min:6',
            'referencia' => 'nullable|in:recomendacion,publicidad,busqueda,redes,otro',
            'observaciones' => 'nullable|string',
        ],[
            'tipo_cliente.required' => 'El tipo de cliente es obligatorio.',
            'nombre_cliente.required' => 'El nombre del cliente es obligatorio.',
            'nit_ci.required' => 'El NIT/CI es obligatorio.',
            'nit_ci.unique' => 'El NIT/CI ya está en uso.',
            'email_acceso.required' => 'El email de acceso es obligatorio.',
            'email_acceso.email' => 'El email de acceso debe ser una dirección de correo válida.',
            'email_acceso.unique' => 'El email de acceso ya está en uso.',
            'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser un número.',
            'direccion_principal.required' => 'La dirección principal es obligatoria.',
        ]);

        if ($request->filled('contrasena')) {
            $validated['contrasena'] = bcrypt($validated['contrasena']);
        } else {
            unset($validated['contrasena']);
        }

        try {
            $cliente->update($validated);
            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
        } catch (\Exception $e) {
            dd('Error al actualizar cliente: ' . $e->getMessage());
        }
    }


}
