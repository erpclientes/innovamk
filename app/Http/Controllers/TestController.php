<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    public function index()
    {
    	$test = DB::table('test')->where('estado',1)->get();

    	//dd($test);

    	return view('forms.pruebas.test',[
    		'test'		=> $test
    	]);
    }

    public function create()
    {
    	return view('forms.pruebas.addTest');
    }

    public function store(Request $request)
    {
    	//dd($request);
        
        DB::table('test')
            ->insert([
            	'idempresa'		 => '001', 
                'descripcion'    => $request->descripcion,
                'glosa'     	 => $request->glosa,
                'fecha_creacion' => date('Y-m-d H:m:s'),
                'estado'         => '1',
            ]);
        return;
    }
}
