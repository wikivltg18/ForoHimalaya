<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware para deshabilitar la caché en las respuestas HTTP.
 * Agrega encabezados para evitar el almacenamiento en caché del lado del cliente y del proxy.
 */
class DisableCache
{
    /**
     * Maneja una solicitud entrante y modifica la respuesta para deshabilitar la caché.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Agrega encabezados para deshabilitar caché en el navegador y proxies
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Thu, 01 Jan 1970 00:00:00 GMT');

        return $response;
    }
}
