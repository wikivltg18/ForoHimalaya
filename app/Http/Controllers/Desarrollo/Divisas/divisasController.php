<?php

namespace App\Http\Controllers\Desarrollo\Divisas;

use Illuminate\Http\Request;
use App\Models\Divisa;

/**
 * Controlador para la gestión de divisas.
 * Permite listar, crear, editar y actualizar divisas en el sistema HimalayaDigital.
 */
class divisasController
{
    /**
     * Muestra la vista principal de divisas.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $divisas = Divisa::all();
        $nameRoute = \Route::currentRouteName();
        return view('desarrollo.herramientas.divisas.divisas', compact('nameRoute','divisas'));
    }

    /**
     * Muestra el formulario para crear una nueva divisa.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $divisas = Divisa::all();
        $nameRoute = \Route::currentRouteName();
        return view('Desarrollo.Herramientas.Divisas.crear_divisa', compact('nameRoute','divisas'));
    }

    /**
     * Almacena una nueva divisa en la base de datos.
     * Valida los datos recibidos y crea la divisa.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $message = [
            'nm-divisa.required' => 'El nombre es obligatorio.',
            'nm-divisa.string' => 'El nombre debe ser una cadena de texto.',
            'nm-divisa.max' => 'El nombre no puede tener más de 45 caracteres.',
            'tz-divisa.required' => 'La tasa de conversión es obligatoria.',
            'tz-divisa.numeric' => 'La tasa de conversión debe ser un número.',
        ];

        $validateData = $request->validate([
            'nm-divisa' => 'required|string|max:45',
            'tz-divisa' => 'required|numeric'
        ], $message);

        $create_divisa = Divisa::create([
            'nombre' => $validateData['nm-divisa'],
            'tasa_conversion' => $validateData['tz-divisa'],
            'created_at' => now()
        ]);

        if ($create_divisa) {
            return redirect()->route('Divisas')->with([
                'divisaSuccess' => 'La divisa se ha creado correctamente.',
                'alert-type' => 'success',
                'showModel' => true
            ]);
        } else {
            return redirect()->route('Crear divisa')->with([
                'divisaError' => 'La divisa no se ha creado correctamente.',
                'alert-type' => 'error',
                'showModel' => true
            ]);
        }
    }

    /**
     * Muestra el formulario de edición para una divisa específica.
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $divisa_id = Divisa::findOrFail($id);
        $nameRoute = \Route::currentRouteName();
        return view('Desarrollo.Herramientas.Divisas.editar_divisa',compact('nameRoute','divisa_id'));
    }

    /**
     * Actualiza los datos de una divisa existente.
     * Valida los datos recibidos y actualiza la divisa.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $message = [
            'nmu-divisa.required' => 'El nombre es obligatorio.',
            'nmu-divisa.string' => 'El nombre debe ser una cadena de texto.',
            'nmu-divisa.max' => 'El nombre no puede tener más de 45 caracteres.',
            'tzu-divisa.required' => 'La tasa de conversión es obligatoria.',
            'tzu-divisa.numeric' => 'La tasa de conversión debe ser un número.',
        ];

        $validateData = $request->validate([
            'nmu-divisa' => 'required|string|max:45',
            'tzu-divisa' => 'required|numeric'
        ], $message);

        $divisa_id = Divisa::findOrFail($id);
        $updated = $divisa_id->update([
            'nombre' => $validateData['nmu-divisa'],
            'tasa_conversion' => $validateData['tzu-divisa'],
            'updated_at' => now()
        ]);

        if ($updated) {
            return redirect()->route('Divisas')->with([
                'divisaUpdateSuccess' => '¡La divisa se ha actualizado correctamente!.',
                'alert-type' => 'success',
                'showModel' => true
            ]);
        } else {
            return redirect()->route('Crear divisa')->with([
                'divisaUpdateError' => '¡La divisa no pudo actualizar correctamente!.',
                'alert-type' => 'error',
                'showModel' => true
            ]);
        }
    }

    /**
     * Elimina una divisa del sistema (no implementado).
     * Puedes implementar la lógica de borrado si es necesario.
     * @param string $id
     */
    public function destroy(string $id)
    {
        /**
         * Elimina una divisa del sistema.
         * Busca la divisa por ID y la elimina si existe.
         * Redirige con mensaje de éxito o error.
         */
        $divisa = Divisa::find($id);
        if ($divisa) {
            $divisa->delete();
            return redirect()->route('Divisas')->with([
                'divisaDeleteSuccess' => 'La divisa se ha eliminado correctamente.',
                'alert-type' => 'success',
                'showModel' => true
            ]);
        } else {
            return redirect()->route('Divisas')->with([
                'divisaDeleteError' => 'No se encontró la divisa a eliminar.',
                'alert-type' => 'error',
                'showModel' => true
            ]);
        }
    }
}
