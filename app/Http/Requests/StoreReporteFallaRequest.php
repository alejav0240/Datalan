<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReporteFallaRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_falla' => 'required|in:hardware,software,conectividad,otro',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'boolean',
            'direccion' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'tipo_falla.required' => 'El tipo de falla es obligatorio.',
            'tipo_falla.in' => 'El tipo de falla seleccionado no es válido.',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',
            'direccion.max' => 'La dirección no puede exceder los 255 caracteres.',
        ];
    }
}
