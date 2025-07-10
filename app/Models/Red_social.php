<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Red_social
 * Representa las redes sociales asociadas a usuarios y clientes en el sistema HimalayaDigital.
 * Permite la gestión de redes sociales y su relación con usuarios y clientes.
 */
class Red_social extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table = "redes_sociales";

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'url',
        'usuario_id',
        'cliente_id',
        'estado',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación: Una red social pertenece a un usuario.
     * @return BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class,'usuario_id','id');
    }

    /**
     * Relación: Una red social pertenece a un cliente.
     * @return BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }
}
