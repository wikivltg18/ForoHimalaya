<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * Modelo Fase_servicio
 * Representa las fases de los servicios en el sistema HimalayaDigital.
 * Permite la gestión de fases y su relación con servicios y solicitudes.
 */
class Fase_servicio extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table = "fases_servicios";

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'servicio_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación: Una fase pertenece a un servicio.
     * @return BelongsTo
     */
    public function servicio(): belongsTo
    {
        return $this->belongsTo( Servicio::class,'servicio_id','id' );
    }

    /**
     * Relación: Una fase puede tener muchas solicitudes.
     * @return HasMany
     */
    public function solicitudes(): HasMany
    {
        return $this->hasMany(Solicitud::class, 'fase_servicio_id', 'id');
    }
}
