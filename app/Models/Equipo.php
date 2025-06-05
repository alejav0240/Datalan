<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    /** @use HasFactory<\Database\Factories\EquipoFactory> */
    use HasFactory;


    protected $fillable = ['nombre', 'encargado_id'];

    public function empleados() { return $this->hasMany(Empleado::class); }
    public function trabajos() { return $this->hasMany(Trabajo::class); }
}
