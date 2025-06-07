<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    use HasFactory;

    // Esta línea ya no es necesaria si usas 'id' como clave primaria
    // protected $primaryKey = 'id';

    protected $table = 'clientes';

    // Laravel maneja automáticamente created_at y updated_at
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'tipo_cliente',
        'nombre',
        'nit_ci',
        'telefono',
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con reportes de error
    public function reportes_falla()
    {
        return $this->hasMany(ReporteFalla::class);
    }

    // Relación con Direcciones
    public function direcciones()
    {
        return $this->hasMany(DireccionAdicional::class, 'id_cliente');
    }
}
