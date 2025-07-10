<?php

namespace App\Http\Controllers\Desarrollo\Ot;

use App\Models\Ots;
use App\Models\User;
use App\Models\Estado;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Route;
class ordenController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Ot.listaOT', compact('nameRoute'));
    }


    public function getOts()
    {
        $ots = Ots::with('estados', 'users' ,'cliente')->get();
        return response()->json(['data' => $ots]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estados = Estado::whereIn('id',[10,9,8])->get();
        $ejecutivos = User::where('roles_id',operator: 6)->get();
        $nameRoute = Route::currentRouteName();
        return view('Desarrollo.Ot.crearOT', compact('nameRoute','ejecutivos','estados'));
    }

    /**
     * Download an excel file.
     * */

    public function downloadExcel()
    {

        $file_excel = new Spreadsheet();
        $sheet = $file_excel -> getActiveSheet();

        $sheet->setCellValue('A1','Área');
        $sheet->setCellValue('B1','Horas contratadas');
        $sheet->setCellValue('C1','Horas consumidas');
        $sheet->setCellValue('D1','Diferencia');

        $data = [
            ['Área' => 'Marketing', 'Horas Contratadas' => 100, 'Horas Consumidas' => 85],
            ['Área' => 'Desarrollo', 'Horas Contratadas' => 200, 'Horas Consumidas' => 190],
            ['Área' => 'Soporte', 'Horas Contratadas' => 150, 'Horas Consumidas' => 140],
        ];

        $row = 2;
        foreach($data as $item)
        {
            $sheet->setCellValue('A' . $row, $item['Área']); // Columna A
            $sheet->setCellValue('B' . $row, $item['Horas Contratadas']); // Columna B
            $sheet->setCellValue('C' . $row, $item['Horas Consumidas']); // Columna C
            $sheet->setCellValue('D' . $row, $item['Horas Contratadas'] - $item['Horas Consumidas']); // Diferencia en Columna D
            $row++;
        }

        $sheet->setCellValue('A' . $row, 'Total');
        $sheet->setCellValue('B' . $row, '=SUM(B2:B' . ($row - 1) . ')');
        $sheet->setCellValue('C' . $row, '=SUM(C2:C' . ($row - 1) . ')');
        $sheet->setCellValue('D' . $row, '=SUM(D2:D' . ($row - 1) . ')');

        $writer = new Xlsx($file_excel);
        $fileName = "ReporteMensual.xlsx";

        return new StreamedResponse(function() use ($writer){
            $writer->save('php://output');
        },200,[
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Mensajes de validación personalizados
        $message = [
            'nm-ot.required' => 'El número de OT es obligatorio.',
            'nm-ot.string' => 'El número de OT debe ser texto.',
            'nm-ot.max' => 'El número de OT no puede exceder 115 caracteres.',
            'es-ot.required' => 'El estado es obligatorio.',
            'es-ot.numeric' => 'El estado debe ser numérico.',
            'es-ot.exists' => 'El estado seleccionado no es válido.',
            'cl-ot.required' => 'El cliente es obligatorio.',
            'cl-ot.numeric' => 'El cliente debe ser numérico.',
            'cl-ot.exists' => 'El cliente seleccionado no es válido.',
            'f-ot.required' => 'El campo fee es obligatorio.',
            'f-ot.boolean' => 'El campo fee debe ser verdadero o falso.',
            'py-ot.required' => 'El proyecto es obligatorio.',
            'py-ot.max' => 'El proyecto no puede exceder 225 caracteres.',
            'vl-ot.required' => 'El valor es obligatorio.',
            'vl-ot.integer' => 'El valor debe ser un número entero.',
            'vl-ot.min' => 'El valor debe ser mayor a 0.',
            'vl-ot.max' => 'El valor no puede exceder 9,999,999,999.',
            'ej-ot.required' => 'El ejecutivo es obligatorio.',
            'ej-ot.numeric' => 'El ejecutivo debe ser numérico.',
            'ej-ot.exists' => 'El ejecutivo seleccionado no es válido.',
            'hr-ot.required' => 'Las horas totales son obligatorias.',
            'fh-ot.required' => 'La fecha de inicio es obligatoria.',
            'fh-ot.date' => 'La fecha de inicio debe ser una fecha válida.',
            'ff-ot.required' => 'La fecha de fin es obligatoria.',
            'ff-ot.date' => 'La fecha de fin debe ser una fecha válida.'
        ];

        // Normaliza el valor eliminando puntos (miles)
        $request->merge([
            'vl-ot' => str_replace('.', '', $request->input('vl-ot'))
        ]);

        $validateData = $request->validate([
            'nm-ot' => 'required|string|max:115',
            'es-ot' => 'required|numeric|exists:estados,id',
            'cl-ot' => 'required|numeric|exists:clientes,id',
            'f-ot' => 'required|boolean',
            'py-ot'=> 'required|string|max:225',
            'vl-ot' => 'required|integer|min:1|max:9999999999',
            'ej-ot' => 'required|numeric|exists:users,id',
            'hr-ot' => 'required|numeric|min:1',
            'fh-ot' => 'required|date',
            'ff-ot' => 'required|date'
        ], $message);

        $create_ots = Ots::create([
            'numero_ot' => $validateData['nm-ot'],
            'estados_id' => $validateData['es-ot'],
            'clientes_id' => $validateData['cl-ot'],
            'fee' => $validateData['f-ot'],
            'proyecto' => $validateData['py-ot'],
            'valor' => $validateData['vl-ot'],
            'users_id' => $validateData['ej-ot'],
            'horas_totales' => $validateData['hr-ot'],
            'fecha_inicio' => $validateData['fh-ot'],
            'fecha_fin' => $validateData['ff-ot']
        ]);

        if ($create_ots) {
            return redirect()->route('Ots')->with([
                'otSuccess' => 'La OT se ha creado correctamente.',
                'alert-type' => 'success',
                'showModel' => true
            ]);
        } else {
            return redirect()->route('Crear OT')->with([
                'otError' => 'La OT no se ha creado correctamente.',
                'alert-type' => 'error',
                'showModel' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
