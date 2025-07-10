<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
Use Illuminate\Support\Carbon;

/**
 * Modelo Servicio
 * Representa los servicios ofrecidos a los clientes en el sistema HimalayaDigital.
 * Permite la gestión de servicios y sus relaciones con fases, tableros y clientes.
 */
class Servicio extends Model
{
    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'cliente_id',
        'tablero_id',
        'created_at',
        'estado',
        'updated_at'
    ];

    /**
     * Relación: Un servicio puede tener muchas fases.
     * @return HasMany
     */
    public function faseServicio():HasMany
    {
        return $this->hasMany(Fase_servicio::class,'servicio_id','id');
    }

    /**
     * Relación: Un servicio pertenece a un tablero.
     * @return BelongsTo
     */
    public function tablero(): BelongsTo
    {
        return $this->belongsTo(Tablero::class, 'tablero_id', 'id');
    }

    /**
     * Relación: Un servicio pertenece a un cliente.
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}
