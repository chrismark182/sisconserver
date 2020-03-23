@extends('layouts.site')
@section('title', 'change')
@section('content')
<nav class="grey">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="{{ url('usuarios') }}" class="breadcrumb">Usuario</a>

            <a href="#!" class="breadcrumb">Nueva Contraseña</a>
        </div>
    </div>
</nav>
<div class="section container row">
    <div class="card">
        <div class="card-content">
          <span class="card-title">Datos del usuarios</span>
          <p>Email: {{$user->USUARI_C_EMAIL}}</p>
        </div>
    </div>
    <form class="col s12" action="{{ url('usuarios/update') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$user->USUARI_N_ID}}">
        <div class="row">
            <div class="input-field col s12">
                <input placeholder=" " id="password" name="password" type="password" class="validate">
                <label for="password">Contraseña</label>
            </div>
            <div class="input-field col s12">
                <input type="submit" value="Guardar" class="btn-large col s12">
            </div>
        </div>
    </form>
</div>
@endsection
