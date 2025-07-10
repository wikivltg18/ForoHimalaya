<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware para restringir el acceso a rutas solo a usuarios no autenticados (invitados).
 * Si el usuario está autenticado, lo redirige a la página principal.
 */
class Guest
{
    /**
     * Maneja una solicitud entrante.
     * Si el usuario está autenticado, redirige a la página principal.
     * Si no, permite continuar con la solicitud.
     *
     * @param  Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return redirect()->route('Página principal');
        }
        return $next($request);
    }
}
