<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Eloquent para la tabla 'imagenes_perfil'.
 * Representa las imágenes de perfil de los usuarios.
 */
class Imagen_perfil extends Model
{
    /**
     * Nombre de la tabla asociada.
     * @var string
     */
    protected $table = "imagenes_perfil";

    /**
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'ruta_imagen',
        'nombre_archivo',
        'tipo_imagen',
        'created_at',
        'updated_at'
    ];
}
