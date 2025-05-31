<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = [
        'tipo_cliente',
        'nombre_cliente',
        'nit_ci',
        'rubro',
        'direccion_principal',
        'telefono',
        'celular',
        'email_acceso',
        'contrasena',
        'referencia',
        'observaciones',
        'fecha_registro',
        'activo'
    ];

}
