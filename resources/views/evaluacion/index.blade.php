@extends('layouts.app')

@section('subtitle', 'Mi curso')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Mi curso')


@section('content')
<div class="col-12 card card-secondary card-outline shadow" >

    <div class="card-header bg-light shadow-sm d-flex mb-2">
        <div class="d-flex justify-content-between">
            <b><i class="icon fas fa-users"></i>&nbsp;
            Personal docente para realizar la evaluación al desempeño  
            </b> 
        </div>
    </div>

    <div class="card-body table-responsive">
        @php( $carbon = new \Carbon\Carbon() )

         <x-adminlte-card title="Instrucciones" 
                         theme="info" 
                         theme-mode="outline"
                         icon="fas fa-book" 
                         header-class=" rounded-bottom border-secondary"
                         collapsible
                         style="font-size: 14px;">
            <ol>
                <li>Da click en el nombre de un docente para comenzar a evaluarlo</li>
                <li>Lee con atención cada pregunta y asigna la puntuación que representa la evaluación al desempeño del docente</li>
                <li>Para cada pregunta hay diferentes opciones de respuesta, selecciona la opción que a tu juicio es la correcta</li>
                <li>Cuando termines de evaluar a todos los docentes, podrás imprimir tu comprobante de evaluación</li>
            </ol>
        </x-adminlte-card>

        <table  class="table table-sm table-hover" 
                style="font-size:12px;">
        <thead>
            <tr class="bg-light" 
                align="center">
                <th colspan="2">DOCENTE</th>
                <th>ASIGNATURA</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($docentes as $key =>$docente)
        <tbody>
            <tr>
                <td align="center"> {{ $key+1 }} </td>
                <td> {{ $docente->odocente }}    </td>
                <td> {{ $docente->oasignatura }} </td>
                <td align="center">
                    <a  href="{{ route('evaluacion.edit', $docente->id) }}"
                        class="btn btn-info btn-xs"
                        title="Evaluar a: {{ $docente->odocente }} ">
                        &nbsp; {{ $docente->eval }}&nbsp;<br>
                    </a>
                </td>
            </tr>
        </tbody>
        @endforeach
        <tfoot>
            <tr>
                <td colspan="5">
                @if( Auth::user()->oban_fin==1)
                    <a  href="reports/comprobante.php?tokenSEIEM1d={{ Auth::user()->id }}" 
                        target="_blank"
                        class="btn btn-success btn-sm btn-block"
                        style="text-decoration:none; font-size:14px;">
                        Comprobante de evaluación&nbsp;
                        <i  class="far fa-file-pdf"></i>
                    </a>
                @endif
                </td>
            </tr>
        </tfoot>
        </table>
            
    </div>
</div>
@endsection

