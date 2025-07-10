<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Testing\Fakes\Fake;

/**
 * Controlador para la generación de datos falsos en tablas principales del sistema.
 * Utiliza Faker para poblar tablas de usuarios, imágenes de perfil, clientes, tableros, redes sociales y solicitudes.
 */
class fakeDataController
{
    /**
     * Genera datos falsos de usuarios y los inserta en la tabla 'usuarios'.
     * @return string
     */
    public function usuarios()
    {
        for ($i = 0; $i <= 10; $i++) {
            $Faker = Faker::create();
            $data = [
                'nombre' => $Faker->name(),
                'apellido' => $Faker->lastName(),
                'cargo' => $Faker->randomElement([
                    'Desarrollo Web',
                    'Practicante en Contenidos - CM',
                    'Content Manager',
                    'Manager',
                    'Ejecutiva de Cuentas',
                    'New Bussines',
                    'Practicante en Diseño Gráfico',
                ]),
                'direccion' => $Faker->address(),
                'descripcion' => $Faker->sentence(),
                'habilidades' => $Faker->randomElement([
                    'Gestión del Caos',
                    'Aprendiz Rápido con Turbo',
                    'Trabajo en Equipo con Flow',
                    'Maestro del Backend',
                    'Control de versiones (Git)',
                    'Gestión de Bases de Datos',
                ]),
                'fecha_nacimiento' => $Faker->date(),
                'email' => $Faker->email(),
                'password' => Hash::make($Faker->password()),
                'area_id' => $Faker->numberBetween(1, 5),
                'img_perfil_id' => $Faker->numberBetween(1, 10),
            ];
            DB::table('usuarios')->insert($data);
        }
        return "<h1>Datos de usuarios ingresados correctamente</h1>";
    }

    /**
     * Genera datos falsos de imágenes de perfil y los inserta en la tabla 'imagenes_perfil'.
     * @return string
     */
    public function img_perfiles()
    {
        for ($i = 0; $i < 10; $i++) {
            $Faker = Faker::create();
            $data = [
                'ruta_imagen' => $Faker->url(),
                'nombre_archivo' => $Faker->mimeType(),
                'tipo_imagen' => $Faker->fileExtension(),
            ];
            DB::table('imagenes_perfil')->insert($data);
        }
        return "<h1>Datos de imagenes ingresados correctamente</h1>";
    }

    /**
     * Genera datos falsos de clientes y los inserta en la tabla 'clientes'.
     * @return string
     */
    public function clientes()
    {
        for ($i = 0; $i <= 10; $i++) {
            $Faker = Faker::create();
            $data = [
                'nombre' => $Faker->name(),
                'sitio_web' => $Faker->url(),
                'email' => $Faker->email(),
                'telefono' => $Faker->phoneNumber(),
                'telefono_referencia' => $Faker->phoneNumber(),
                'usuario_id' => $Faker->numberBetween(1, 14),
                'contrato_id' => $Faker->numberBetween(1, 2),
                'estado' => 1
            ];
            DB::table('clientes')->insert($data);
        }
        return "<h1>Datos de clientes ingresados correctamente</h1>";
    }

    /**
     * Genera datos falsos de tableros y los inserta en la tabla 'tableros'.
     * @return string
     */
    public function tableros()
    {
        for ($i = 0; $i <= 10; $i++) {
            $Faker = Faker::create();
            $data = [
                'nombre' => $Faker->name(),
                // sentences() retorna array, se convierte a string
                'descripcion' => implode(' ', $Faker->sentences()),
                'cliente_id' => $Faker->numberBetween(1, 10),
            ];
            DB::table('tableros')->insert($data);
        }
        return "<h1>Datos de tableros ingresados correctamente</h1>";
    }

    /**
     * Genera datos falsos de redes sociales y los inserta en la tabla 'redes_sociales'.
     * @return string
     */
    public function redes_sociales()
    {
        for ($i = 0; $i < 10; $i++) {
            $Faker = Faker::create();
            $data = [
                'nombre' => $Faker->randomElement(['Facebook', 'Instagram', 'Youtube']),
                'url' => $Faker->url(),
                'estado' => 1,
            ];
            DB::table('redes_sociales')->insert($data);
        }
        return "<h1>Datos de las redes sociales ingresados correctamente.</h1>";
    }

    /**
     * Genera datos falsos de solicitudes y los inserta en la tabla 'solicitudes'.
     * @return string
     */
    public function solicitudes()
    {
        for ($i = 0; $i < 10; $i++) {
            $Faker = Faker::create();
            $data = [
                'nombre' => $Faker->name(),
                'descripcion' => $Faker->sentence(),
                'fecha_entrega_cliente' => $Faker->dateTime(),
                'fecha_entrega_cuentas' => $Faker->dateTime(),
                'prioridad_id' => $Faker->numberBetween(1, 3),
                'area_id' => $Faker->numberBetween(1, 5),
                'fase_servicio_id' => $Faker->numberBetween(1, 5),
                'tipo_estado_id' => $Faker->numberBetween(1, 2),
                'cliente_id' => $Faker->numberBetween(1, 10),
                'usuario_id' => $Faker->numberBetween(1, 10),
                'recurrente' => 0
            ];
            DB::table('solicitudes')->insert($data);
        }
        return "<h1>Datos de solicitudes ingresados correctamente.</h1>";
    }
}
