<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id_cliente
 * @property string $tipo_cliente
 * @property string $nombre_cliente
 * @property string $nit_ci
 * @property string|null $rubro
 * @property string $direccion_principal
 * @property string $telefono
 * @property string|null $celular
 * @property string $email_acceso
 * @property string $contrasena
 * @property string|null $referencia
 * @property string|null $observaciones
 * @property string $fecha_registro
 * @property int $activo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereCelular($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereContrasena($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereDireccionPrincipal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereEmailAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereFechaRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereIdCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereNitCi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereNombreCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereReferencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereRubro($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereTipoCliente($value)
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $nombre
 * @property string $empresa
 * @property string $razon_social
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Database\Factories\ClienteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereEmpresa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cliente whereUserId($value)
 */
	class Cliente extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $id_cliente
 * @property string $direccion
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Cliente $cliente
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DireccionAdicional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DireccionAdicional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DireccionAdicional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DireccionAdicional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DireccionAdicional whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DireccionAdicional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DireccionAdicional whereIdCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DireccionAdicional whereUpdatedAt($value)
 */
	class DireccionAdicional extends \Eloquent {}
}

namespace App\Models{
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
 * @property int $id
 * @property int $user_id
 * @property string|null $experiencia
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereExperiencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereUserId($value)
 */
	class Empleado extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $empleado_id
 * @property int $trabajo_id
 * @property int $is_encargado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\EquipoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo whereIsEncargado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo whereTrabajoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Equipo whereUpdatedAt($value)
 */
	class Equipo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $empleado_id
 * @property string $motivo
 * @property string|null $fecha_solida
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PermisoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso whereEmpleadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso whereFechaSolida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso whereMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permiso whereUpdatedAt($value)
 */
	class Permiso extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cliente_id
 * @property string $tipo_falla
 * @property string|null $descripcion
 * @property int $estado
 * @property string|null $direccion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ReporteFallaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla whereTipoFalla($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReporteFalla whereUpdatedAt($value)
 */
	class ReporteFalla extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $reporte_id
 * @property string $tipo_trabajo
 * @property string|null $descripcion
 * @property string|null $origen_nombre
 * @property string|null $origen_direccion
 * @property string|null $origen_lat
 * @property string|null $origen_lng
 * @property string|null $destino_nombre
 * @property string|null $destino_direccion
 * @property string|null $destino_lat
 * @property string|null $destino_lng
 * @property string $prioridad
 * @property string|null $materiales_json
 * @property string|null $observaciones_materiales
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TrabajoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereDestinoDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereDestinoLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereDestinoLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereDestinoNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereMaterialesJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereObservacionesMateriales($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereOrigenDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereOrigenLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereOrigenLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereOrigenNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereReporteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereTipoTrabajo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Trabajo whereUpdatedAt($value)
 */
	class Trabajo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $id_empleado
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $nivel_acceso
 * @property string|null $ultimo_login
 * @property int $activo
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdEmpleado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNivelAcceso($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUltimoLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_active
 * @property string $role
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 */
	class User extends \Eloquent {}
}

