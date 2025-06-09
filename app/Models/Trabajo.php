<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    /** @use HasFactory<\Database\Factories\TrabajoFactory> */
    use HasFactory;

    protected $fillable = [
        'reporte_id',
        'tipo_trabajo',
        'descripcion',
        'origen_nombre',
        'origen_direccion',
        'origen_lat',
        'origen_lng',
        'destino_nombre',
        'destino_direccion',
        'destino_lat',
        'destino_lng',
        'prioridad',
        'materiales_json',
        'observaciones_materiales',
    ];
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'equipos')
            ->withPivot('is_encargado')
            ->withTimestamps();
    }
    public function reporte() { return $this->belongsTo(ReporteFalla::class, 'reporte_id'); }
    public function equipo() { return $this->belongsTo(Equipo::class); }
}
