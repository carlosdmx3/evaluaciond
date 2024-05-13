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
                            &nbsp;
                            &nbsp;
                    <div class="input-group-append">
                        <button class="btn btn-success btn-sm"  >
                                <b> Buscar</b>
                                <span class="fa fa-search"></span>
                            </button> 
                    </div>
              </div>            
                <br>
                <br>
        </form>







<table id="example1" class="table table-sm table-striped table-hover table-bordered" style="font-size:14px;">
    <thead class="colorBG">
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
        <?php $count=0; ?>
            @php($count=0)
        @foreach ($alumnodoc as $alumnodocs)
            @php($count++)
            <tr valign="middle">
                <td width="5%" align="center"> {{ $count }} </td>
                <td  width="20%"> {{ $alumnodocs->osede }} </td>
                <td  width="10%"> {{ $alumnodocs->osubsede }} </td>
                <td  width="10%"> {{ $alumnodocs->omatricula }} </td>
                <td  width="10%">  {{ $alumnodocs->ofolio }}</td>
                <td  width="25%"> {{ $alumnodocs->name }} </td>
                <td  width="20%"> {{ $alumnodocs->oprograma }} </td>
                <td  width="20%"> {{ $alumnodocs->ogrado }} </td>
                <td  width="20%"> {{ $alumnodocs->ogrupo }} </td>
            </tr>
        
        @endforeach
    </tbody>
    </table>

    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('js')
    <script> console.log('Hi!'); </script>

<script type="module">

$(function () {
    $("#example1").DataTable({
        "select": true,
        "paging": true,
        "lengthMenu": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["copy", "excel", "pdf", "print", "pageLength"],
        lengthMenu: [
                        [25, 50, 100, 150, -1],
                        ['25', '50', '100', '150', 'Ver todos']
                    ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example2").DataTable({
        "select": true,
        "paging": true,
        "lengthChange": false,
        "lengthMenu": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["copy", "excel", "pdf", "print", "pageLength"],
        lengthMenu: [
                        [25, 50, 100, 150, -1],
                        ['25', '50', '100', '150', 'Ver todos']
                    ],
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

 
});

    function submitform()
    {
        document.getElementById('FrmCartel').submit();
    }
</script>




@endsection
