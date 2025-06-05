<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteFalla extends Model
{
    /** @use HasFactory<\Database\Factories\ReporteFallaFactory> */
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'tipo_fallo', 'descripcion', 'estado', 'fecha',
        'cordenadas_destino', 'cordenadas_origin', 'direccion'
    ];

    public function cliente() { return $this->belongsTo(Cliente::class); }
    public function trabajo() { return $this->hasOne(Trabajo::class, 'reporte_id'); }
}
