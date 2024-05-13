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
                Contesta con veracidad y honestidad las siguientes preguntas, que tiene como objetivo, conocer tu opinión respecto del desempeño de las y los docentes que participan en el desarrollo del programa curricular que ofrece la Institución. Y selecciona la opción que mejor exprese el desempeño docente.
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

            <table  class="table table-sm table-striped table-responsive table-hover "  
                    style="font-size:14px;">
            <thead  class="table-secondary" 
                    align="center">
                <tr>
                    <th>Preguntas de evaluación</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($evaluacion as $key => $evaluaciones)
            @php($actual = 'op'.$evaluaciones->onumpregunta)
            <tr>
                <td>
                    <b>{{ $evaluaciones->id }} .-</b>
                    <b>{{ $evaluaciones->odescripcion }} </b><br>
                    
                   
                    @foreach($criterios as $k => $criterio)
                    <!-- var_dump($jdocente) --> 
                    <div class="form-check">
                        <input  class="form-check-input"  
                                type="radio"
                                id="p{{$evaluaciones->id.$criterio->ovalor}}"
                                name="p{{$evaluaciones->onumpregunta}}"
                                value="{{$criterio->ovalor}}"
                                @if($desempeno && $desempeno->$actual==$criterio->ovalor) checked
                                @elseif( old('p'.$evaluaciones->onumpregunta, $actual)==$criterio->ovalor)checked 
                                @endif
                                >
                        <label class="form-check-label" for="p{{$evaluaciones->id.$criterio->ovalor}}">
                            {{ $criterio->ocriterio }}        
                            <br>
                               {{ $jdocente[$key] }}                     
                        </label>
                    </div>                        
                    @endforeach
 

                    @error('p'.$evaluaciones->id)
                    <span style="color:red;"> 
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </td>
            </tr>
            @endforeach
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
    <script async src="https://get.geojs.io/v1/ip/geo.js"></script>
@endsection
