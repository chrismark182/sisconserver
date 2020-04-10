@extends('layouts.site')
@section('title', 'Sedes')
@section('content')
<nav class="grey">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="#!" style="padding:10px" class="breadcrumb">Sedes</a>
        </div>
    </div>
</nav>
<section class="section container row">
    <table class="striped">
        <thead>
            <tr>
                <th style="text-align:center">ID</th>
                <th>DESCRIPCION</th>
                <th>DIRECCION</th>
                <th>ABREVIATURA</th>
                

            </tr>
        </thead>

        <tbody>
            @foreach($results as $row)
            <tr>
                <td style="text-align:center">{{$row->SEDE_N_ID}}</td>
                <td >{{$row->SEDE_C_DESCRIPCION}}</td>
                <td>{{$row->SEDE_C_DIRECCION}}</td>
                <td>{{$row->SEDE_C_ABREVIATURA}}</td>
                

            </tr>
            @endforeach
        </tbody>
    </table>
</section>

<div class="fixed-action-btn">
    <a href="{{url()->current()}}/nuevo" class="btn-floating btn-large red">
        <i class="large material-icons">add</i>
    </a>
</div>  
@endsection