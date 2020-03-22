<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
class MenuController extends Controller
{
    public function index(Request $request)
    {
        if(!empty($request->session()->get('user'))):   
            $usuario = DB::select('select * from menu');
            
            return view('menu/index',['status' => $request->session()->get('status'), 'results' => $usuario]);
        else:
            return redirect('/');
        endif;
    }

    public function new(Request $request)
    {
        if(!empty($request->session()->get('user'))):        
            return view('menu/new', ['status' => $request->session()->get('status')]);
        else:
            return redirect('/');
        endif;
    }

    public function save(Request $request)
    {
        if(!empty($request->session()->get('user'))):        
            DB::insert('INSERT INTO menu (	MENU_C_DESCRIPCION,MENU_C_LINK,USUARI_N_ID)  VALUES (?, ?,?)', [$request->input('descripcion'),
                                                                                                                $request->input('link'), 
                                                                                                                session('user')->USUARI_N_ID
                                                                                                     ]);
            return redirect('/menus');
        else:
            return redirect('/menus');
        endif;
    }
   
}


