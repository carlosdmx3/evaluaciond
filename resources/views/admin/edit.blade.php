@extends('layouts.app')

{{-- Customize layout sections --}}

@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Alumnos de evaluación al desempeño del personal docente')

@section('content')
<div class="col-12 card card-secondary card-outline shadow" >
    <div class="card-header bg-light shadow-sm d-flex mb-2">
        <div class="d-flex justify-content-between">
            <b> <i class="fas fa-users-cog dorado"></i>
                <span class="guinda"> ALUMNOS DE EVALUACIÓN AL DESEMPEÑO DEL PERSONAL DOCENTE </span>
            </b>
        </div>
    </div>
    <div class="card-body table-responsive">

        <form name="FrmCartel" id="FrmCartel" method="get" action="{{ route('administrador.show', 0 ) }}" >
            @method('PATCH')
            @csrf

              <div class="input-group mb-3 input-group-sm">
                    <select class="form form-control col-4" name="sedes" id="sedes">
                        <option selected disabled>-- Elejir Institución --</option>
                        <option value="1">TODAS</option>
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->osede }}">{{ $sede->osede }}</option>
                        @endforeach
                    </select>
                    &nbsp;&nbsp;
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-sm"  >
                                <b> Buscar</b>
                                <span class="fa fa-search"></span>
                            </button> 
                    </div>
              </div>            
                <br>
                <br>
        </form>
        
        

        <table  id="example17" class="table table-sm table-striped table-hover table-bordered" 
                style="font-size:14px;">
            <thead class="table-secondary">
                <tr >
                    <th>#</th>
                    <th>INSTITIUCIÓN</th>
                    <th>SEDE</th>
                    <th>MATRÍCULA</th>
                    <th>FOLIO</th>
                    <th>NOMBRE DEL ALUMNO</th>
                    <th>PROGRAMA</th>
                    <th>GRADO</th>
                    <th>GRUPO</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($alumnos as $key=>$alumno)
                <tr valign="middle">
                    <td width="5%" align="center"> {{ $count }} </td>
                    <td  width="20%"> {{ $alumno->alumnodocente->osede }} </td>
                    <td  width="10%"> {{ $alumno->alumnodocente->osubsede }} </td>
                    <td  width="10%"> {{ $alumno->omatricula }} </td>
                    <td  width="10%"> {{ $alumno->alumnodocente->ofolio }}</td>
                    <td  width="25%"> {{ $alumno->name }} </td>
                    <td  width="20%"> {{ $alumno->alumnodocente->oprograma }} </td>
                    <td  width="20%"> {{ $alumno->alumnodocente->ogrado }} </td>
                    <td  width="20%"> {{ $alumno->alumnodocente->ogrupo }} </td>
                </tr>
            @endforeach
            </tbody>
            </table>

 
            {{ $alumnos->links('vendor.pagination.bootstrap-5') }}

    </div>
</div>
@endsection


