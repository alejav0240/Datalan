<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    // Método para obtener las reglas de validación
    protected function validationRules($clienteId = null)
    {
        return [
            'tipo_cliente' => 'required|in:empresa,gobierno,educacion,residencial',
            'nombre' => 'required|string|max:100',
            'nit_ci' => 'required|string|max:20|unique:clientes,nit_ci' . ($clienteId ? ",$clienteId" : ''),
            'telefono' => 'required|regex:/^[67][0-9]{7}$/',
            'email_acceso' => 'required|email|unique:users,email' . ($clienteId ? ',' . Cliente::find($clienteId)->user_id : ''),
            'contrasena' => ($clienteId ? 'nullable' : 'required') . '|string|min:6',
        ];
    }

    protected function validationMessages()
    {
        return [
            'tipo_cliente.required' => 'El tipo de cliente es obligatorio.',
            'nombre.required' => 'El nombre del cliente es obligatorio.',
            'nit_ci.required' => 'El NIT/CI es obligatorio.',
            'nit_ci.unique' => 'El NIT/CI ya está en uso.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe ser un número.',
            'telefono.regex' => 'El teléfono debe ser válido',
            'email_acceso.required' => 'El correo es obligatorio.',
            'email_acceso.email' => 'El correo debe ser válido.',
            'email_acceso.unique' => 'El correo ya está en uso.',
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ];
    }

    // =========================== LISTAR CLIENTES ========================== //
    public function index(Request $request)
    {
        $clientes = Cliente::with('user')->get();
        return view('pages.clientes.index', compact('clientes'));
    }

    // ========================== VER DETALLES CLIENTE ========================== //

    public function show(Cliente $cliente)
    {
        $cliente->load('user', 'direcciones', 'reportes_falla');
        return view('pages.clientes.show', compact('cliente'));
    }




    // ========================== REGISTRAR CLIENTE ========================== //


    public function create()
    {
        return view('pages.clientes.formulario_clientes');
    }


    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules(), $this->validationMessages());

        if (!empty($validated['contrasena'])) {
            $validated['contrasena'] = bcrypt($validated['contrasena']);
        } else {
            return redirect()->back()->withErrors(['contrasena' => 'La contraseña es obligatoria'])->withInput();
        }

        try {
            // Crear el usuario
            $user = User::create([
                'name' => $validated['nombre'],
                'email' => $validated['email_acceso'],
                'password' => $validated['contrasena'],
                'is_active' => true,
                'role' => 'cliente',
            ]);

            // Crear el cliente
            $clienteData = $validated;
            $clienteData['user_id'] = $user->id;
            unset($clienteData['email_acceso'], $clienteData['contrasena']);

            Cliente::create($clienteData);

            if (!Auth::check()) {
                return redirect()->route('login')->with('success', 'Cliente registrado exitosamente. Por favor, inicie sesión.');
            } else {
                return redirect()->route('clientes.index')->with('success', 'Cliente guardado exitosamente.');
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar cliente: ' . $e->getMessage());
        }
    }


    // ========================== EDITAR CLIENTE ========================== //
     

    public function edit($id)
    {
        $cliente = Cliente::with('user')->findOrFail($id);
        return view('pages.clientes.formulario_clientes', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::with('user')->findOrFail($id);

        $validated = $request->validate($this->validationRules($id), $this->validationMessages());

        // Si se envió una nueva contraseña, la encriptamos
        if ($request->filled('contrasena')) {
            $validated['contrasena'] = bcrypt($validated['contrasena']);
        } else {
            unset($validated['contrasena']);
        }

        try {
            // Actualizar datos del cliente
            $cliente->update([
                'tipo_cliente' => $validated['tipo_cliente'],
                'nombre' => $validated['nombre'],
                'nit_ci' => $validated['nit_ci'],
                'telefono' => $validated['telefono'],
            ]);

            // Actualizar usuario asociado
            $user = $cliente->user;
            if ($user) {
                $user->update([
                    'name' => $validated['nombre'],
                    'email' => $validated['email_acceso'],
                    'password' => $validated['contrasena'] ?? $user->password,
                ]);
            }

            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar cliente: ' . $e->getMessage());
        }
    }


    // Eliminar cliente (poner en estado inactivo)
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        try {
            // Encontrar el usuario asociado y desactivarlo
            $user = $cliente->user;
            if ($user) {
            $user->is_active = false;
            $user->save();
            }

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
            $user = $cliente->user;
            if ($user) {
                $user->is_active = true;
                $user->save();
            }
            return redirect()->route('clientes.index')->with('success', 'Cliente restaurado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al restaurar cliente: ' . $e->getMessage());
        }
    }
}
