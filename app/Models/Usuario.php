<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/**
 * Modelo Usuario
 * Modelo principal para la autenticación y gestión de usuarios en HimalayaDigital.
 * Incluye relaciones con áreas, roles, clientes, redes sociales e imagen de perfil.
 * Permite la autenticación y notificaciones.
 */
class Usuario extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atributos que se pueden asignar en masa (mass assignment).
     * Permiten crear o actualizar usuarios fácilmente desde formularios.
     * @var list<string>
     */
    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'id', 'nombre', 'apellido', 'cargo', 'telefono', 'telefono_referencia',
        'descripcion', 'habilidades', 'email', 'password', 'direccion', 'estado',
        'fecha_nacimiento', 'remember_token', 'area_id', 'rol_id', 'img_perfil_id',
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Relación: Un usuario pertenece a un área.
     * @return BelongsTo
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    /**
     * Atributos ocultos al serializar el modelo (por seguridad).
     * @var list<string>
     */
    // Atributos ocultos al serializar el modelo (por seguridad)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión de atributos a tipos nativos (cast).
     * @return array<string, string>
     */
    // Conversión de atributos a tipos nativos (cast)
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación: Un usuario puede tener muchos clientes.
     * @return hasMany
     */
    public function cliente(): hasMany
    {
        return $this->hasMany(Cliente::class);
    }

    /**
     * Relación: Un usuario puede tener muchas redes sociales.
     * @return hasMany
     */
    public function redes_sociales(): hasMany
    {
        return $this->hasMany(Red_social::class,'usuario_id','id');
    }

    /**
     * Relación: Un usuario tiene una imagen de perfil.
     * @return BelongsTo
     */
    public function imagen_perfil(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'img_perfil_id', 'id');
    }

    /**
     * Relación: Un usuario pertenece a un rol.
     * @return BelongsTo
     */
    public function Rol(): BelongsTo
    {
        return $this->belongsTo(Roles::class, 'rol_id', 'id');
    }
}
