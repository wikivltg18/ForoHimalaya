<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\ServiceProvider;

/**
 * Proveedor de servicios principal de la aplicación.
 * Aquí se pueden registrar servicios globales y configuraciones generales.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra servicios de la aplicación en el contenedor de servicios.
     * Usar para bindings, singletons, etc.
     * @return void
     */
    public function register(): void
    {
        // Puedes registrar servicios personalizados aquí.
    }

    /**
     * Inicializa servicios y configuraciones globales al arrancar la aplicación.
     * @return void
     */
    public function boot(): void
    {
        // Configura la paginación para usar Bootstrap 4 en las vistas.
        Paginator::useBootstrapFour();
    }
}
