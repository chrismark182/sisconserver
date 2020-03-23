@extends('layouts.site')
@section('content')
    <div class="container">
        <div class="section row">
            <form action="login" method="post">
                @csrf
                <div class="input-field col s12">
                    <input id="email" name="email" type="text" class="validate" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12">
                    <input id="password" name="password" type="password" class="validate" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-field col s12">
                    <input type="submit" class="col s12 btn-large" value="Iniciar Sesión">
                </div>
            </form>
            <div class="divider"></div>
            
            <a href="signup" class="col" >Crear cuenta</a>
        </div>
    </div>
@endsection