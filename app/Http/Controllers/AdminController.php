<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\RespuestasRequest;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Alumnos;
use App\Models\Evaluacion;
use App\Models\EvaluacionDocente;

class AdminController extends Controller
{
    
 
    protected $paginationTheme = 'bootstrap';
    public function index()
    {
        $registros = User::select('osede', 'osubsede',
                        DB::raw('COUNT(id) AS total_alumnos'),
                        DB::raw('COUNT(CASE WHEN oban_fin=1 THEN oban_fin END) AS si_terminaron'),
                        DB::raw('COUNT(CASE WHEN oban_fin=0 THEN oban_fin END) AS no_terminaron') 
                        )
                    ->whereOanio(2024)
                    ->whereOetapa(1)
                    ->whereRol(0)
                    ->groupBy('osede', 'osubsede')
                    ->orderBy('osede', 'ASC')
                    ->orderBy('osubsede', 'ASC')
                    ->get();

        $totales =  User::select( 
                        DB::raw('COUNT(id) AS total'),
                        DB::raw('COUNT(CASE WHEN oban_fin=1 THEN oban_fin END) AS totalsi'),
                        DB::raw('COUNT(CASE WHEN oban_fin=0 THEN oban_fin END) AS totalno') 
                        )
                    ->whereOanio(2024)
                    ->whereOetapa(1)
                    ->whereRol(0)
                    ->first();
         
        return view('admin.index', 
                    [
                        'registros' => $registros,
                        'totales'   => $totales,
                    ]);        
    }


    public function show(Request $request, $id)
    {
        $sedes = Alumno::select('osede')
        ->whereOanio(2024)
        ->whereOetapa(1)
        ->OrderBy('osede', 'ASC')
        ->groupBy('osede')
        ->get();


        if($request->sedes==1){
            $alumnodoc_sql=" SELECT u.id, u.name, u.omatricula, u.ofolio, u.osede, u.osubsede, ad.oprograma, 
                            ad.ogrado, ad.ogrupo
                            FROM users u, e9alumno_docente ad
                            WHERE u.id = ad.id_user
                            AND u.oanio=2023 AND u.oetapa = 2 
                            AND ad.oanio=2023 AND ad.oetapa=2 
                            AND u.rol=0
                            GROUP BY  u.id, u.name, u.omatricula, u.ofolio, u.osede, u.osubsede,ad.oprograma, 
                            ad.ogrado, ad.ogrupo  
                            ORDER BY u.osede ASC, u.osubsede ASC, u.name ASC";
            $alumnodoc = DB::select($alumnodoc_sql);

        }else{

            $req = $request->sedes ;
            $alumnodoc_sql="SELECT u.id, u.name, u.omatricula, u.ofolio, u.osede, u.osubsede, ad.oprograma, 
                            ad.ogrado, ad.ogrupo
                            FROM users u, e9alumno_docente ad
                            WHERE u.id = ad.id_user
                            AND u.oanio=2023 AND u.oetapa = 2 
                            AND ad.oanio=2023 AND ad.oetapa=2 
                            AND u.rol=0
                            AND u.osede = '$req'
                            GROUP BY  u.id, u.name, u.omatricula, u.ofolio, u.osede, u.osubsede,ad.oprograma, 
                            ad.ogrado, ad.ogrupo  
                            ORDER BY u.osede ASC, u.osubsede ASC, u.name ASC  ";
            $alumnodoc = DB::select($alumnodoc_sql);

        }

        return view('admin.show', 
                    [   
                        'alumnodoc' => $alumnodoc, 
                        'sedes'     => $sedes 
                    ]);

    }


    public function edit($id)
    {
        $sedes = Alumnos::select('osede')
                ->whereOanio(2024)
                ->whereOetapa(2)
                ->OrderBy('osede', 'ASC')
                ->groupBy('osede')
                ->get();

        $alumnos = Alumnos::paginate(20);

        return view('admin.edit', 
                    [   
                        'sedes'     => $sedes ,
                        'alumnos'   => $alumnos,
                    ]);

    }


    public function update(Request $request, $id)
    {
        $evaluaDoc = User::find($request->idd);
        $evaluaDoc->password  = '$2y$10$9GxM0Z6uX7LyYCHhhfwr..Tu3eUZISRdezic5M7qI09.8miAtwwlO';
        $evaluaDoc->save();        
        return redirect()->route('admin.edit',0);
    }


}
