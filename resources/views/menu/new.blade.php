@extends('layouts.site')
@section('title', 'Nuevo insumo')
@section('content')
<nav class="grey">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="{{url()->current()}}" class="breadcrumb">Nueva Menu</a>
            <a href="#!" class="breadcrumb">Nuevo</a>
        </div>
    </div>
</nav>
<div class="section container row">
    <form class="col s12" action="save" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="input-field col s12 m6">
                <input placeholder=" " id="descripcion" name="descripcion" type="text" class="validate">
                <label for="descripcion">Descripción</label>
            </div>
            <div class="input-field col s12 m6">
                <input placeholder=" " id="link" name="link" type="text" class="validate">
                <label for="link">LINK</label>
            </div>
            <div class="input-field col s12">
                <input type="submit" value="Guardar" class="btn-large col s12">
            </div>
        </div>
    </form>
</div>
@endsection
