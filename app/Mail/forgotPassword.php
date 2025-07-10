<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable para el envío de correo de recuperación de contraseña.
 * Incluye el email del usuario y el token de recuperación.
 */
class forgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Email del usuario que solicita el restablecimiento.
     * @var string
     */
    public $emailUser;

    /**
     * Token de recuperación de contraseña.
     * @var string
     */
    public $token;

    /**
     * Crea una nueva instancia del mailable.
     * @param string $emailUser
     * @param string $token
     */
    public function __construct($emailUser, $token)
    {
        $this->emailUser = $emailUser;
        $this->token = $token;
    }

    /**
     * Construye el mensaje de correo.
     * @return $this
     */
    public function build()
    {
        // Corrige el uso de with: acepta un solo array asociativo
        return $this->view('Mails.forgotPassword')
            ->subject('Recuperar contraseña')
            ->with([
                'emailUser' => $this->emailUser,
                'token' => $this->token
            ]);
    }
}
