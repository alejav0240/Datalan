<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteFalla extends Model
{
    /** @use HasFactory<\Database\Factories\ReporteFallaFactory> */
    use HasFactory;

    protected $table = 'reporte_fallas';

    protected $fillable = [
        'cliente_id', 'tipo_falla', 'descripcion', 'estado', 'direccion'
    ];

    public function cliente() { return $this->belongsTo(Cliente::class); }
    public function trabajo() { return $this->hasOne(Trabajo::class, 'reporte_id'); }
}
