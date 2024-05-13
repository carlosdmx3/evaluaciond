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

        <p>
            <a  class="btn btn-success btn-sm" 
                href="{{ route('file-export') }}">
                Exportar estos registros 
                &nbsp;<i class="far fa-file-excel" style="font-size: 18px;"></i>&nbsp;
            </a>

            <a  class="btn btn-success btn-sm" 
                href="{{ route('file-export-result') }}">
                Exportar estos resultados en excel 
                &nbsp;<i class="far fa-file-excel" style="font-size: 18px;"></i>&nbsp;
            </a>

        </p>

        <br>
        <br>

        <table  id="example1" 
                class="table table-sm table-striped table-bordered table-hover " style="font-size:12px;" >
            <thead class="colorBG " >
                <tr style="text-align: center;" >
                    <th colspan="2">INSTITUCIÓN - SEDE</th>
                    <th>TOTAL</th>
                    <th>CONCLUYERON</th>
                    <th>SIN CONCLUIR</th>
                </tr>
            </thead>
            @foreach($registros as $registro)
                <tr valign="middle">
                    <td  width="30%" align="right"> {{ $registro->osede }} </td>
                    <td  width="20%"> {{ $registro->osubsede }} </td>
                    <td  width="10%" align="center"> 
                        {{ $registro->total_alumnos }} 
                    </td>
                    
                    <td  width="10%"  align="center"  style="color:green;">
                        {{ $registro->si_terminaron }}
                    </td>

                    <td  width="10%"  align="center"  style="color:red;"> 
                        {{ $registro->no_terminaron }}
                    </td>
            </tr>
            @endforeach
            <tfoot>
                <tr valign="middle">
                    <td colspan="2" align="right">  
                        <b>TOTALES</b>
                    </td>

                    <td width="10%" align="center"> 
                        <b>{{ $totales->total }}</b> 
                    </td>

                    <td width="10%" align="center" style="color:green;">
                        <b>{{ $totales->totalsi }}</b> 
                    </td>

                    <td width="10%" align="center" style="color:red;"> 
                        <b>{{ $totales->totalno }}</b> 
                    </td>
                </tr>
            </tfoot>
        </table>
        <br>
        <x-adminlte-callout theme="info" title="Gráfica de avance">
        


            <button class="btn btn-outline-secondary btn-sm" 
                    onclick="imprim1(piechart_3d)">
                <b>Imprimir gráfica <i class="fa fa-print"  ></i></b>
            </button> 
            <br>
            <br>
            <div id="piechart_3d" style="width:800px; height:400px;" ></div>
        </x-adminlte-callout>


    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('js')
    <script> console.log('Hi!'); </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load( {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours Day', ],
                        ['Terminaron:   {{ $totales->totalsi }}', {{ $totales->totalsi }}, ],
                        ['Sin terminar: {{ $totales->totalno }}', {{ $totales->totalno }}, ],
                    ]);

                    var options = {
                                    title: '% de alumnos ',
                                    is3D: true,
                                    colors:['gray','red']
                                };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }
            </script>
@endsection
