<?php

namespace App\Http\Controllers\Desarrollo\Usuarios;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Role;
use App\Models\Area;
use App\Models\Roles;
use Illuminate\Support\Facades\Route;


/**
 * Controlador para la gestión de usuarios en el módulo administrativo de HimalayaDigital.
 * Permite listar, crear, editar, actualizar y mostrar usuarios, así como filtrar por áreas y roles.
 * Cada método está documentado para facilitar el mantenimiento y comprensión del flujo de usuarios.
 */
class usersHimalayaController
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Muestra la lista de usuarios con filtros por nombre y área.
     * - Permite buscar usuarios por nombre o apellido.
     * - Permite filtrar usuarios por área.
     * - Pagina los resultados para una mejor visualización.
     * - Retorna la vista con los datos necesarios para el frontend.
     */
    public function index(Request $request)
    {
        // Obtiene el nombre de la ruta actual para propósitos de navegación o breadcrumbs
        $nameRoute = Route::currentRouteName();

        // Obtiene todas las áreas disponibles para el filtro en el frontend
        $areas = Area::select('id', 'nombre')->get();

        // Obtiene los parámetros de búsqueda enviados desde el formulario
        $inputQuery = $request->input('searchName');
        $inputQueryArea = $request->input('searchArea');

        // Construye la consulta base de usuarios, incluyendo la relación con área
        $query = Usuario::with('area:id,nombre');
        // Si se proporciona un nombre, filtra por nombre o apellido
        if ($inputQuery) {
            $query->where(function ($q) use ($inputQuery) {
                $q->where('nombre', 'LIKE', "%{$inputQuery}%")
                    ->orWhere('apellido', 'LIKE', "%{$inputQuery}%");
            });
        }

        // Si se proporciona un área, filtra por área
        if ($inputQueryArea) {
            $query->where('area_id', $inputQueryArea);
        }

        // Pagina los resultados (8 por página)
        $requestName = $query->select(['id','nombre', 'apellido', 'cargo', 'area_id'])
            ->paginate(8);

        // Retorna la vista con los datos necesarios
        return view('Desarrollo.Equipo.usuarios', [
            'nameRoute' => $nameRoute,
            'search' => $inputQuery,
            'query' => $requestName,
            'inputArea' => $inputQueryArea,
            'areas' => $areas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Almacena un nuevo usuario en la base de datos.
     * - Valida los datos recibidos del formulario de registro de usuario.
     * - Crea el usuario con los datos validados.
     * - Redirige a la lista de usuarios con mensaje de éxito.
     */
    public function store(Request $request)
    {
        // Mensajes personalizados para la validación
        $messages = [
            'nm-user.required' => 'El nombre es obligatorio.',
            'nm-user.string' => 'El nombre debe ser una cadena de texto.',
            'nm-user.max' => 'El nombre no debe exceder los 45 caracteres.',

            'ap-user.required' => 'El apellido es obligatorio.',
            'ap-user.string' => 'El apellido debe ser una cadena de texto.',
            'ap-user.max' => 'El apellido no debe exceder los 45 caracteres.',

            'em-user.required' => 'El correo electrónico es obligatorio.',
            'em-user.email' => 'El correo electrónico debe ser válido.',
            'em-user.unique' => 'Este correo electrónico ya está registrado.',

            'psw-user.required' => 'La contraseña es obligatoria.',
            'psw-user.string' => 'La contraseña debe ser una cadena de texto.',
            'psw-user.min' => 'La contraseña debe tener al menos 8 caracteres.',

            'cr-user.required' => 'La dirección es obligatoria.',
            'cr-user.string' => 'La dirección debe ser una cadena de texto.',
            'cr-user.max' => 'La dirección no debe exceder los 85 caracteres.',

            'tf-user.required' => 'El teléfono es obligatorio.',
            'tf-user.string' => 'El teléfono debe ser una cadena de texto.',
            'tf-user.max' => 'El teléfono no debe exceder los 255 caracteres.',


            'tfr-user.required' => 'El teléfono de referencia es obligatorio.',
            'tfr-user.string' => 'El teléfono de referencia debe ser una cadena de texto.',
            'tfr-user.max' => 'El teléfono de referencia no debe exceder los 255 caracteres.',


            'hr-user.required' => 'El valor numérico es obligatorio.',
            'hr-user.numeric' => 'El valor debe ser un número.',
            'hr-user.regex' => 'El formato del valor numérico no es válido. Debe ser hasta 13 dígitos enteros y 2 decimales.',

            'fh-user.required' => 'La fecha es obligatoria.',
            'fh-user.date' => 'La fecha debe ser válida.',
            'fh-user.date_format' => 'La fecha debe estar en el formato d/m/Y.',

            'rl-user.required' => 'El rol es obligatorio.',
            'rl-user.exists' => 'El rol seleccionado no es válido.',
            'rl-user.string' => 'El rol debe ser una cadena de texto.',

            'ar-user.required' => 'El área es obligatoria.',
            'ar-user.exists' => 'El área seleccionada no es válida.',
            'ar-user.string' => 'El área debe ser una cadena de texto.',
        ];

        // Validación de los datos del formulario
        $validateData = $request->validate([
            'nm-user' => 'required|string|max:45',
            'ap-user' => 'required|string|max:45',
            'em-user' => 'required|email|unique:users,email',
            'psw-user' => 'required|string|min:8',
            'cr-user' => 'required|string|max:85',
            'tf-user' => 'required|string|max:255',
            'tfr-user' => 'required|string|max:255',
            'hr-user' => [
                'required',
                'numeric',
                'regex:/^\d{1,13}(\.\d{1,2})?$/',
            ],
            'fh-user' => 'required|date',
            'rl-user' => 'required|exists:roles,id|string',
            'ar-user' => 'required|exists:area,id|string',
        ], $messages);

        // Crea el usuario con los datos validados
        Usuario::create([
            'nombre' => $validateData['nm-user'],
            'apellido' => $validateData['ap-user'],
            'email' => $validateData['em-user'],
            'password' => bcrypt($validateData['psw-user']),
            'cargo' => $validateData['cr-user'],
            'telefono' => $validateData['tf-user'],
            'numero_referencia' => $validateData['tfr-user'],
            'horas_disponibles' => $validateData['hr-user'],
            'fecha_nacimiento' => $validateData['fh-user'],
            'roles_id' => $validateData['rl-user'],
            'area_id' => $validateData['ar-user'],
        ]);

        // Redirige a la vista de usuarios con mensaje de éxito
        return redirect()->route('Usuarios')->with([
            'userSuccess' => 'El usuario se ha creado correctamente.',
            'type' => 'success',
            'modelShow' => true
        ]);

    }


    /**
     * Muestra el directorio de perfiles de usuario, con soporte para búsqueda y filtrado por área.
     * - Si la petición es AJAX, retorna HTML parcial para resultados dinámicos.
     * - Si no, retorna la vista completa con filtros y paginación.
     */
    public function profilesDirectories(Request $request)
    {
        // Si la petición es AJAX, retorna solo el HTML de resultados filtrados
        if ($request->ajax()) {
            $search = $request->query('search');
            $usuarios = Usuario::where('nombre', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");

            return response()->json([
                'html' => view('Desarrollo.Equipo.directorio', compact('usuarios'))->render()
            ]);
        }

        // Si hay filtro de área, filtra los usuarios por área
        $areasFilter = $request->input('areasFilter');
        if ($areasFilter) {
            $queryFilter = Usuario::where('area_id', $areasFilter)->get();
        } else {
            $queryFilter = Usuario::all();
        }

        // Obtiene todos los usuarios paginados y todas las áreas
        $usuarios = Usuario::with('areas')->paginate(9);
        $areas = Area::all();
        $nameRoute = Route::currentRouteName();

        // Retorna la vista del directorio con los datos necesarios
        return view('Desarrollo.Equipo.directorio', compact('nameRoute', 'usuarios', 'areas', 'queryFilter'));
    }



    /**
     * Display the specified resource.
     */
    /**
     * Muestra el perfil de un usuario específico.
     * - Busca el usuario por su ID.
     * - Retorna la vista de perfil con los datos del usuario.
     */
    public function show($id)
    {
        $profile = Usuario::findOrFail($id);
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Home.profileDesarrollo', compact('nameRoute', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Muestra el formulario de edición para un usuario específico.
     * - Obtiene todas las áreas y roles para los selectores.
     * - Busca el usuario por su ID.
     * - Retorna la vista de edición con los datos necesarios.
     */
    public function edit($id)
    {
        $areas = Area::all();
        $roles = Roles::all();
        $usuario = Usuario::findOrFail($id);
        $nameRoute = Route::currentRouteName();

        return view('Desarrollo.Equipo.editarUsuario', compact('areas', 'roles', 'usuario', 'nameRoute'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Actualiza los datos de un usuario existente.
     * - Valida los datos recibidos del formulario de edición.
     * - Actualiza el usuario con los datos validados.
     * - Redirige a la lista de usuarios con mensaje de éxito.
     */
    public function update(Request $request, string $id)
    {
        // Mensajes personalizados para la validación
        $messages = [
            'nmu-user.required' => 'El nombre es obligatorio.',
            'nmu-user.string' => 'El nombre debe ser una cadena de texto.',
            'nmu-user.max' => 'El nombre no debe exceder los 45 caracteres.',

            'apu-user.required' => 'El apellido es obligatorio.',
            'apu-user.string' => 'El apellido debe ser una cadena de texto.',
            'apu-user.max' => 'El apellido no debe exceder los 45 caracteres.',

            'em-user.required' => 'El correo electrónico es obligatorio.',
            'em-user.email' => 'El correo electrónico debe ser válido.',
            'em-user.unique' => 'Este correo electrónico ya está registrado.',

            'psw-user.required' => 'La contraseña es obligatoria.',
            'psw-user.string' => 'La contraseña debe ser una cadena de texto.',
            'psw-user.min' => 'La contraseña debe tener al menos 8 caracteres.',

            'cr-user.required' => 'La dirección es obligatoria.',
            'cr-user.string' => 'La dirección debe ser una cadena de texto.',
            'cr-user.max' => 'La dirección no debe exceder los 85 caracteres.',

            'tf-user.required' => 'El teléfono es obligatorio.',
            'tf-user.string' => 'El teléfono debe ser una cadena de texto.',
            'tf-user.max' => 'El teléfono no debe exceder los 255 caracteres.',


            'tfr-user.required' => 'El teléfono de referencia es obligatorio.',
            'tfr-user.string' => 'El teléfono de referencia debe ser una cadena de texto.',
            'tfr-user.max' => 'El teléfono de referencia no debe exceder los 255 caracteres.',


            'hr-user.required' => 'El valor numérico es obligatorio.',
            'hr-user.numeric' => 'El valor debe ser un número.',
            'hr-user.regex' => 'El formato del valor numérico no es válido. Debe ser hasta 13 dígitos enteros y 2 decimales.',

            'fh-user.required' => 'La fecha es obligatoria.',
            'fh-user.date' => 'La fecha debe ser válida.',
            'fh-user.date_format' => 'La fecha debe estar en el formato d/m/Y.',

            'rl-user.required' => 'El rol es obligatorio.',
            'rl-user.exists' => 'El rol seleccionado no es válido.',
            'rl-user.string' => 'El rol debe ser una cadena de texto.',

            'ar-user.required' => 'El área es obligatoria.',
            'ar-user.exists' => 'El área seleccionada no es válida.',
            'ar-user.string' => 'El área debe ser una cadena de texto.',
        ];

        // Validación de los datos del formulario de edición
        $validateData = $request->validate([
            'nmu-user' => 'required|string|max:45',
            'apu-user' => 'required|string|max:45',
            'cru-user' => 'required|string|max:85',
            'tfu-user' => 'required|string|max:255',
            'tfru-user' => 'required|string|max:255',
            'hru-user' => [
                    'required',
                    'numeric',
                    'regex:/^\d{1,13}(\.\d{1,2})?$/',
                ],
            'fhu-user' => 'required|date',
            'rlu-user' => 'required|exists:roles,id|string',
            'aru-user' => 'required|exists:areas,id|string',
        ], $messages);

        // Busca el usuario a actualizar
        $usuario = Usuario::findOrFail($id);

        // Actualiza los datos del usuario
        $usuario->update([
            'nombre' => $validateData['nmu-user'],
            'apellido' => $validateData['apu-user'],
            'email' => $request->input('emu-user'),
            'password' => bcrypt($request->input('pswu-user')),
            'cargo' => $validateData['cru-user'],
            'telefono' => $validateData['tfu-user'],
            'numero_referencia' => $validateData['tfru-user'],
            'horas_disponibles' => $validateData['hru-user'],
            'fecha_nacimiento' => $validateData['fhu-user'],
            'roles_id' => $validateData['rlu-user'],
            'area_id' => $validateData['aru-user'],
        ]);

        // Redirige a la vista de usuarios con mensaje de éxito
        return redirect()->route('Usuarios')->with([
            'updateSuccess' => '¡Datos del rol actualizados correctamente!',
            'modelShow' => true,
            'type' => 'success',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Elimina un usuario del sistema (no implementado).
     * Puedes implementar la lógica de borrado si es necesario.
     */
    public function destroy(string $id)
    {
        //
    }
}
