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
            'empleados.min' => 'Debe seleccionar al menos 2 empleados para el equipo de trabajo.',
            'empleados.max' => 'No puede seleccionar más de 5 empleados para el equipo de trabajo.',
            'encargado_id.required' => 'Debe designar a un encargado para el trabajo.',
        ];
    }
}
