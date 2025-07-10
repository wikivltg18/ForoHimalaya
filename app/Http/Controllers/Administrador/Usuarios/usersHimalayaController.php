<?php

namespace App\Http\Controllers\Administrador\Usuarios;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;

class usersHimalayaController
{
    public function show($id)
    {
        $userAuthenticate = Usuario::findOrFail($id);
        $nameRoute = Route::currentRouteName();
        return view('Administrador.Home.profileAdmin', compact('userAuthenticate', 'nameRoute'));
    }
}
