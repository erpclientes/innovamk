<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Carbon\Carbon;
use Validator;
use Auth;
use DB;
use App\User;
use App\Http\Controllers\Auth\Routeros_api;

class RegistroController extends Controller
{
    public function index()
    {
    	return view('hotspot.registro');
    }

    public function addRegistro(Request $request)
    {
    	//dd($request);
        $rules = array(      
            'nombre'        => 'required|string|max:255',
            'apellidos'     => 'required|string|max:255',
            'email'         => 'required|string|email|max:255',
            'celular'       => 'required',
            'password'      => 'required|string|min:6|confirmed'
        );

        $validator = Validator::make ( $request->all(), $rules);

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          

        if (!$user = DB::table('usuarios_hotspot')->where('email', $request->email)->first()) { 

        	$key = ''; 
	        $cont = 0;
	        $total = 0;
	        $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
	        $length = 10;
	        $max = strlen($caracteres) - 1;

	        for ($i=0;$i<$length;$i++) {
	            $key .= substr($caracteres, rand(0, $max), 1);
	        }
              
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = DB::table('usuarios_hotspot')
                ->insert([
                    'idempresa'         => '001',
                    'codigo'            => $key,
                    'ip'                => $_SERVER["REMOTE_ADDR"],
                    'nombre'            => $request->nombre,
                    'apellidos'         => $request->apellidos,
                    'email'             => $request->email,
                    'celular'           => $request->celular,
                    'contrasena'		=> $request->password,

                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'estado'            => 1
                ]);
        }else{
        	$var = $validator->getMessageBag()->toarray();
            array_push($var, 'BAD_CONTRA');
            return response()->json($var);
        }

        $user = DB::table('usuarios_hotspot')->where('email',$request->email)->get();

        $router = DB::table('router')->where('idrouter','RO2')->get();
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;
            //$ARRAY = $API->comm("/ppp/profile/print");
            //dd($ARRAY);
            //dd($router);
            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $perfil = DB::table('perfiles')->where('idrouter',$rou->idrouter)->get();
                    
                    foreach ($perfil as $val) {    

                    	foreach ($user as $key => $datos) {
                    	 	$ARRAY = $API->comm("/ip/hotspot/user/add", array(
	                            //"name"      => $datos->email,
                                "name"      => $datos->nombre,
	                            "password"  => $datos->contrasena,  
	                            "profile"   => $val->hotspot_perfil,  
	                            "server"    => 'hotspot1',
                                "email"     => $datos->email,
                                "comment"   => $datos->nombre.' '.$datos->apellidos
							));  
                    	}                        
                    }
                
                }       
            }

 		return response()->json($user->toJson());   
    }
}
