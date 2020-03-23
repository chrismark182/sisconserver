
@extends('layouts.site')
@section('content')
<nav class="grey">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="{{ url('usuarios') }}" class="breadcrumb">Usuarios</a>
            <a href="#!" class="breadcrumb">Nuevo</a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="section row">
        <form action="signup" method="post">
            @csrf
            <div class="input-field col s12 m6">
                <input id="email" name="email" type="text" class="validate">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="password" name="password" type="password" class="validate">
                <label for="password">Password</label>
            </div>
            <div class="input-field col s12">
                <input type="submit" class="col btn" value="Guardar">
            </div>
        </form>
        <div class="divider"></div>
    </div>
</div>
@endsection


