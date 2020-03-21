<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SignupController extends Controller
{
    public function index(Request $request)
    {
        return view('signup',['status' => $request->session()->get('status')]);
    }
    public function signup(Request $request)
    {
        $users = DB::select('SELECT * FROM usuario where USUARI_C_EMAIL = :email', ['email' => $request->input('email')]);
        if(count($users) == 0)
        {
            DB::insert('INSERT INTO usuario (USUARI_C_EMAIL, USUARI_C_PASSWORD, USUARI_N_CATEGORIA)  VALUES (?,?,?)', [$request->input('email'), $request->input('password'),'1' ]);
            return redirect('/')->with('status', 'Usuario creado correctamente!');
        }else{
            return redirect('/')->with('status', 'Email ya existe!');
        }
        
    }
}
