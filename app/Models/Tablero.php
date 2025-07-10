<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Eloquent para la tabla 'tableros'.
 * Representa los tableros del sistema y sus relaciones.
 */
class Tablero extends Model
{
    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'cliente_id',
        'tablero_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relación: obtiene el historial asociado a este tablero.
     * @return HasMany
     */
    public function historial_tableros(): HasMany
    {
        return $this->hasMany(Historial_tableros::class, 'tablero_id', 'id');
    }

    /**
     * Relación: obtiene todas las fases de servicio asociadas a este tablero.
     * @return HasMany
     */
    public function faseServicio(): HasMany
    {
        // Corregido: la clave foránea debe ser 'tablero_id' para asociar fases al tablero
        return $this->hasMany(Fase_servicio::class, 'tablero_id', 'id');
    }
}
