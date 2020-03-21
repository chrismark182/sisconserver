<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        echo 'Hola test';
        $users = DB::select('select * from usuario');
        var_dump($users);
    }
}
