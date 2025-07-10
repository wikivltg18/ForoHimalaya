<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Job para procesar y actualizar imágenes en segundo plano.
 * Redimensiona la imagen, la guarda con un nuevo nombre y elimina la original.
 */
class updateImage implements ShouldQueue
{
    use Queueable, Dispatchable, SerializesModels, InteractsWithQueue;

    /**
     * Ruta de la imagen original en el almacenamiento.
     * @var string
     */
    protected $imagePath;

    /**
     * Nuevo nombre para la imagen procesada.
     * @var string
     */
    protected $nuevoNombre;

    /**
     * Crea una nueva instancia del job.
     * @param string $imagePath
     * @param string $nuevoNombre
     */
    public function __construct($imagePath, $nuevoNombre)
    {
        $this->imagePath = $imagePath;
        $this->nuevoNombre = $nuevoNombre;
    }

    /**
     * Ejecuta el procesamiento de la imagen: redimensiona, guarda y elimina la original.
     * @return void
     */
    public function handle(): void
    {
        // Obtiene la imagen original desde el almacenamiento
        $imagen = Storage::get($this->imagePath);

        // Procesa la imagen: redimensiona a 800x600 y la codifica como JPG de calidad 80
        $imagenProcesada = Image::make($imagen)->resize(800, 600)->encode('jpg', 80);

        // Define la nueva ruta y guarda la imagen procesada
        $nuevoPath = 'imagenes_actualizadas/' . $this->nuevoNombre;
        Storage::put($nuevoPath, $imagenProcesada->stream());

        // Elimina la imagen original
        Storage::delete($this->imagePath);
    }
}
