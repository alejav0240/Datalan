<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReporteFallaRequest extends FormRequest
{
    // Autorización
    public function authorize(): bool
    {
        return true;
    }

    // Reglas de validación
    public function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_falla' => 'required|in:hardware,software,conectividad,otro',
            'descripcion' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'sometimes|in:pendiente,en_proceso,resuelto',
        ];
    }

    // Mensajes de error personalizados
    public function messages(): array
    {
        return [
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'tipo_falla.required' => 'El tipo de falla es obligatorio.',
            'tipo_falla.in' => 'El tipo de falla seleccionado no es válido.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.max' => 'La dirección no debe exceder los 255 caracteres.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
