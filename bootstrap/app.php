<?php

/*
|--------------------------------------------------------------------------
| Bootstrap de la aplicación Laravel
|--------------------------------------------------------------------------
| Este archivo inicializa y configura la instancia principal de la aplicación,
| define rutas, middlewares y excepciones globales. Aquí también puedes agregar
| rutas adicionales o personalizaciones de arranque.
*/

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Configuración principal de la aplicación y registro de rutas base
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php', // Rutas web principales
        commands: __DIR__.'/../routes/console.php', // Rutas de comandos Artisan
        health: '/up', // Ruta de health check
    )
    // Registro de middlewares globales (puedes agregar aquí si es necesario)
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    // Registro de manejadores de excepciones globales
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// Registro adicional de rutas protegidas por el middleware 'web' para admin
$router->group(['middleware' => 'web'], function($router) {
    require base_path('routes/admin.php'); // Rutas administrativas
});
