<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
class SedesController extends Controller
{
    
    public function index(Request $request)
    {
        
     if(!empty($request->session()->get('user'))):   
            $usuario = DB::select('select * from SEDE');
            
            return view('sede/index',['status' => $request->session()->get('status'), 'results' => $usuario]);
        else:
            return redirect('/');
        endif; 
    }

    public function new(Request $request)
    { 
        
        if(!empty($request->session()->get('user'))):        
            return view('sede/new', ['status' => $request->session()->get('status')]);
        else:
            return redirect('/');
        endif;
    }

    public function save(Request $request)
    {


        if(!empty($request->session()->get('user'))):      
            $current_date = date('Y-m-d H:i:s');  
            DB::insert('INSERT INTO sede (SEDE_C_DESCRIPCION, SEDE_C_DIRECCION, SEDE_C_ABREVIATURA, SEDE_C_ESTADO, SEDE_C_USUARIO_REG , SEDE_D_FECHA_REG) 
            VALUES (?, ?,?,?,?,?)', [
                $request->input('descripcion'),
                $request->input('direccion'),
                $request->input('abreviatura'),
                '0',
                session('user')->USUARI_N_ID,
                $current_date
                                        ]);
            return redirect('/sedes');
        else:
            return redirect('/sedes');
        endif;
    }
   
}


