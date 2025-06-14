<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'cargo',
        'experiencia',
        'telefono',
        'ci',
        'salario',
        'estado_civil',
        'created_at',
    ];

    // app/Models/Empleado.php
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%') // Filtrar por el campo name de Empleado
            ->orWhereHas('user', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%'); // Filtrar por el campo name de User
            });
        }

        if (isset($filters['cargo'])) {
            $query->where('cargo', $filters['cargo']);
        }

        if (isset($filters['estado_civil'])) {
            $query->where('estado_civil', $filters['estado_civil']);
        }

        if (isset($filters['salario_min'])) {
            $query->where('salario', '>=', $filters['salario_min']);
        }
        if (isset($filters['is_active'])) {
            if ($filters['is_active'] == 2) {
                // No aplicar filtro, mostrar todos
            } else {
                $query->whereHas('user', function ($q) use ($filters) {
                    $q->where('is_active', $filters['is_active']);
                });
            }
        } else {
            // Por defecto mostrar activos
            $query->whereHas('user', function ($q) {
                $q->where('is_active', true);
            });
        }

        return $query;
    }
    public function trabajos()
    {
        return $this->belongsToMany(Trabajo::class, 'equipos')
            ->withPivot('is_encargado')
            ->withTimestamps();
    }

    public function user() { return $this->belongsTo(User::class); }
    public function equipo() { return $this->belongsTo(Equipo::class); }
    public function permisos() { return $this->hasMany(Permiso::class); }
}
