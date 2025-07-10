<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Kernel de consola de la aplicación.
 * Permite registrar comandos personalizados y programar tareas recurrentes.
 */
class Kernel extends ConsoleKernel
{
    /**
     * Comandos de Artisan disponibles para la aplicación.
     * @var array
     */
    protected $commands = [
        // Registra aquí tus comandos personalizados de Artisan
    ];

    /**
     * Define la programación de tareas recurrentes (cron jobs).
     * Puedes programar comandos, closures, etc.
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Ejemplo: $schedule->command('inspire')->hourly();
        // Agrega aquí tus tareas programadas
    }

    /**
     * Registra los comandos para la consola.
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
