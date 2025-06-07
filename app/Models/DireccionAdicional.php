<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionAdicional extends Model
{
    use HasFactory;

    protected $table = 'direcciones_adicionales';

    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'direccion',
        'latitud',
        'longitud',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
    // En el modelo ReporteFalla
    public function direccionAdicional()
    {
        return $this->belongsTo(DireccionAdicional::class, 'direccion_adicional_id');
    }


}
