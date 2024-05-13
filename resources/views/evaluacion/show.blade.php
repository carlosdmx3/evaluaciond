

@extends('adminlte::page', ['iFrameEnabled' => false])

@section('title', 'Evaluación de desempeño')

@section('content_header')
    <br>
<!--
    <h1><b>Productos Index</b></h1>
-->
@stop

@section('content')

<div class="col-10 card card-purple card-outline shadow">
        <div class="card-header bg-light shadow-sm d-flex mb-2">
                <div  style="font-size:14px;">
                        <i class="icon fas fa-spell-check" style="color:green;"></i>
                            &nbsp; <b>Profesor(a):</b> &nbsp;  
                            {{ $alumno->odocente }}    
                        <br>
                        <i class="fas fa-book" style="color:green;"></i>
                            &nbsp; <b> Asignatura: </b> &nbsp;    
                            {{ $alumno->oasignatura }}      
                            {{ auth()->user()->id }} . {{ $alumno->id }}
                        @if($docenteval)
                        {{ $docenteval->id }}. {{ $docenteval->id_alumno_usr }} . {{$docenteval->id_docente }}
                        @endif                               
                </div>
                
        </div>

        <div style="font-size:14px;">
            Contesta con veracidad y honestidad las siguientes preguntas, que tiene como objetivo, conocer tu opinión respecto del desempeño de las 
            y los docentes que participan en el desarrollo del programa curricular que ofrece la Institución.<br>- Selecciona la opción que mejor exprese el desempeño docente, considerando que 5 es la calificación máxima.
        </div> 

        <div class="card-body table-responsive">
        <form name="FrmCartel" id="FrmCartel" method="POST" action="{{ route('pages.docentes.show', $alumno  ) }}" >
        @method('PATCH')
                <table id="example1"  class="table table-sm table-striped  table-hover "  style="font-size:14px;">
                    <thead class="bg-purple" align="center">
                        <tr>
                            <th>#</th>
                            <th>Preguntas de evaluación</th>
                        </tr>
                        </thead>
                    <tbody>
            
                    <?php $count=0; ?>
                        @php($count=0)
                        @foreach ($evaluacion as $evaluaciones)
                        @php($count++)
                        <tr>
                            <td width="5%"  align="right">  
                                <b>{{ $count }} .-</b>
                            </td>
                            <td  width="95%">
                                <b>{{ $evaluaciones->odescripcion }} </b>

                                @php($actual = 'op'.$evaluaciones->onumpregunta) 
                                <br> p{{ $evaluaciones->onumpregunta }}
                                <input  type="radio" 
                                        id="p{{ $count }}1" 
                                        name="p{{ $evaluaciones->onumpregunta }}" 
                                        {{ $docenteval->$actual =='1' ? 'checked' : ''}}
                                        value="1">
                                Totalmente en desacuerdo

                                &nbsp;&nbsp;
                                <input  type="radio" 
                                        id="p{{ $count }}2" 
                                        name="p{{ $evaluaciones->onumpregunta }}" 
                                        {{ $docenteval->$actual =='2' ? 'checked' : ''}}
                                        value="2">
                                En desacuerdo

                                &nbsp;&nbsp;
                                <input  type="radio" 
                                        id="p{{ $count }}3" 
                                        name="p{{ $evaluaciones->onumpregunta }}" 
                                        {{ $docenteval->$actual =='3' ? 'checked' : ''}}
                                        value="3">
                                Ni de acuerdo ni en desacuerdo

                                &nbsp;&nbsp;
                                <input  type="radio" 
                                        id="p{{ $count }}4" 
                                        name="p{{ $evaluaciones->onumpregunta }}" 
                                        {{ $docenteval->$actual =='4' ? 'checked' : ''}}
                                        value="4">
                                De acuerdo    
                                
                                &nbsp;&nbsp;                   
                                <input  type="radio" 
                                        id="p{{ $count }}5" 
                                        name="p{{ $evaluaciones->onumpregunta }}" 
                                        {{ $docenteval->$actual =='5' ? 'checked' : ''}}
                                        value="5">
                                Totalmente de acuerdo  
                                <br>
                                              
                            </td>
                        </tr>
                        @endforeach    

                    </tbody>                  
                </table>

                <br>
                    
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('pages.docentes.index') }}" class="btn btn-outline-secondary btn-sm"> 
                        <span class="fas fa-reply"></span> 
                        <b>Regresar</b>
                    </a>
                    &nbsp;&nbsp;
<!--
                         onClick=" var respuesta= validarFrmPreguntas(document.FrmCartel); if(respuesta){ document.FrmCartel.submit(); }"
-->
                    <button class="btn btn-outline-success btn-sm">
                        <b>Concluir evaluacion </b>
                        <span class="fas fa-check"></span>
                    </button>                                                            
                </div>

                
        </form>
        </div>
         <span id="user_ip">
            <span class="icon"><i class="loader"></i></span>
        </span>
        Country code<span id="user_countrycode"><span class="icon"><i class="loader"></i></span></span>

</div>




@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi AdminLTE!'); </script>

<script>
    function validarFrmPreguntas(FrmCartel)
    {
        document.getElementById("FrmCartel").addEventListener("submit", function(event){
    let hasError = false;

    for (i=1; i<36; i++)
    {
        
        var preg = i+'';
        var texto = 'p'+preg;
        //alert (document.getElementById(texto+'1').value);
            if (document.getElementById(texto+'5').checked == false && 
        document.getElementById(texto+'4').checked== false && 
        document.getElementById(texto+'3').checked== false &&
        document.getElementById(texto+'2').checked== false &&  
        document.getElementById(texto+'1').checked== false) {
            
            alert('Favor de responder la pregunta '+i);
            hasError = true;
        }
    }
    
    // si hay algún error no efectuamos la acción submit del form
    if(hasError) event.preventDefault();
});
    }
</script>



<script type="application/javascript">
function geoip(json){
var userip      = document.getElementById("user_ip");
var countrycode = document.getElementById("user_countrycode");
userip.textContent      = json.ip;
countrycode.textContent = json.country_code;
}
</script>
<script async src="https://get.geojs.io/v1/ip/geo.js"></script>
@stop