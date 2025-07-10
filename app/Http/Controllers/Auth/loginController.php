<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
// Controlador encargado de la autenticación de usuarios
class loginController
{
    // Muestra la vista del formulario de login
    public function showLogin()
    {
        return view('login.login');
    }

    // Procesa la solicitud de inicio de sesión
    public function login(Request $request)
    {
        // Mensajes personalizados para la validación de campos
        $messages = [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Por favor, ingresa un correo electrónico válido.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'email.exists' => 'No encontramos un usuario con ese correo electrónico.',
        ];

        // Valida los datos del formulario
        $request->validate([
            'email' => ['required', 'email', 'exists:usuarios,email'],
            'password' => ['required'],
        ], $messages);

        // Obtiene las credenciales del usuario
        $credentials = $request->only('email', 'password');

        // Verifica si el usuario seleccionó "mantenerme conectado"
        $remember = $request->has('remember');

        // Intenta autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($credentials, $remember)) {
            // Si la autenticación es exitosa, regenera la sesión
            $request->session()->regenerate();

            // Obtiene el rol del usuario autenticado
            $userRole = Auth::user()->rol_id;

            // Redirige según el rol del usuario
            return match($userRole) {
                1 => redirect()->route('Página principal'), // Rol 1: Página principal
                2 => redirect()->route('Home Administrador'), // Rol 2: Administrador
                3 => redirect()->route('Home Colaborador'), // Rol 3: Colaborador
            };
        } else {
            // Si la autenticación falla, regresa al login con mensaje de error
            return redirect()->route('Iniciar sesión')->with('loginError', 'El usuario ingresado no se encuentra registrado en el sistema. Por favor, verifique sus datos e intente nuevamente.');
        }
    }
}
