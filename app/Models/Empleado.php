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

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('cargo', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('experiencia', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('telefono', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('ci', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('salario', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('estado_civil', 'like', '%' . $filters['search'] . '%');
        }
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
