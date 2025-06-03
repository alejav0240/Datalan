<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionAdicional extends Model
{
    use HasFactory;

    protected $table = 'direcciones_adicionales';

    protected $primaryKey = 'id_direccion';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'direccion',
        'fecha_registro',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

}
