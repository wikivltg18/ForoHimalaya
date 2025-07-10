<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Eloquent para la tabla 'solicitudes'.
 * Representa las solicitudes del sistema y sus relaciones.
 */
class Solicitud extends Model
{
    /**
     * Nombre de la tabla asociada.
     * @var string
     */
    protected $table = "solicitudes";

    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'fecha_entrega_cliente',
        'fecha_entrega_cuentas',
        'recurrente',
        'prioridad_id',
        'fase_servicio_id',
        'area_id',
        'tipo_estado_id',
        'usuario_id',
        'cliente_id',
    ];

    /**
     * Relación: obtiene la prioridad asociada a la solicitud.
     * @return BelongsTo
     */
    public function prioridad(): BelongsTo
    {
        return $this->belongsTo(Prioridad::class, 'prioridad_id', 'id');
    }

    /**
     * Relación: obtiene la fase de servicio asociada a la solicitud.
     * @return BelongsTo
     */
    public function tipoFase(): BelongsTo
    {
        return $this->belongsTo(Fase_servicio::class, 'fase_servicio_id', 'id');
    }

    /**
     * Relación: obtiene el usuario asociado a la solicitud.
     * @return BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }

    /**
     * Relación: obtiene el estado asociado a la solicitud.
     * @return BelongsTo
     */
    public function tipo_estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'tipo_estado_id', 'id');
    }

    /**
     * Relación: obtiene el área asociada a la solicitud.
     * @return BelongsTo
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    /**
     * Relación: obtiene todas las notificaciones asociadas a la solicitud.
     * @return HasMany
     */
    public function notificaciones(): HasMany
    {
        return $this->hasMany(Notificacion::class, 'solicitud_id', 'id');
    }
}
