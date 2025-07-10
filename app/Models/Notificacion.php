<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Eloquent para la tabla 'notificaciones'.
 * Representa las notificaciones del sistema y su relación con solicitudes.
 */
class Notificacion extends Model
{
    /**
     * Nombre de la tabla asociada.
     * @var string
     */
    protected $table = "notificaciones";

    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'id',
        'mensaje',
        'leido',
        'tipo_entidad',
        'solicitud_id',
        'usuario_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación: obtiene la solicitud asociada a la notificación.
     * @return BelongsTo
     */
    public function solicitud(): BelongsTo
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id', 'id');
    }
}
