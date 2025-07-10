<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Eloquent para la tabla 'historial_solicitudes'.
 * Representa el historial de cambios de las solicitudes.
 */
class Historial_solicitud extends Model
{
    /**
     * Nombre de la tabla asociada.
     * @var string
     */
    protected $table = "historial_solicitudes";

    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_entrega_cliente',
        'fecha_entrega_cuentas',
        'recurrente',
        'fase_servicio_id',
        'prioridad_id',
        'created_at',
        'updated_at',
    ];
}
