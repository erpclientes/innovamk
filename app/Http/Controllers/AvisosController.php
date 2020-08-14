<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use Illuminate\Support\Collection as Collection;

class AvisosController extends Controller
{
	//---------------------------Logica para los Avisos en Pantalla------------------------
    public function index()
    {    

       // dd(Auth::user()->idempresa);
    	$valida = 0;

       
        //-- Validación para mostrar mensajes al realizar un CRUD
        $validacion = DB::table('validacion')
                        ->select('valor')
                        ->where('idusuario',Auth::user()->id)->get();

        foreach ($validacion as $val) {
            $valida = $val->valor;
        }
        if ($valida > 0) {
            DB::table('validacion')
            ->where('idusuario',strval(Auth::user()->id))
            ->update(['valor' => 0]);
        }

        $aviso = DB::table('aviso')->get();

        if (count($aviso) == 0) {
        	DB::table('aviso')   
            ->insert([      
                'idempresa'     	=> '001',
                'codigo'            => 'AVI',
                'estado'			=> 1,
                'fecha_creacion'    => date('Y-m-d H:m:s')
            ]);

            $aviso = DB::table('aviso')->get();
        }
        //dd($carrusel);
        
        return view('forms.avisos.aviso', [
            'aviso' 	=> $aviso,
            'valida'	=> $valida

		]);
    }

    public function aviso()
    {   
    	
        $aviso = DB::table('aviso')->get();

        $empresa = DB::table('empresa')
        ->where('idempresa',strval(Auth::user()->idempresa))
        ->get();
       // dd($empresa);


        if (count($aviso) == 0) {
        	DB::table('aviso')   
            ->insert([      
                'idempresa'     	=> '001',
                'codigo'            => 'AVI',
                'estado'			=> 1,
                'fecha_creacion'    => date('Y-m-d H:m:s')
            ]);

            $aviso = DB::table('aviso')->get();
        }
        //dd($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]);

        return view('forms.avisos.vwAviso', [
            'aviso' 	=> $aviso,
            'empresa'	=> $empresa
		]);
    }

    public function update(Request $request)
    {
    	//dd($request);
        $rules = array(      
            'titulo'        => 'required',
            'descripcion'   => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('aviso')
            ->where('codigo',$request->id)
            ->update([
                'titulo'        	=> $request->titulo,
                'descripcion'		=> $request->descripcion
            ]);

            $aviso = DB::table('aviso')->where('codigo',$request->id)->get();
            $collection = Collection::make($aviso);
                
            return response()->json($collection->toJson());   
        }
    }

    //---------------------------Logica para los Cortes en Pantalla------------------------
    public function index2()
    {    
    	$valida = 0;

        //-- Validación para mostrar mensajes al realizar un CRUD
        $validacion = DB::table('validacion')
                        ->select('valor')
                        ->where('idusuario',Auth::user()->id)->get();

        foreach ($validacion as $val) {
            $valida = $val->valor;
        }
        if ($valida > 0) {
            DB::table('validacion')
            ->where('idusuario',strval(Auth::user()->id))
            ->update(['valor' => 0]);
        }

        $corte = DB::table('corte')->get();

        if (count($corte) == 0) {
        	DB::table('corte')   
            ->insert([      
                'idempresa'     	=> '001',
                'codigo'            => 'CRT',
                'estado'			=> 1,
                'fecha_creacion'    => date('Y-m-d H:m:s')
            ]);

            $corte = DB::table('corte')->get();
        }
        //dd($carrusel);

        return view('forms.avisos.corte', [
            'corte' 	=> $corte,
            'valida'	=> $valida
		]);
    }

    public function corte()
    {   
    	
        $corte = DB::table('corte')->get();
        $empresa = DB::table('empresa')
        ->where('idempresa',strval(Auth::user()->idempresa))
        ->get();
       // dd($empresa);

        if (count($corte) == 0) {
        	DB::table('corte')   
            ->insert([      
                'idempresa'     	=> '001',
                'codigo'            => 'AVI',
                'estado'			=> 1,
                'fecha_creacion'    => date('Y-m-d H:m:s')
            ]);

            $corte = DB::table('corte')->get();
        }
        //dd($carrusel);

        return view('forms.avisos.vwCorte', [
            'corte' 	=> $corte,
            'empresa'	=> $empresa
		]);
    }

    public function updCorte(Request $request)
    {
    	//dd($request);
        $rules = array(      
            'titulo'        => 'required',
            'descripcion'   => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('corte')
            ->where('codigo',$request->id)
            ->update([
                'titulo'        	=> $request->titulo,
                'descripcion'		=> $request->descripcion
            ]);

            $corte = DB::table('corte')->where('codigo',$request->id)->get();
            $collection = Collection::make($corte);
                
            return response()->json($collection->toJson());   
        }
    }
}
