<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class Cliente extends Model
{
    use HasFactory;
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
    ];

}
