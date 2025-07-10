<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Sitemap;

/**
 * Comando Artisan para generar el archivo sitemap.xml del sitio.
 * Utiliza Spatie\Sitemap para recorrer el sitio y crear el sitemap en public/sitemap.xml.
 */
class GenerateSiteMap extends Command
{
    /**
     * Nombre y firma del comando de consola.
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * Descripción del comando de consola.
     * @var string
     */
    protected $description = 'Genera el archivo SiteMap del sitio web.';

    /**
     * Ejecuta el comando de consola.
     * Genera el sitemap.xml en la carpeta public.
     * @return void
     */
    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
            ->writeToFile(public_path('sitemap.xml'));
    }
}
