<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Eloquent para la tabla 'password_reset'.
 * Gestiona los tokens de restablecimiento de contraseña.
 */
class password_reset extends Model
{
    /**
     * Nombre de la tabla asociada.
     * @var string
     */
    protected $table = "password_reset";

    /**
     * Indica que la clave primaria es 'email' (no incremental).
     * @var string
     */
    protected $primaryKey = "email";
    public $incrementing = false;
    public $timestamps = false;

    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];
}
