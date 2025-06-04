<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'ci' => 'required|string|max:20|unique:empleados,ci',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:empleados,email',
            'cargo' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'fecha_ingreso' => 'nullable|date',
            'salario' => 'nullable|numeric|min:0',
            'tipo_contrato' => 'nullable|string|in:indefinido,temporal',
            'genero' => 'required|string|in:masculino,femenino',
            'estado_civil' => 'required|string|in:soltero,casado,divorciado,viudo',
            'direccion' => 'nullable|string|max:255',
            'habilidades' => 'nullable|string|max:500',
            'observaciones' => 'nullable|string|max:500',
        ];
    }
}
