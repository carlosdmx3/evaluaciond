<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\RespuestasRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Alumno;
use App\Evaluacion;
use App\EvaluacionDocente;


class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        if (Auth::check())
        {
                if ( Auth::user()->rol == 1 ){

                                    $sedes_sql = " SELECT osede, osubsede,
                                    COUNT(oban_fin )  totales ,
                                    COUNT(CASE WHEN oban_fin=1 THEN oban_fin END) siterminaron ,
                                    COUNT(CASE WHEN oban_fin=0 THEN oban_fin END) noterminaron 
                                    FROM  users 
                                    WHERE rol=0
                                    AND oanio=2023 
                                    AND oetapa=2
                                    AND status<>'B'
                                    AND osede IS NOT null
                                    GROUP BY  osede, osubsede 
                                    ORDER BY osede ASC , osubsede ASC";
                    $sedes = DB::select($sedes_sql);

                    $totalG_sql =" SELECT COUNT(oban_fin) AS total
                                    FROM users 
                                    WHERE rol=0
                                    AND oanio = 2023
                                    AND oetapa = 2 
                                    AND status<>'B' ";
                    $totalG = DB::select($totalG_sql);

                    $totalSI_sql =" SELECT COUNT(oban_fin) AS totalsi
                                    FROM users 
                                    WHERE rol=0
                                    AND oanio = 2023
                                    AND oetapa = 2 
                                    AND oban_fin=1 
                                    AND status<>'B'";
                    $totalSI = DB::select($totalSI_sql);

                    $totalNO_sql =" SELECT COUNT(oban_fin) AS totalno
                                    FROM users 
                                    WHERE rol=0
                                    AND oanio = 2023
                                    AND oetapa = 2
                                    AND oban_fin=0 
                                    AND status<>'B'";
                    $totalNO = DB::select($totalNO_sql);
                     
        
                return view('admin.index', ['sedes'   => $sedes,
                                            'totalG'  => $totalG,
                                            'totalSI' => $totalSI,
                                            'totalNO' => $totalNO,
                                            ]);
                }else if ( Auth::user()->rol == 0 ){
                                                        
$users = DB::table('users')
                    ->select('id', 'name', 'omatricula', 'ofolio', 'oanio', 'oetapa')
                    ->where('id', '=', auth()->user()->id )
                    ->where('oanio', '=', '2023' )
                    ->where('oetapa', '=', '2' )
                    ->where('status', '=', 'A' )
                    ->first();
                                        $docente = DB::table('alumno_docente')
                    ->select('id','odocente')
                    ->where('id_user', '=', auth()->user()->id )
                    ->get();

                
                $alumno = DB::table('alumno_docente')
                    ->select('id', 'id_user', 'omatricula', 'ofolio', 'odocente', 'oasignatura')
                    ->where('id_user','=', auth()->user()->id  )
                    ->where('status', '=', 'A' )
                    ->where('oanio', '=', '2023' )
                    ->where('oetapa', '=', '2' )
                    ->OrderBy('odocente', 'ASC')
                    ->OrderBy('oasignatura', 'ASC')
                    ->GroupBy('id',  'id_user','omatricula', 'ofolio','odocente', 'oasignatura')
                    ->get();

                $docenteval = DB::table('docente_eval')
                    ->select('id','id_alumno_usr','id_docente','oban_fin','op1','op2','op3','op4','op5','op6','op7','op8','op9','op10','op11','op12','op13','op14','op15','op16','op17','op18','op19','op20','op21','op22','op23','op24','op25','op26','op27','op28','op29','op30','op31','op32','op33','op34','op35')
                    ->where('id_alumno_usr', auth()->user()->id )
                    ->where('status', '=', 'A' )
                    ->OrderBy('id_alumno_usr', 'ASC')
                    ->OrderBy('id_docente', 'ASC')
                    ->get();

                $alumnod = DB::table('alumno_docente')
                    ->select('id_user','onombre','osede','osubsede','omatricula','ofolio','oprograma')
                    ->where('id_user', '=', auth()->user()->id)
                    ->where('oanio', '=', '2023' )
                    ->where('oetapa', '=', '2' )
                    ->where('status', '=', 'A' )
                    ->groupBy('id_user','onombre','osede','osubsede','omatricula','ofolio','oprograma')
                    ->get();

                $docentevalc = DB::table('docente_eval')
                    ->select(DB::raw('count(oban_fin) as total'))
                    ->where('id_alumno_usr','=',auth()->user()->id)
                    ->where('status', '=', 'A' )
                    ->first();

                $docenteval2 = DB::table('docente_eval')
                    ->select(DB::raw('count(oban_fin) as totalc'))
                    ->where('id_alumno_usr','=',auth()->user()->id)
                    ->where('oban_fin','=',1)
                    ->where('status', '=', 'A' )
                    ->first();

                    $documento = DB::table('comprobante')
                    ->where('status', '=', 'A' )
                    ->get();

                return view('evaluacion.index', [   'alumno' => $alumno ,
                    'docente' => $docente,
                                                        'users' => $users, 
                                                        'docenteval' => $docenteval, 
                                                        'alumnod'=>$alumnod,
                                                        'docentevalc' => $docentevalc,
                                                        'docenteval2' => $docenteval2, 
                                                        'documento'=>$documento ]);

                }

            }else{
                return view('welcome');
            }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evaluacion = DB::table('evaluacion')
            ->select('id', 'odescripcion', 'oseccion', 'onumpregunta')
            ->where('status', '=', 'A' )
            ->OrderBy('onumpregunta', 'ASC')
            ->get();

        $alumno = DB::table('alumno_docente')->find($id);
        
