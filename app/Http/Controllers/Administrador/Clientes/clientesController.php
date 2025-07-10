<?php

namespace App\Http\Controllers\Administrador\Clientes;


use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Usuario;
use App\Models\Contrato;
use App\Models\Fase_servicio;
use Illuminate\Support\Facades\Route;

class clientesController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nameRoute = Route::currentRouteName();
        return view('Administrador.Clientes.clientes',compact('nameRoute'));
    }


   /**
     * Get all clientes data.
     */
    public function apiClientes()
    {
        $clientes = Cliente::with(['contratos', 'usuario'])->get();
        // Ajustar los datos para DataTables
        $clientes = $clientes->map(function($cliente) {
            return [
                'id' => $cliente->id,
                'logo' => $cliente->logo ? asset('storage/' . $cliente->logo) : null,
                'nombre' => $cliente->nombre,
                'sitio_web' => $cliente->sitio_web,
                'email' => $cliente->email,
                'mapa_cliente' => $cliente->mapa_cliente,
                'contrato' => $cliente->contratos,
                'usuario' => $cliente->usuario,
                'estado' => $cliente->estado,
            ];
        });
        return response()->json(['data' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servicios = Servicio::with('faseServicio')->get();
        $usuarios = Usuario::with('rol')->where('rol_id', 1)->get();
        $contratos = Contrato::all();
        $nameRoute = Route::currentRouteName();
        return view('Administrador.Clientes.crear_cliente',compact('nameRoute','usuarios','contratos','servicios'));
    }

    public function obtenerServiciosRelacionados($id)
    {
        // Buscar los servicios relacionados según el ID del servicio principal
        $serviciosRelacionados = Fase_servicio::where('servicio_id', $id)->get();

        // Formatear la respuesta para que coincida con lo que espera bootstrap-tagsinput
        $formattedServicios = $serviciosRelacionados->map(function ($faseServicio) {
            return ['value' => $faseServicio->id, 'text' => $faseServicio->nombre]; // Asegúrate de que 'nombre' sea la columna correcta
        });

        return response()->json($formattedServicios);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            '' => '',
            '' => '',
            '' => '',
            '' => '',
            '' => '',
        ];

        $request->validate([
            'lg_cliente' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'nm_cliente' => 'required|string|max:25',
            'st_web' => 'nullable|string|max:255',
            'em_cliente' => 'required|string|max:255',
        ],$message);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nameRoute = Route::currentRouteName();
        $cliente = Cliente::findOrFail($id);
        return view('Desarrollo.Clientes.ver_cliente',compact('nameRoute','cliente'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
