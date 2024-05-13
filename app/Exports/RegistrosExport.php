<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\AlumnoDocente;

class RegistrosExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $cuentas = AlumnoDocente::select('osede', 'osubsede', 'onombre', 'omatricula', 'ofolio', 'ogrado', 'ogrupo', 'oprograma')
            ->whereOanio(date('Y'))
            ->whereOetapa(1)    
            ->GroupBy('osede', 'osubsede', 'onombre', 'omatricula', 'ofolio', 'ogrado', 'ogrupo', 'oprograma')
            ->OrderBy('osede', 'ASC', 'osubsede', 'ASC', 'onombre', 'ASC')     
            ->get();

        return $cuentas;
        
    }



    public function headings() : array
    {   
        return [
                'INSTITUCIÓN',
                'SEDE',
                'ALUMNO',
                'CUENTA ACCESO',
                'CONTRASEÑA',
                'PROGRAMA',
                'GRADO',
                'GRUPO',
            ];
    }


}
