<?php

namespace App\Http\Controllers\Auth;

use App\Mail\forgotPassword as MailForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
// Controlador encargado del proceso de recuperación de contraseña (envío de email con enlace de reseteo)
class forgotPassword
{
    /**
     * Muestra el formulario para solicitar recuperación de contraseña.
     */
    public function index()
    {
        $nameRoute = Route::currentRouteName();
        return view('login.forgotPassword', compact('nameRoute'));
    }

    /**
     * Procesa la solicitud de recuperación de contraseña.
     * Valida el email, genera un token y envía el correo de recuperación.
     */
    public function store(Request $request)
    {
        try {
            // Mensajes personalizados para la validación
            $message = [
                "email.required" => "El campo correo electrónico es obligatorio.",
                "email.email" => "Por favor, ingresa una dirección de correo electrónico válida.",
            ];

            // Validar el email ingresado
            $request->validate([
                'email' => "required|email"
            ], $message);

            // Buscar usuario por email
            $emailUser = Usuario::where('email', $request->email)->first();

            if ($emailUser) {
                // Generar token único para recuperación
                $token = Str::random(64);

                // Guardar o actualizar el token en la base de datos
                DB::table('password_reset_tokens')->updateOrInsert(
                    ['email' => $request->email],
                    ['token' => $token, 'created_at' => now()]
                );

                // Enviar correo con el enlace de recuperación
                Mail::to($request->email)->send(new MailForgotPassword($emailUser, $token));

                // Redirigir con mensaje de éxito
                return redirect()->route('¿Olvidó su contraseña?')->with('successEmail', 'El correo de recuperación de contraseña se ha enviado correctamente.');
            } else {
                // Si no existe el usuario, mostrar mensaje de error
                return redirect()->back()->with('errorEmail', 'No se encontró ningún usuario con ese correo electrónico.');
            }
        } catch (\Exception $e) {
            // Manejo de errores inesperados
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
