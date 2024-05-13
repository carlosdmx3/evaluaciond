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


class EvalDocController_last extends Controller
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
        $evaluacion = Evaluacion::whereStatus('A')->OrderBy('onumpregunta', 'ASC')->get();
        $criterios  = Criterios::OrderBy('id','ASC')->get();
        $docente    = AlumnoDocente::whereId($id)->first();
        $jdocente  = [];
        $jdocente  = json_decode($docente->oevaluacion, true);
        $desempeno  = EvaluacionDocente::whereIdDocente($id)->first();

        return  view('evaluacion.edit',
                    [   
                        'evaluacion'    => $evaluacion, 
                        'criterios'     => $criterios, 
                        'docente'       => $docente, 
                        'desempeno'     => $desempeno,
                        'jdocente' => $jdocente,
                    ]);
    }

  

    public function update(RespuestasRequest $request, $id)
    {
        $evaluarx = EvaluacionDocente::whereIdDocente($id)->first();

        if(!$evaluarx){
            EvaluacionDocente::create([
            'id_docente' => $id, 'id_alumno_usr' => Auth::user()->id,
            'op1'  => $request->p1,
            'op2'  => $request->p2,
            'op3'  => $request->p3,
            'op4'  => $request->p4,
            'op5'  => $request->p5,
            'op6'  => $request->p6,
            'op7'  => $request->p7,
            'op8'  => $request->p8,
            'op9'  => $request->p9,
            'op10' => $request->p10,
            'op11' => $request->p11,
            'op12' => $request->p12,
            'op13' => $request->p13,
            'op14' => $request->p14,
            'op15' => $request->p15,
            'op16' => $request->p16,
            'op17' => $request->p17,
            'op18' => $request->p18,
            'op19' => $request->p19,
            'op20' => $request->p20,
            'op21' => $request->p21,
            'op22' => $request->p22,
            'op23' => $request->p23,
            'op24' => $request->p24,
            'op25' => $request->p25,
            'op26' => $request->p26,
            'op27' => $request->p27,
            'op28' => $request->p28,
            'op29' => $request->p29,
            'op30' => $request->p30,
            'op31' => $request->p31,
            'op32' => $request->p32,
            'op33' => $request->p33,
            'op34' => $request->p34,
            'op35' => $request->p35,
            'oban_fin' => 1, 'oanio' => date('Y'), 'oetapa' => 1,
            ]);

        $updoc = AlumnoDocente::find($id);
        $updoc->oban_fin = 1;
        $updoc->save();
        
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
        }

        
       

        return redirect()->route('evaluacion.index')->with('evaluacion', ' ');
    }



}
