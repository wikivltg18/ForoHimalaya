<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware para gestionar la funcionalidad "Recordarme" en la autenticación.
 * Si el usuario no está autenticado pero existe la cookie o parámetro 'remember_me',
 * intenta autenticarlo automáticamente usando su ID.
 */
class RememberMe
{
    /**
     * Maneja una solicitud entrante y aplica la lógica de "recordarme".
     *
     * @param  Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si el usuario no está autenticado y existe el parámetro 'remember_me', intenta login automático
        if (!Auth::check() && $request->has('remember_me') && $request->user()) {
            Auth::guard('web')->loginUsingId($request->user()->id);
        }
        return $next($request);
    }
}
