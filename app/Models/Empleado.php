<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_empleado';

    protected $fillable = [
        'nombres',
        'apellidos',
        'ci',
        'fecha_nacimiento',
        'genero',
        'estado_civil',
        'direccion',
        'telefono',
        'email',
        'contacto_emergencia',
        'telefono_emergencia',
        'cargo',
        'departamento',
        'fecha_ingreso',
        'salario',
        'tipo_contrato',
        'habilidades',
        'observaciones',
        'activo',
    ];
}
