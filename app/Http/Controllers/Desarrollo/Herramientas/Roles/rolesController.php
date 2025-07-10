<?php
namespace App\Http\Controllers\Desarrollo\Herramientas\Roles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Roles;
use Spatie\Permission\Models\Role;

/**
 * Controlador para la gestión de roles administrativos.
 * Permite listar, crear, editar, actualizar y mostrar roles en el sistema HimalayaDigital.
 * Utiliza tanto el modelo local Roles como el modelo de Spatie para permisos.
 */
class rolesController
{
    /**
     * Muestra la vista principal de roles.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Herramientas.Roles.roles',compact('nameRoute'));
    }


    /**
     * Devuelve todos los roles en formato JSON (API interna).
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiRoles()
    {
        $roles = Role::all();
        return response()->json(['data' => $roles]);
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Herramientas.Roles.roles_create',compact('nameRoute'));
    }

    /**
     * Almacena un nuevo rol en la base de datos.
     * Valida los datos recibidos y crea el rol.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $messages = [
            'nm-lo.required' => 'El campo lógico Local es obligatorio.',
            'nm-lo.max' => 'No debe exceder los 255 caracteres.',
            'nm-mo.required' => 'El campo Nombre Modelo es obligatorio.',
            'nm-mo.max' => ' No debe exceder los 255 caracteres.',
        ];

        $validateData = $request->validate([
            'nm-lo' => 'required|string|max:40',
            'dc-ion' => 'nullable|string|max:100',
        ], $messages);


        Roles::create([
            'nombre' => $validateData['nm-lo'],
            'descripcion' => $validateData['dc-ion'] ?? 'Desi',
        ]);

        return redirect()->route('Roles')->with([
            'successRole' => '¡Rol creado exitosamente!',
            'modelShow' => true
        ]);
    }

    /**
     * Muestra el formulario de edición para un rol específico.
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $role = Roles::findOrFail($id);
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Herramientas.Roles.roles_update',compact('nameRoute','role'));
    }

    /**
     * Actualiza los datos de un rol existente.
     * Valida los datos recibidos y actualiza el rol.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {

        $messages = [
            'nm-lou.required' => 'El nombre del rol es obligatorio..',
            'nm-lou.string'   => 'El nombre del área debe ser texto.',
            'nm-lou.max'      => 'El nombre del rol no debe superar los 40 caracteres.',

            'dc-ionu.string' => 'La descripción debe ser texto.',
            'dc-ionu.max' => ' La descripción no debe superar los 100 caracteres.',
        ];

        $validateData = $request->validate([
            'nm-lou' => 'required|string|max:40',
            'dc-ionu' => 'nullable|string|max:100',
        ], $messages);

        $Role = Roles::findOrFail($id);

        $Role->nombre = $validateData['nm-lou'];
        $Role->descripcion = $validateData['dc-ionu'];

        if(!$Role->isDirty())
        {
            return redirect()->route('Actualizar rol',['id' => $id])->with([
                'warningUpdateRole' => 'No se detecto ningun cambio para el rol.',
                'modelShow' => true,
            ]);
        }

        $Role->save();

        return redirect()->route('Roles')->with([
            'successRoleUpdate' => 'Rol actualizado correctamente',
            'modelShow' => true
        ]);
    }

    /**
     * Elimina un rol del sistema (no implementado).
     * Puedes implementar la lógica de borrado si es necesario.
     * @param string $id
     */
    public function destroy(string $id)
    {
        //
    }
}
