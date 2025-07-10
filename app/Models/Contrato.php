<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Contrato
 * Representa los contratos asociados a clientes en el sistema HimalayaDigital.
 * Permite la gestión de contratos y su relación con el cliente correspondiente.
 */
class Contrato extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table = "contratos";

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'cliente_id',
    ];

    /**
     * Relación: Un contrato pertenece a un cliente.
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }
}
