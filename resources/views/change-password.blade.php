
@extends('adminlte::page', ['iFrameEnabled' => false])



@section('title', 'Mi cuenta: '.$users->name)

@section('content_header')
    <br>
<!--
    <h1><b>Productos Index</b></h1>
-->
@stop

@section('content')





<div class="card card-purple card-outline shadow col-12 col-lg-6">
    <div class="card-header bg-light shadow-sm d-flex mb-2">
            <div class="d-flex justify-content-between">

                    <b><i class="fas fa-user-lock"  style="color:green;"></i> Hola:</b>   &nbsp;
                    {{ $users->name }} 
                               
            </div>
    </div>

    <div class="card-body table-responsive" >
    <div class="container-fluid">


        <div class="card-body table-responsive">
        <form action="{{ route('update-password') }}" method="POST" id="change-pwd">
            @csrf
                    @if (session('status'))
                        <div id="success-alert" class="alert callout callout-success alert-dismissable fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert"  style="color:green;" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span>
                            </button>
                                <p><i class="icon fas fa-exclamation-triangle" style="color:green;"></i>
                                <b>{{ session('status') }}  </p>
                        </div> 
                    @elseif (session('error'))
                        <div id="success-alert" class="alert callout callout-danger alert-dismissable fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert"  style="color:red;" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span>
                            </button>
                                <p><i class="icon fas fa-exclamation-triangle" style="color:#17a2b8;"></i>
                                {{ session('status') }}  </p>
                        </div> 
                    @endif
                    
                    
@if ( $users->password=='$2y$10$9GxM0Z6uX7LyYCHhhfwr..Tu3eUZISRdezic5M7qI09.8miAtwwlO' )

                    <div class="input-group mb-3 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"  style="width:130px;">Password anterior</span>
                        </div>
                            <input  type="text" 
                                    name="old_password" 
                                    id="oldPasswordInput"
                                    class="form-control @error('old_password') is-invalid @enderror"
                                    value="evaluacion2022">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <p><center style="color:red;"><b>¡¡ Recuerda, anota y/o memoriza tu nuevo password !!</b></center></p>
                    <div class="input-group mb-3 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"  style="width:130px;">Nuevo password</span>
                        </div>
                            <input  type="text"
                                    name="new_password" 
                                    id="newPasswordInput"
                                    class="form-control @error('new_password') is-invalid @enderror" >
                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>

                    <div class="input-group mb-3 input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text"  style="width:130px;">Confirmar password</span>
                        </div>
                            <input  type="password" 
                                    name="new_password_confirmation"  
                                    id="confirmNewPasswordInput"
                                    class="form-control">
                    </div>

                    <div class="d-flex justify-content-between align-items-center"> 
                        <a href="{{ route('pages.docentes.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-reply"></i>
                            Ir Evaluación al desempeño
                        </a>

                        <button class="btn btn-outline-success btn-sm">
                            Cambiar password 
                            <i class="fas fa-user-lock"></i>
                        </button>
                    </div>
@endif

        </form>
        </div>


    </div>
    </div>
</div>



@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap4.min.css') }}">
@stop

@section('js')
    <script> console.log('Hi AdminLTE!'); </script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/buttons.colVis.min.js') }}"></script>

    

<script>
$(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 5000);
});


$(function () {
    
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "language": 'es',
      "buttons": ["pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');    

});

$(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);
});



</script>


@stop




