<?php

namespace App\Http\Controllers\desarrollo\Herramientas\Servicios;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Controlador para la gestión de servicios.
 * Permite listar, crear, editar, actualizar y mostrar servicios en el sistema HimalayaDigital.
 */
class serviciosController
{
    /**
     * Muestra la vista principal de servicios.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Herramientas.Servicios.servicios',compact('nameRoute'));
    }

    /**
     * Devuelve todos los servicios en formato JSON (API interna).
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiServicios()
    {
        $servicios = Servicio::all();
        return response()->json(['data' => $servicios]);
    }

    /**
     * Muestra el formulario para crear un nuevo servicio.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Herramientas.Servicios.crear_servicio',compact('nameRoute'));
    }

    /**
     * Almacena un nuevo servicio en la base de datos.
     * Valida los datos recibidos y crea el servicio.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $messages = [
            'sr-nombre.string' =>  'El nombre del servicio debe ser texto.',
            'sr-nombre.max' =>  'El nombre del servicio no debe superar los 150 caracteres.',
            'sr-descripcion.string' => 'La descripción debe ser texto.',
            'sr-descripcion.max' =>  'La descripción del servicio no debe superar los 200 caracteres.',
        ];

        $validate = $request->validate([
            'sr-nombre' => 'required|string|max:150',
            'sr-descripcion' => 'nullable|string|max:200'
        ], $messages);

        Servicio::create([
            'nombre' => $validate['sr-nombre'],
            'descripcion' => $validate['sr-descripcion'],
        ]);

        return redirect()->route('Servicios')->with([
            'successServicio' => 'Servicio creado correctamente.',
            'modelShow' => true
        ]);
    }

    /**
     * Muestra el formulario de edición para un servicio específico.
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Herramientas.Servicios.editar_servicio',compact('nameRoute','servicio'));
    }

    /**
     * Actualiza los datos de un servicio existente.
     * Valida los datos recibidos y actualiza el servicio.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'sr-nombre.string' =>  'El nombre del servicio debe ser texto.',
            'sr-nombre.max' =>  'El nombre del servicio no debe superar los 150 caracteres.',
            'sr-descripcion.string' => 'La descripción debe ser texto.',
            'sr-descripcion.max' =>  'La descripción del servicio no debe superar los 200 caracteres.',
        ];

        $validate = $request->validate([
            'sr-nombre' => 'required|string|max:150',
            'sr-descripcion' => 'nullable|string|max:200'
        ], $messages);

        $servicio = Servicio::findOrFail($id);
        $servicio->nombre = $validate['sr-nombre'];
        $servicio->descripcion = $validate['sr-descripcion'] ?? null;

        if(!$servicio->isDirty())
        {
            return redirect()->route('Editar Servicio', $servicio->id)->with([
                'warningServicio' => 'No se detecto ningun cambio para el servicio.',
                'modelShow' => true
            ]);
        }

        $servicio->save();

        return redirect()->route('Servicios')->with([
            'successServicio' => 'Servicio actualizado correctamente.',
            'modelShow' => true
        ]);
    }

    /**
     * Elimina un servicio del sistema (no implementado).
     * Puedes implementar la lógica de borrado si es necesario.
     * @param string $id
     */
    public function destroy(string $id)
    {
        //
    }
}
