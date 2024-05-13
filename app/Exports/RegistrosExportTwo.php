<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AlumnoDocente;

class RegistrosExportTwo implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $presta = AlumnoDocente::select('osede', 'osubsede', 'onombre', 'omatricula', 'ofolio', 'ogrado', 'ogrupo', 'oprograma', 'odocente', 'oasignatura', 'oevaluacion', 
            DB::raw('CASE
                        WHEN 
                            ocomentario_evaluacion IS NULL
                        THEN 
                            "----"
                        WHEN 
                            ocomentario_evaluacion IS NOT NULL
                        THEN 
                            ocomentario_evaluacion
                        END AS ocomentario'),
            DB::raw('CASE 
                        WHEN 
                            oban_fin=1 
                        THEN 
                            "EVALUADO" 
                        WHEN 
                            oban_fin=0
                        THEN 
                            "NO EVALUADO"
                    END AS obanfin'))
            ->whereOanio(date("Y"))  
            ->whereOetapa(1)  
            ->OrderBy('osede', 'ASC', 'osubsede', 'ASC', 'onombre', 'ASC', 'oasignatura', 'ASC', 'odocente', 'ASC')     
            ->get();

        return $presta;        
    }


    public function headings() : array
    {   
        return [
                'INSTITUCION',
                'SEDE',
                'ALUMNO',
                'CUENTA ACCESO',
                'CONTRASENA',
                'GRADO',
                'GRUPO',
                'PROGRAMA',
                'NOMBRE DEL DOCENTE',
                'ASIGNATURA',
                'PUNTAJE OBTENIDO',
                'COMENTARIO',
                'ESTATUS',
            ];
    }


}
