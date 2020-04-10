
@extends('layouts.site')
@section('content')
<nav class="grey">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="{{ url('sedes') }}" class="breadcrumb">Sedes</a>
            <a href="#!" class="breadcrumb">Nuevo</a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="section row">
        <form action="save" method="post">
            @csrf
            <div class="input-field col s12 m6">
                <input id="descripcion" name="descripcion" type="text" class="validate">
                <label for="descripcion">Descripcion</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="direccion" name="direccion" type="text" class="validate">
                <label for="direccion">Direccion</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="abreviatura" name="abreviatura" type="text" class="validate">
                <label for="abreviatura">Abreviatura</label>
            </div>
            <div class="input-field col s12">
                <input type="submit" class="col btn" value="Guardar">
            </div>
        </form>
        <div class="divider"></div>
    </div>
</div>
@endsection


