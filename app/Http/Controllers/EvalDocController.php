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


class EvalDocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {
        $docentes = AlumnoDocente::select('id','odocente','oasignatura','oban_fin',
                    DB::raw('CASE  
                                 WHEN oban_fin = 0 
                                 THEN "EVALUAR" 
                                 WHEN oban_fin = 1
                                 THEN "EVALUADO"
                                END AS eval'))
                    ->whereIdUser(Auth::user()->id)
                    ->OrderBy('odocente', 'ASC', 'oasignatura', 'ASC')
                    ->get();

        return  view('evaluacion.index', [ 'docentes' => $docentes ]);
    }



    public function edit($id)
    {
        $secciones  = Evaluacion::select('oseccion')
                        ->whereOanio(2024)
                        ->GroupBy('oseccion')->get();
        $evaluacion = Evaluacion::whereOanio(2024)
                        ->OrderBy('onumpregunta', 'ASC')->get();

        $criterios  = Criterios::OrderBy('id','ASC')->get();
        $docente    = AlumnoDocente::whereId($id)->first();

        $jdocente  = [];
        $jdocente  = json_decode($docente->oevaluacion, true);
        //$desempeno  = EvaluacionDocente::whereIdDocente($id)->first();

        return  view('evaluacion.edit',
                    [   
                        'secciones'     => $secciones,
                        'evaluacion'    => $evaluacion, 
                        'criterios'     => $criterios, 
                        'docente'       => $docente, 
                        'jdocente' => $jdocente,
                    ]);
    }

  

    public function update(Request $request, $id)
    {   

        $validator = Validator::make($request->all(), [
            'p.*' => 'required', // Validar que las respuestas no estén vacías
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $respuestas = $request->input('p', []);

        $resp = AlumnoDocente::find($id);
        $resp->oevaluacion = json_encode(array_values($respuestas)); //$respuestas;
        $resp->ocomentario_evaluacion = $request->input('maxLength');
        $resp->oban_fin = 1;
        $resp->save();

        $tdoc = AlumnoDocente::select(DB::raw('count(odocente) as total'))
            ->where('id_user','=',auth()->user()->id)
            ->first();

        $term = AlumnoDocente::select(DB::raw('count(oban_fin) as totalc'))
            ->where('id_user','=',auth()->user()->id)
            ->where('oban_fin','=',1)
            ->first();

            if( $tdoc->total == $term->totalc ){
                $evaluaDoc = User::find( auth()->user()->id  );
                $evaluaDoc->oban_fin  = 1;
                $evaluaDoc->save();
            }
    
        return redirect()->route('evaluacion.index')->with('evaluacion', ' ');
    }



}
