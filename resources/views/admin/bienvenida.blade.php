
@extends('template.master')

@section('title')
Panel Administrativo |
@endsection


@section('menu')

<li class="nav-item">
    <a  href="{{ route('admin.index') }}"
        class="activep nav-link"
        style="color:white;">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p><b>AVANCES Y REPORTES</b></p>
    </a>
</li>


<li class="nav-item">
    <a  href="{{ route('admin.edit', 0) }}"
        class="nav-link bordep"
        style="color:#B43A8F;">
    <i class="nav-icon fas fa-users-cog"></i>
    <p> <b> ALUMNOS </b></p>
    </a>
</li>
@endsection


@section('content')
<div class="col-12 card card-fuchsia card-outline shadow"  >




</div>



@endsection

