@extends('layouts.site')
@section('title', 'Categorias')
@section('content')
<nav class="grey">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="#!" style="padding:10px" class="breadcrumb">Menu</a>
        </div>
    </div>
</nav>
<section class="section container row">
    <table class="striped">
        <thead>
            <tr>
                <th style="text-align:center">ID</th>
                <th>DESCRIPCION</th>
                <th>LINKS</th>
            </tr>
        </thead>

        <tbody>
            @foreach($results as $row)
            <tr>
                <td style="text-align:center">{{$row->MENU_N_ID}}</td>
                <td>{{$row->MENU_C_DESCRIPCION}}</td>
                <td ><a href="{{$row->MENU_C_LINK}}">link</a></td>
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
    