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
   
}


