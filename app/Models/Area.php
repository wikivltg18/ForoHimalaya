<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Area
 * Representa una área funcional dentro del sistema HimalayaDigital.
 * Permite la gestión de áreas y su relación con solicitudes.
 */
class Area extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table = "areas";

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'horas_consumidas',
        'estado',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación uno a muchos: un área puede tener muchas solicitudes.
     * @return HasMany
     */
    public function solicitudes(): HasMany
    {
        return $this->hasMany(Solicitud::class, 'area_id', 'id');
    }
}
