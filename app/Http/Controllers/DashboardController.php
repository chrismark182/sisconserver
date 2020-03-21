<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('user')->USUARI_N_CATEGORIA == 1):
            return view('dashboard', ['status' => $request->session()->get('status')]);
        else: 
            return redirect('pedidos');
        endif;
    }
}
