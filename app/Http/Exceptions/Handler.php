<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Lang;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Throwable;

/**
 * Handler global de excepciones de la aplicación.
 * Personaliza la respuesta para excepciones comunes y delega el resto al handler base.
 */
class Handler extends ExceptionHandler
{
    /**
     * Renderiza una excepción en una respuesta HTTP.
     * Personaliza mensajes para modelos no encontrados, relaciones no encontradas y rutas no existentes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        // Modelo no encontrado
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => Lang::get('errors.model_not_found')
            ], 404);
        }

        // Relación no encontrada
        if ($exception instanceof RelationNotFoundException) {
            return response()->json([
                'error' => Lang::get('errors.collection_property_not_found')
            ], 400);
        }

        // Ruta no encontrada
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => Lang::get('errors.not_found')
            ], 404);
        }

        // Para cualquier otra excepción, usa el handler por defecto
        return parent::render($request, $exception);
    }
}
