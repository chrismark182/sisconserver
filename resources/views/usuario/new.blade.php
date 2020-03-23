
@extends('layouts.site')
@section('content')
<div class="container">
    <div class="section row">
        <form action="signup" method="post">
            @csrf
            <div class="input-field col s12">
                <input id="email" name="email" type="text" class="validate">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate">
                <label for="password">Password</label>
            </div>
            <div class="input-field col s12">
                <input type="submit" class="col s12 btn-large" value="Registrar">
            </div>
        </form>
        <div class="divider"></div>
    </div>
</div>
@endsection


