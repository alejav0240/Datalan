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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:empleados,email',
            'password' => 'nullable|string|min:5|confirmed',
            'role' => 'required|string|in:empleado,supervisor,administrador,cliente',

            'telefono' => 'required|string|max:20',
            'cargo' => 'required|string|max:255',
            'experiencia' => 'nullable|string|max:500',
            'ci' => 'required|string|max:20|unique:empleados,ci',
            'salario' => 'required|numeric|min:0',
            'estado_civil' => 'required|string|in:soltero,casado,divorciado,viudo',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no debe exceder los 255 caracteres.',

            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El campo correo electrónico debe ser una dirección válida.',
            'email.max' => 'El campo correo electrónico no debe exceder los 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',

            'role.required' => 'El campo rol es obligatorio.',
            'role.string' => 'El campo rol debe ser una cadena de texto.',
            'role.in' => 'El campo rol debe ser uno de los siguientes valores: empleado, supervisor, administrador, cliente.',

            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El campo teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El campo teléfono no debe exceder los 20 caracteres.',

            'cargo.required' => 'El campo cargo es obligatorio.',
            'cargo.string' => 'El campo cargo debe ser una cadena de texto.',
            'cargo.max' => 'El campo cargo no debe exceder los 255 caracteres.',

            'experiencia.string' => 'El campo experiencia debe ser una cadena de texto.',
            'experiencia.max' => 'El campo experiencia no debe exceder los 500 caracteres.',

            'ci.required' => 'El campo Carnet es obligatorio.',
            'ci.string' => 'El campo Carnet debe ser una cadena de texto.',
            'ci.max' => 'El campo Carnet no debe exceder los 20 caracteres.',
            'ci.unique' => 'El Carnet ya está registrado.',

            'salario.required' => 'El campo salario es obligatorio.',
            'salario.numeric' => 'El campo salario debe ser un número.',
            'salario.min' => 'El campo salario debe ser un valor positivo.',

            'estado_civil.required' => 'El campo estado civil es obligatorio.',
            'estado_civil.string' => 'El campo estado civil debe ser una cadena de texto.',
            'estado_civil.in' => 'El campo estado civil debe ser uno de los siguientes valores: soltero, casado, divorciado, viudo.',
        ];
    }
}
