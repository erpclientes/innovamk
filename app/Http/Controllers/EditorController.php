<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Collection as Collection;
use Validator;

class EditorController extends Controller
{
	public function index()
	{
		$plantilla = DB::table('plantillas')->where('idplantilla','COMPROBANTE_CLIENTE')->get();

    	if (count($plantilla) == 0) {
    		DB::table('plantillas')
    		->insert([
    			'idplantilla'		=> 'COMPROBANTE_CLIENTE',
    			'estado'			=> 1,
    			'fecha_creacion'    => date('Y-m-d h:m:s')
    		]);

    		$plantilla = DB::table('plantillas')->where('idplantilla','COMPROBANTE_CLIENTE')->get();
    	}

    	return view('forms.pruebas.editor',[
    		'plantilla'		=> $plantilla
    	]);
	}

    public function test(Request $request)
    {
    	DB::table('plantillas')
    	->where('idplantilla',$request->idplantilla)
    	->update([
    		'descripcion'	=> $request->descripcion
    	]);

    	
    	$plantilla = DB::table('plantillas')->where('idplantilla','COMPROBANTE_CLIENTE')->get();
//dd($plantilla);
    	return view('forms.pruebas.editor',[
    		'plantilla'		=> $plantilla
    	]);
    }
}
