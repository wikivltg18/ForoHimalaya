<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * Modelo Cliente
 * Representa los clientes registrados en el sistema HimalayaDigital.
 * Permite la gestión de clientes y sus relaciones con usuarios, contratos y redes sociales.
 */
class Cliente extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table = "clientes";

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'nombre',
        'logo_cliente',
        'sitio_web',
        'email',
        'telefono',
        'telefono_referencia',
        'usuario_id',
        'estado',
        'deleted_at'
    ];

    /**
     * Relación: Un cliente pertenece a un usuario.
     * @return belongsTo
     */
    public function usuario(): belongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id','id' );
    }


    /**
     * Relación: Un cliente puede tener muchas redes sociales.
     * @return HasMany
     */
    public function redes_sociales(): hasMany
    {
        return $this->hasMany(Red_social::class,'cliente_id','id');
    }
}
