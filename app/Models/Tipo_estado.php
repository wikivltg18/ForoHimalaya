<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Eloquent para la tabla 'tipo_estado'.
 * Representa los tipos de estado del sistema y sus relaciones.
 */
class Tipo_estado extends Model
{
    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relación: obtiene todos los estados asociados a este tipo de estado.
     * @return HasMany
     */
    public function estados(): HasMany
    {
        return $this->hasMany(Estado::class, 'tipo_estado_id', 'id');
    }

    /**
     * Relación: obtiene todas las solicitudes asociadas a este tipo de estado.
     * @return HasMany
     */
    public function solicitudes(): HasMany
    {
        return $this->hasMany(Solicitud::class, 'tipo_estado_id', 'id');
    }
}
