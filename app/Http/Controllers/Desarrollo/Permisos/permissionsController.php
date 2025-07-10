<?php

namespace App\Http\Controllers\Desarrollo\Permisos;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;

/**
 * Controlador para la gestión de permisos y asignación a roles.
 * Permite visualizar los permisos y asignarlos a roles específicos.
 */
class permissionsController
{
    /**
     * Muestra la vista de permisos y roles, permitiendo seleccionar un rol para asignar permisos.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        // Obtiene el ID del rol seleccionado desde la query, o el primero disponible
        $selectRoleId = $request->query('selected_role', $roles->first()->id ?? null);
        $role = Role::find($selectRoleId);
        $permisos = Permission::all();
        $nameRoute = \Route::currentRouteName();
        return view('Desarrollo.Permisos.permisos', compact('nameRoute', 'permisos', 'roles', 'role'));
    }

    /**
     * Asigna permisos a un rol específico.
     * Valida que los permisos existan y sincroniza la relación.
     * @param Request $request
     * @param string $id ID del rol
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignPermissions(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ], [
            'permissions.required' => 'Debe seleccionar al menos un permiso.',
            'permissions.array' => 'El formato de permisos es incorrecto.',
            'permissions.*.exists' => 'Algún permiso seleccionado no existe.'
        ]);

        $role = Role::findOrFail($id);
        $role->permissions()->sync($validatedData['permissions']);

        return redirect()->route('Roles')->with([
            'success' => 'Permisos asignados correctamente.',
            'alert-type' => 'success',
            'showModel' => true
        ]);
    }
}
