<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * Modelo Roles
 * Representa los roles de usuario dentro del sistema HimalayaDigital.
 * Permite la gestión de roles y su relación con los usuarios.
 */
class Roles extends Model
{
    // Nombre de la tabla asociada en la base de datos
    protected $table = "roles";

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'created_at',
        'updated_at'
    ];

    /**
     * Relación uno a muchos: un rol puede tener muchos usuarios.
     * @return HasMany
     */
    public function usuarios(): HasMany
    {
        return $this->HasMany(Usuario::class, 'rol_id', 'id');
    }
}
