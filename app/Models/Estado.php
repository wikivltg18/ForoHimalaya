<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Eloquent para la tabla 'estados'.
 * Representa los estados del sistema y su relación con tipo de estado.
 */
class Estado extends Model
{
    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'tipo_estado_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación: obtiene el tipo de estado asociado a este estado.
     * @return BelongsTo
     */
    public function tipoEstado(): BelongsTo
    {
        return $this->belongsTo(Tipo_estado::class, 'tipo_estado_id', 'id');
    }
}
