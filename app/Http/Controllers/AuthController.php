<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $users = DB::select('select * from USUARIO where USUARI_C_EMAIL = :email and USUARI_C_PASSWORD = :password', ['email' => $request->input('email'), 'password' => $request->input('password')]);
        
        if(count($users) > 0){
            var_dump($users);
            session(['user' => $users[0]]);
            return redirect('dashboard');
        }else{
            return redirect('/')->with('status', 'Usuario o contraseña erróneos!');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
