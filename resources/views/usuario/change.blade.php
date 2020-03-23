@extends('layouts.site')
@section('title', 'change')
@section('content')
<nav class="grey">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="{{url()->current()}}" class="breadcrumb">CAMBIO DE CONTRASEÑA</a>
            <a href="#!" class="breadcrumb">Nueva Contraseña</a>
        </div>
    </div>
</nav>
<div class="section container row">
    <form class="col s12" action="update" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="input-field col s12 m6">
                <input placeholder=" " id="password" name="password" type="text" class="validate">
                <label for="password">Contraseña</label>
            </div>
            <div class="input-field col s12">
                <input type="submit" value="Guardar" class="btn-large col s12">
            </div>
        </div>
    </form>
</div>
@endsection
