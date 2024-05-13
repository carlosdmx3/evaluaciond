<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
Use App\Models\User;
use App\Models\Alumno;
use App\Models\Evaluacion;
use App\Models\EvaluacionDocente;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ( Auth::user()->rol == 1 ){
            return redirect()->guest('administrador');
        }else if ( Auth::user()->rol == 0 ){
            return redirect()->guest('evaluacion');
        }else{
            return view('welcome');
        }
    }



}
