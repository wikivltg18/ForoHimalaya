<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Eloquent para la tabla 'prioridades'.
 * Representa los niveles de prioridad y su relación con solicitudes.
 */
class Prioridad extends Model
{
    /**
     * Nombre de la tabla asociada.
     * @var string
     */
    protected $table = "prioridades";

    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación: obtiene todas las solicitudes asociadas a esta prioridad.
     * @return HasMany
     */
    public function solicitudes(): HasMany
    {
        return $this->hasMany(Solicitud::class, 'prioridad_id', 'id');
    }
}
