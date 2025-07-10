<?php

namespace App\Http\Controllers\Auth;

/**
 * Controlador de registro de usuarios.
 * Muestra la vista de registro y pasa el nombre de la ruta actual para propósitos de navegación.
 */
class registerConstroller
{
    /**
     * Muestra la vista de registro de usuario.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $nameRoute = \Route::currentRouteName(); // Obtiene el nombre de la ruta actual
        return view('registro.register',compact('nameRoute'));
    }
}
