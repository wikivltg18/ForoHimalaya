<?php

namespace App\Http\Controllers\Desarrollo\Clientes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Fase_servicio;
use App\Models\Servicio;
use App\Models\Usuario;

class clientesController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Clientes.clientes',compact('nameRoute'));
    }


   /**
     * Get all clientes data.
     */
    public function apiClientes()
    {
        $clientes = Cliente::with('contratos')->get();
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
        return view('Desarrollo.Clientes.crear_cliente',compact('nameRoute','usuarios','contratos','servicios'));
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
            'nm-cliente' => 'required|string|max:25',
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
