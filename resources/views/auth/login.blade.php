@extends('layouts.inicio')

@section('title')
    Cursos carrera administrativa
@endsection


@section('content_text')
<center>
    <b class="guinda" style="font-family: Italic; font-size:20px;">
        Evaluación al desempeño del personal docente
    </b>
    <br>
    <img class="img-fluid" src="img/cursocarreraa.png" width="70%">
</center>
@endsection

@section('login')


    @if (Route::has('login'))
        @auth
            <a class="nav-link" href="{{ route('home') }}" style="text-decoration:none; color:green;">
                <span class="spann">
                    <img src="img/ircursos.png" width="60%" class="img-fluid" >
                </span>
            </a>
        @else
            <div class=" container-fluid shadow " style="font-size:10px;">
                <br>
                <div class="tx2 colorBG card-header " style="color:white;" >
                    &nbsp;<b>INGRESA AL SISTEMA </b>&nbsp;  <i class="fa fa-desktop"></i>
                </div>

                <div class="card-body">
                    <p style="font-size:14px;"  class="guinda">Ingresa tú cuenta y el folio que se te asignó </p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input  type="text" name="email"
                                        class="tx2 form-control guinda input-sm @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}"
                                        placeholder="Cuenta"
                                        autofocus>
                                <div class="input-group-append">
                                    <div class=" tx2 input-group-text" >
                                        <span class="fa fa-user-circle guinda {{ config('adminlte.classes_auth_icon', '') }}" style=" font-weight: bold;"></span>&nbsp;
                                    </div>
                                </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="input-group mb-3" id="show_hide_password">
                                        <input  type="password" name="password"
                                                class="tx2 guinda password1 form-control @error('password') is-invalid @enderror"
                                                placeholder="Contraseña">
                                        <div id="pwd" class="input-group-append">
                                            <div class=" tx2 input-group-text">
                                                <a href="" style="color:black;">
                                                    <i  class="fa fa-eye-slash guinda{{ config('adminlte.classes_auth_icon', '') }}" 
                                                        aria-hidden="true" style="font-weight: bold;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div>
                                <button type=submit class="btn btn-outline-info btn-block btn-sm "
                                        style="text-decoration:none; ">
                                    Ingresar <i class="fa fa-sign-in"></i>
                                </button>
                                <!--
                                <hr>
                                 <a href="{{ url('/') }}" type=submit class="btn btn-outline-secondary btn-block btn-sm "
                                        style="text-decoration:none; ">
                                    Ir a registro <i class="fa fa-envelope"></i>
                                </a>--> 

                            </div>
                        </form>
            </div>
        </div>
        @endauth
    @endif


@endsection












