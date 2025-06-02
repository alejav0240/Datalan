<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
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
            //'nombres' => 'required|string|max:255',
            //'apellidos' => 'required|string|max:255',
            //'ci' => 'required|string|max:20|unique:empleados,ci,' . $this->empleado->id_empleado,
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|string|in:masculino,femenino',
            'estado_civil' => 'required|string|in:soltero,casado,divorciado,viudo',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            //'email' => 'required|email|max:255|unique:empleados,email,' . $this->empleado->id_empleado,
            'cargo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|numeric|min:0',
            'tipo_contrato' => 'required|string|in:indefinido,temporal',
        ];
    }
}
