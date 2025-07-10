<?php

/*
|--------------------------------------------------------------------------
| Lista de Service Providers de la aplicación
|--------------------------------------------------------------------------
| Este archivo retorna un arreglo con las clases de los service providers
| que serán registrados automáticamente por el framework. Los service providers
| permiten registrar servicios, bindings, eventos y otras funcionalidades globales.
| Puedes agregar aquí tus propios providers personalizados si es necesario.
*/

return [
    // Provider principal de configuración general de la aplicación
    App\Providers\AppServiceProvider::class,

    // Provider encargado de registrar las rutas de la aplicación
    App\Providers\RouteServiceProvider::class,
];
