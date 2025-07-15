<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modelo Contrato
 * Representa los contratos asociados a clientes en el sistema HimalayaDigital.
 * Permite la gestión de contratos y su relación con el cliente correspondiente.
 */
class Contrato extends Model
{
    protected $table = "contratos";

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
    ];

    /**
     * Relación: Un contrato puede pertenecer a muchos clientes.
     * @return BelongsToMany
     */
    public function clientes(): BelongsToMany
    {
        return $this->belongsToMany(Cliente::class, 'contrato_cliente', 'contrato_id', 'cliente_id')->withTimestamps();
    }
}
