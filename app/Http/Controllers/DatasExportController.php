<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetallePrestacion;
use Datatables;
use App\Http\Requests\CreateValidationRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrosExport;
use App\Exports\RegistrosExportTwo;

class DatasExportController extends Controller
{

    public function fileImportExport()
    {
       return view('file-import');
    }

    public function fileImport(Request $request)
    {
       // Excel::import(new RegistrosImport, $request->file('file')->store('temp'));
        //return back();
    }

    public function fileExport(Request $request)
    {
        return (new RegistrosExport)->download('cuentas-acceso-evdoc24.xlsx');
        //return Excel::download(new RegistrosExport, 'solicitudes-periodo-sabatico.xlsx');
    }

    public function fileExportResultados(Request $request)
    {
        return (new RegistrosExportTwo)->download('resultados-evaluacion-docente-24-1.xlsx');
        //return Excel::download(new RegistrosExport, 'solicitudes-periodo-sabatico.xlsx');
    }



}
