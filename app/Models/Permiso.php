<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    /** @use HasFactory<\Database\Factories\PermisoFactory> */
    use HasFactory;

    protected $fillable = [
        'empleado_id', 'motivo', 'estado', 'fecha_inicio', 'fecha_fin'
    ];

    public function empleado() { return $this->belongsTo(Empleado::class); }
}
