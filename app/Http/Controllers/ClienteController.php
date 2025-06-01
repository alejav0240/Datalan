<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    // Método para obtener las reglas de validación
    protected function validationRules($clienteId = null)
    {
        return [
            'tipo_cliente' => 'required|in:empresa,gobierno,educacion,residencial',
            'nombre_cliente' => 'required|string|max:100',
            'nit_ci' => 'required|string|max:20|unique:clientes,nit_ci' . ($clienteId ? ",$clienteId,id_cliente" : ''),
            'rubro' => 'nullable|string|max:100',
            'direccion_principal' => 'required|string',
            'telefono' => 'required|numeric|digits_between:1,20',
            'celular' => 'nullable|string|max:20',
            'email_acceso' => 'required|email|max:100|unique:clientes,email_acceso' . ($clienteId ? ",$clienteId,id_cliente" : ''),
            'contrasena' => 'nullable|string|min:6',
            'referencia' => 'nullable|in:recomendacion,publicidad,busqueda,redes,otro',
            'observaciones' => 'nullable|string',
        ];
    }

    // Método para las validaciones personalizadas
    protected function validationMessages()
    {
        return [
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
        ];
    }

    // Index de clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('pages.clientes.clientes', compact('clientes'));
    }

    // Guardar un nuevo cliente
    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules(), $this->validationMessages());
        $validated['contrasena'] = bcrypt($validated['contrasena']);

        try {
            $cliente = Cliente::create($validated);

            // Crear usuario asociado al cliente
            User::create([
                'name' => $validated['nombre_cliente'],
                'email' => $validated['email_acceso'],
                'password' => $validated['contrasena'],
                'nivel_acceso' => 'cliente',
                'activo' => true,
            ]);

            return redirect()->route('clientes.index')->with('success', 'Cliente guardado exitosamente.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar cliente: ' . $e->getMessage());
        }
    }

    // Actualizar un cliente existente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $validated = $request->validate($this->validationRules($id), $this->validationMessages());

        if ($request->filled('contrasena')) {
            $validated['contrasena'] = bcrypt($validated['contrasena']);
        } else {
            unset($validated['contrasena']);
        }

        try {
            $cliente->update($validated);

            // Actualizar usuario asociado al cliente
            $user = User::where('email', $cliente->email_acceso)->first();
            if ($user) {
                $user->update([
                    'name' => $validated['nombre_cliente'],
                    'email' => $validated['email_acceso'],
                    'password' => $validated['contrasena'] ?? $user->password,
                ]);
            }

            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'edit-' . $cliente->id_cliente);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar cliente: ' . $e->getMessage());
        }
    }

    // Eliminar cliente (poner en estado inactivo)
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        try {
            $cliente->activo = false;
            $cliente->save();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar cliente: ' . $e->getMessage());
        }
    }

    // Restaurar cliente (poner en estado activo)
    public function enable($id)
    {
        $cliente = Cliente::findOrFail($id);
        try {
            $cliente->activo = true;
            $cliente->save();
            return redirect()->route('clientes.index')->with('success', 'Cliente restaurado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al restaurar cliente: ' . $e->getMessage());
        }
    }
}
