@extends('layouts.app')

{{-- Customize layout sections --}}

@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Avances en la evaluación al personal docente')

@section('content')
<div class="col-12 card card-secondary card-outline shadow" >
    <div class="card-header bg-light shadow-sm d-flex mb-2">
        <div class="d-flex justify-content-between">
            <b><i class="icon fas fa-chart-pie dorado"></i>
                Avance en la evaluación al personal docente
            </b>
        </div>
    </div>
    <div class="card-body table-responsive">

        <a  href="cuentasUsers/CuentasAcceso2023-2.xlsx" 
            target="_blank"
            download
            class="btn btn-outline-success btn-sm">
            Descargar cuentas de acceso
            <i class="fa fa-file-excel"></i>
        </a>
        <br>
        <br>

        <table  id="example1" 
                class="table table-sm table-striped table-bordered table-hover " style="font-size:12px;" >
            <thead class="colorBG " >
                <tr style="text-align: center;" >
                    <th>INSTITUCIÓN</th>
                    <th>SEDE</th>
                    <th>ALUMNO</th>
                    <th>GRADO/GRUPO</th>
                    <th colspan="2">ACCESO</th>
                    <th>PROGRAMA</th>
                    <th>DOCENTE</th>
                    <th>ASIGNATURA</th>
                    <th>PUNTAJE OBTENIDO</th>
                    <th>COMENTARIO</th>
                    <th>ESTADO</th>
                </tr>
            </thead>
            @foreach($docentes as $docente)
            <tr valign="middle">
                <td> {{ $docente->osede }}      </td>
                <td> {{ $docente->osubsede }}   </td>
                <td> {{ $docente->onombre }}    </td>
                <td> {{ $docente->ogrado.' - '.$docente->ogrupo }} </td>
                <td> {{ $docente->omatricula }} </td>
                <td> {{ $docente->ofolio }}     </td>
                <td> {{ $docente->oprograma }}  </td>
                <td> {{ $docente->odocente }}   </td>
                <td> {{ $docente->oasignatura }}</td>
                <td> 
                    {{ ($docente->eval) }}
                </td>
                <td> @if($docente->oasignatura!=NUll)
                        {{$docente->oasignatura}}
                     @endif
                </td>
                <td> {{ $docente->estado }}      </td>
            </tr>
            @endforeach
        </table>
        <br>

    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('js')
    <script> console.log('Hi!'); </script>

@endsection
