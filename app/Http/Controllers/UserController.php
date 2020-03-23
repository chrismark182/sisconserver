<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function index(Request $request)
    {
        if(!empty($request->session()->get('user'))):   
            $usuario = DB::select('select * from usuario');
            
            return view('usuario/index',['status' => $request->session()->get('status'), 'results' => $usuario]);
        else:
            return redirect('/');
        endif;
    }

    

    public function new(Request $request)
    {
        if(!empty($request->session()->get('user'))):        
            return view('usuario/new', ['status' => $request->session()->get('status')]);
        else:
            return redirect('/');
        endif;
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


    public function change(Request $request, $id)
    {
        if(!empty($request->session()->get('user'))):   
            $users = DB::select('SELECT * FROM usuario where USUARI_N_ID = :id', ['id' => $id]);
            return view('usuario/change', ['status' => $request->session()->get('status'), 'user' => $users[0]]);
        else:
            return redirect('/');
        endif;
    }

    
    public function update(Request $request)
    {   
        
        if(!empty($request->session()->get('user'))):       
            DB::table('USUARIO')
            ->where('USUARI_N_ID', $request->input('id'))
            ->update(['USUARI_C_PASSWORD' => $request->input('password') 
            ]);   
            
            return redirect('/usuarios');
        else:
            return redirect('/usuarios');
        endif;
            
    }


    

   
   
   
}


