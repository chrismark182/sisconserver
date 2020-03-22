@extends('layouts.site')
@section('title', 'Usuarios')
@section('content')
<nav class="grey">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="#!" class="breadcrumb">Categoria</a>
        </div>
    </div>
</nav>
<section class="section container row">
    <table class="striped">
        <thead>
            <tr>
                <th class="right-align">ID</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            @foreach($results as $row)
            <tr>
                <td class="right-align">{{$row->USUARI_N_ID}}</td>
                <td>{{$row->USUARI_C_EMAIL}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
        

<div class="fixed-action-btn">
    <a href="insumo/nuevo" class="btn-floating btn-large red">
        <i class="large material-icons">add</i>
    </a>
</div>      

@endsection
    