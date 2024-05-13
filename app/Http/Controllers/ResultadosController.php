<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RespuestasRequest;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Alumno;
use App\Models\AlumnoDocente;
use App\Models\EvaluacionDocente;
use App\Models\Evaluacion;
use App\Models\Criterios;


class ResultadosController extends Controller
{

    public function index()
    {
        $docentes = AlumnoDocente::select('id', 'osede', 'osubsede', 'onombre', 'omatricula', 'ofolio', 'ogrado', 'ogrupo', 'oprograma','odocente','oasignatura','oban_fin', 'ocomentario_evaluacion', 'oevaluacion', 
                    DB::raw('JSON_ARRAY(oevaluacion) as eval'),
                    DB::raw('CASE  
                                 WHEN oban_fin = 0 
                                 THEN "NO EVALUADO" 
                                 WHEN oban_fin = 1
                                 THEN "EVALUADO"
                                END AS estado'))
                    ->whereObanFin(1)
                    ->OrderBy('osede', 'ASC', 'osubsede', 'ASC', 'ononmbre', 'ASC')
                    ->take(20)
                    ->get();

        return  view('admin.resultados.index', 
                    [ 'docentes' => $docentes ]);
    }



}
