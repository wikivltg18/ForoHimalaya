<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Eloquent para la tabla 'historial_tableros'.
 * Representa el historial de cambios de los tableros.
 */
class Historial_tableros extends Model
{
    /**
     * Nombre de la tabla asociada.
     * @var string
     */
    protected $table = "historial_tableros";

    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'created_at',
        'updated_at',
        'estados',
        'tablero_id'
    ];

    /**
     * Relación: obtiene el tablero asociado a este historial.
     * @return BelongsTo
     */
    public function tablero(): BelongsTo
    {
        // Corregido: eliminar espacio extra en el nombre de la columna
        return $this->belongsTo(Tablero::class, 'tablero_id', 'id');
    }
}
