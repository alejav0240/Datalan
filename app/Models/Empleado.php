<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id_empleado
 * @property string $nombres
 * @property string $apellidos
 * @property string $ci
 * @property string|null $fecha_nacimiento
 * @property string $genero
 * @property string $estado_civil
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 * @property string|null $contacto_emergencia
 * @property string|null $telefono_emergencia
 * @property string $cargo
 * @property string $departamento
 * @property string $fecha_ingreso
 * @property string $salario
 * @property string $tipo_contrato
 * @property string|null $habilidades
 * @property string|null $observaciones
 * @property string $fecha_registro
 * @property int $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\EmpleadoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereCargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereCi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereContactoEmergencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereDepartamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereEstadoCivil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereGenero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereHabilidades($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereIdEmpleado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereSalario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereTelefonoEmergencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereTipoContrato($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
