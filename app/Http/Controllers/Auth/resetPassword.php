<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Usuario;

// Controlador encargado del proceso de restablecimiento de contraseña
class resetPassword
{
    /**
     * Muestra el formulario para restablecer la contraseña.
     * Verifica que el token y el email sean válidos antes de mostrar la vista.
     */
    public function showResetPassword(Request $request)
    {
        // Obtener email y token de la consulta
        $email = $request->query('email');
        $token = $request->query('token');

        // Verificar si el token existe en la tabla password_reset_tokens
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        // Si no se encuentra el token, redirigir al login con un mensaje y bandera para el modal
        if (!$resetRecord) {
            return redirect()->route('login')->with([
                'message' => 'El enlace de restablecimiento de contraseña es inválido o ha expirado.',
                'showModal' => true
            ]);
        }

        // Si el token es válido, mostrar la vista de restablecimiento de contraseña
        $nameRoute = Route::currentRouteName();
        return view('login.resetPassword', compact('nameRoute', 'email', 'token'));
    }

    /**
     * Procesa la solicitud de restablecimiento de contraseña.
     * Valida los datos, verifica el token y actualiza la contraseña del usuario.
     */
    public function storeResetPassword(Request $request)
    {
        // Mensajes personalizados para la validación
        $message = [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.exists' => 'El correo electrónico no está registrado en nuestro sistema.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'token.required' => 'El token es obligatorio para restablecer la contraseña.',
        ];

        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email|exists:usuarios,email|max:250',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ], $message);

        // Buscar el registro de restablecimiento de contraseña
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)->first();

        // Si el token ya fue usado o no existe, mostrar mensaje
        if (!$resetRecord) {
            return redirect()->route('login')->with([
                'messageEmail' => '¡Usted ya realizó el cambio de contraseña!',
                'showModal' => true
            ]);
        }

        // Buscar el usuario por email
        $user = Usuario::where('email', $request->email)->first();

        // Si el usuario existe, actualizar la contraseña
        if ($user) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // Eliminar el registro de token usado
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Redirigir al login con mensaje de éxito
        return redirect()->route('login')->with('resetSuccess', 'Tu contraseña ha sido actualizada correctamente.');
    }
}
