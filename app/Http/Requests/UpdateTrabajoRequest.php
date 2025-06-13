<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrabajoRequest extends FormRequest
{
    // Autorizar
    public function authorize(): bool
    {
        return true;
    }

    // Reglas de validación
    public function rules(): array
    {
        return [
            'tipo_trabajo' => 'required|in:instalacion,mantenimiento,reparacion,configuracion,otro',
            'descripcion' => 'required|string|max:500',
            'prioridad' => 'required|in:normal,alta,urgente',
            'materiales' => 'nullable|string',
            'observaciones_materiales' => 'nullable|string',
            'estado_reporte' => 'nullable|in:pendiente,en_proceso,resuelto',
            'empleados' => 'required|array|min:2|max:5',
            'empleados.*' => 'exists:empleados,id',
            'encargado_id' => 'required|exists:empleados,id'
        ];
    }

    // Mensajes personalizados
    public function messages(): array
    {
        return [
            'tipo_trabajo.required' => 'El tipo de trabajo es obligatorio.',
            'tipo_trabajo.in' => 'El tipo de trabajo seleccionado no es válido.',
            'descripcion.required' => 'La descripción del trabajo es obligatoria.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'descripcion.max' => 'La descripción no debe exceder los 500 caracteres.',
            'prioridad.required' => 'La prioridad es obligatoria.',
            'prioridad.in' => 'La prioridad seleccionada no es válida.',
            'materiales.string' => 'Los materiales deben ser un texto.',
            'observaciones_materiales.string' => 'Las observaciones de materiales deben ser un texto.',
            'empleados.required' => 'Debe seleccionar al menos un empleado.',
            'empleados.array' => 'Los empleados deben ser una lista.',
            'empleados.min' => 'Debe seleccionar al menos 2 empleados para el equipo de trabajo.',
            'empleados.max' => 'No puede seleccionar más de 5 empleados para el equipo de trabajo.',
            'empleados.*.exists' => 'Uno o más empleados seleccionados no existen.',
            'encargado_id.required' => 'Debe designar a un encargado para el trabajo.',
            'encargado_id.exists' => 'El encargado seleccionado no existe.',
        ];
    }
}
