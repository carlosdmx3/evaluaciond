@extends('layouts.app')

{{-- Customize layout sections --}}

@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Evaluación al desepeño docente')

@section('content')
<div class="col-12 card card-secondary card-outline shadow" >
    <div class="card-header bg-light shadow-sm d-flex mb-2">
        <div class="d-flex justify-content-between">
            <b><i class="icon fa fa-user"></i>&nbsp;
                Docente: </b>&nbsp;  {{ $docente->odocente }}  
            
        </div>
    </div>

    <div class="card-body table-responsive guinda">

        <x-adminlte-card title="Asignatura: {{ $docente->oasignatura }}" 
                         theme="secondary" 
                         theme-mode="outline"
                         icon="fas fa-book" 
                         header-class=" rounded-bottom border-secondary"
                         collapsible
                         style="font-size: 14px;">
                <p class="d-flex justify-content-between align-items-center">
                Contesta con veracidad y honestidad las siguientes preguntas, que tiene como objetivo, conocer tu opinión respecto del desempeño de las y los docentes que participan en el desarrollo del programa curricular que ofrece la Institución. Y selecciona la opción que mejor exprese el desempeño docente.<br>
                @if($jdocente) 
                <center><b>Total obtenido:&nbsp; {{ array_sum($jdocente) }}</b></center>
                @endif
                </p>
        </x-adminlte-card>
        
        <div class="d-flex justify-content-between align-items-center">
            <a  href="{{ route('evaluacion.index') }}" 
                class="btn btn-outline-secondary btn-sm" 
                style="text-decoration:none;">
                <span class="fas fa-reply"></span>
                <b>Regresar </b>
            </a>
        </div>
        
        <br>

        <form   name="FrmCartel" 
                id="FrmCartel" 
                method="post" 
                action="{{ route('evaluacion.update', $docente->id  ) }}" >
            @method('PATCH')
            @csrf

            <table  class="table table-sm table-responsive table-hover"  
                    style="font-size:14px;">
            <thead  class="table-secondary" 
                    align="center">
                <tr>
                    <th>PREGUNTAS DE EVALUACIÓN</th>
                </tr>
            </thead>
            <tbody>
            @foreach($secciones as $keys => $seccion)
            <tr align="center" class="table-secondary">
                <td>
                    <b>{{ $seccion->oseccion }}</b>
                </td>
            </tr>
            @foreach ($evaluacion as $key => $evaluaciones)
            @if($seccion->oseccion==$evaluaciones->oseccion)
            @php($actual = 'op'.$evaluaciones->onumpregunta)
            <tr>
                <td>
                    <b>{{ $evaluaciones->onumpregunta }} .-</b>
                    <b>{{ $evaluaciones->odescripcion }} </b><br>
                                       
                    @foreach($criterios as $k => $criterio)
                    <div class="form-check">
                        <input  class="form-check-input"  
                                type="radio"  required 
                                id="p{{$evaluaciones->onumpregunta}}"
                                name="p[{{$evaluaciones->onumpregunta}}]"
                                value="{{$criterio->ovalor}}"
                                @if($jdocente)
                                @if( old('p'.$evaluaciones->onumpregunta, $jdocente[$key])==$criterio->ovalor) checked @endif
                                @endif
                                >
                        <label class="form-check-label" for="p{{$evaluaciones->onumpregunta.$criterio->ovalor}}">
                            {{ $criterio->ocriterio }}        
                        </label>
                    </div>                        
                    @endforeach
 
                    @error('p'.$evaluaciones->onumpregunta)
                    <span style="color:red;"> 
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
 
                </td>
            </tr>
            @endif
            @endforeach
            @endforeach
            <tr>
                <td>
                    <div class="form-group">
                        <label for="maxLength">
                        ¿Desea realizar algún comentario, reconocimiento o sugerencia respecto al docente que está evaluando? (máximo 200 caracteres)
                        </label>
                        <div class="form-check">
                            <input  class="form-check-input"  
                                    type="radio"  required 
                                    id="sicomentar"
                                    name="sicomentar"
                                    value="1"
                                    onclick="mostrarComent(1)" 
                                    @if($docente->ocomentario_evaluacion) checked @endif
                                    {{ old('sicomentar') }}
                                    >
                            <label class="form-check-label" for="sicomentar">
                                Si       
                            </label>
                        </div>
                        <div class="form-check">
                            <input  class="form-check-input"  
                                    type="radio"  required 
                                    id="nocomentar"
                                    name="sicomentar"
                                    value="2"
                                    onclick="mostrarComent(2)" 
                                    @if($docente->ocomentario_evaluacion==NULL) checked @endif
                                    {{ old('nocomentar') }}
                                    > 
                            <label class="form-check-label" for="sicomentar">
                                No      
                            </label>
                        </div> 

                        <textarea   class="form-control" 
                                    id="maxLength" name="maxLength"
                                    style="resize: none;"
                                    minlength="200"
                                    maxlength="200"  
                                    rows="6">{{ old('maxLength', $docente->ocomentario_evaluacion) }}</textarea>
                        
                    </div>
                </td>
            </tr>
            </tbody>
            </table>
            

            <div class="d-flex justify-content-between align-items-center">
                <a  href="{{ route('evaluacion.index') }}" 
                    class="btn btn-outline-secondary btn-sm">
                    <span class="fas fa-reply"></span>
                    <b>Regresar</b>
                </a>
                    
                <button class="btn btn-outline-success btn-sm"
                        type="submit" 
                        @if($docente->oban_fin==1) disabled @endif >
                    <b>Evaluar a: {{  $docente->odocente }}</b>
                    <span class="fas fa-check"></span>
                </button>
            </div>
        
        </form>

    @include('layouts.modal-confirm')
  
    </div>
</div>
@endsection


@section('js')
    @if($docente->oban_fin==1)
    <script>
        function deshabilitarFormulario(formulario){
            for(i=0; i<formulario.elements.length; i++){
                formulario.elements[i].disabled = true;
            }
        }
        deshabilitarFormulario(document.getElementsByName('FrmCartel')[0]);
    </script>


    @endif
    <script type="text/javascript">
        $( document ).ready(function() {
            @if($docente->ocomentario_evaluacion==NULL && $docente->oban_fin==0)
                $('#maxLength').hide();
            @else
                $('#maxLength').show();
            @endif
        });



        function mostrarComent(id)
        {
            if(id==1){
                $('#maxLength').show();
                $('#maxLength').prop("required", true);

                        function maxLength(el) {    
            if (!('maxLength' in el)) {
                var max = el.attributes.maxLength.value;
                el.onkeypress = function () {
                    if (this.value.length >= max) return false;
                };
            }
        }

        maxLength(document.getElementById("text"));

            }
            if(id==2){
                $('#maxLength').hide();
                $("#maxLength").removeAttr("required");
            }
        }
</script>
    <script async src="https://get.geojs.io/v1/ip/geo.js"></script>
@endsection