/*
        $docenteval = DB::table('docente_eval')
            ->select('id','id_alumno_usr','id_docente','op1','op2','op3','op4','op5','op6','op7','op8','op9','op10','op11','op12','op13','op14','op15',
                    'op16','op17','op18','op19','op20','op21','op22','op23','op24','op25','op26','op27','op28','op29','op30','op31','op32','op33','op34','op35', 'oban_fin')
            ->where('id_alumno_usr', '=', auth()->user()->id )
            ->where('id_docente', '=', $id )
            ->where('status', '=', 'A' )
            ->get();
*/
            $docenteval = DB::table('docente_eval')
            ->select('id','id_alumno_usr','id_docente','op1','op2','op3','op4','op5','op6','op7','op8','op9','op10','op11','op12','op13','op14','op15',
                    'op16','op17','op18','op19','op20','op21','op22','op23','op24','op25','op26','op27','op28','op29','op30','op31','op32','op33','op34','op35', 'oban_fin')
            ->where('id_docente', '=', $id )
            ->where('status', '=', 'A' )
            ->get();

        return view('evaluacion.edit', ['alumno' => $alumno, 'evaluacion' => $evaluacion ,'docenteval' => $docenteval,] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RespuestasRequest $request, $id)
    {
        DB::table('docente_eval')
        ->where('id_docente', $id ) 
        ->where('status', '=', 'A' )
        ->update(array('oban_fin' => 1));
        

        $users = DB::table('users')
            ->select('id', 'name', 'omatricula', 'ofolio', 'oanio', 'oetapa')
            ->where('id', '=', auth()->user()->id )
            ->where('status', '=', 'A' )
            ->get();
    
        $alumno = DB::table('alumno_docente')
            ->select('id', 'id_user', 'omatricula', 'ofolio', 'odocente', 'oasignatura')
            ->where('omatricula', '=', auth()->user()->omatricula )
            ->where('ofolio', '=', auth()->user()->ofolio )
            ->where('status', '=', 'A' )
            ->OrderBy('odocente', 'ASC')
            ->OrderBy('oasignatura', 'ASC')
            ->GroupBy('id', 'omatricula', 'ofolio','odocente', 'oasignatura')
            ->get();

        $docenteval = DB::table('docente_eval')
            ->select('id','id_alumno_usr','id_docente','op1','op2','op3','op4','op5','op6','op7','op8','op9','op10','op11','op12','op13','op14','op15','op16','op17','op18','op19','op20','op21','op22','op23','op24','op25','op26','op27','op28','op29','op30','op31','op32','op33','op34','op35')
            ->where('id_alumno_usr', auth()->user()->id )
            ->where('status', '=', 'A' )
            ->OrderBy('id_alumno_usr', 'ASC')
            ->OrderBy('id_docente', 'ASC')
            ->get();

    return redirect()->route('evaluacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
