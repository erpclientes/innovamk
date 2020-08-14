<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class Clientes2Controller extends Controller
{
    public function index()
    {
    	$router = DB::table('router')->where('principal',1)->get();
     
        $usuarios = DB::table('usuarios_hotspot')
        ->where([
        	'idempresa'		=> '001',
        	'estado'		=> 1
        ])->get();

        return view('forms.clientes2.lstClientes',[
        	'router'		=> $router,
        	'usuarios'		=> $usuarios
        ]);
    }

    public function show($id)
    {
        $descarga = 0;
        $subida = 0;
        $tdescarga = 0;
        $tsubida = 0;
        $idusuario = null;
        $email = null;
        $concurrencia = 0;
        $usuario = DB::table('usuarios_hotspot')
                    ->where(['codigo' => $id, 'estado' => 1])->get();

        foreach ($usuario as $value) {
            $email = $value->email;
            $idusuario = $value->codigo;

            if (!is_null($value->descarga)) {
                $descarga = $value->tdescarga;
            }
            if (!is_null($value->subida)) {
                $subida = $value->tsubida;
            }
            if (!is_null($value->concurrencia)) {
                $concurrencia = $value->concurrencia;
            }
        }

        $user = DB::table('trafico_usuario_hotspot')->where('idcliente', $idusuario)->get();

        if (count($user) == 0){ 
            DB::table('trafico_usuario_hotspot')
            ->insert([
                'idcliente'  => $idusuario
            ]);
        }

        $tusuario = DB::table('trafico_usuario_hotspot')
                    ->where('idcliente', $id)->get();

        foreach ($tusuario as $value) {
            if (!is_null($value->tdescarga)) {
                $tdescarga = $value->tdescarga;
            }
            if (!is_null($value->tsubida)) {
                $tsubida = $value->tsubida;
            }
        }

        $router = DB::table('router')->where('idrouter','RO2')->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
        $collection = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/ip/hotspot/user/print");
                //$ARRAY = $API->comm("/ip/hotspot/active/print");
                $collection = Collection::make($ARRAY);            
            }       
        }
        //dd($collection);

        foreach ($collection as $value) {
            if (isset($value['email'])) {
                if ($value['email'] == $email) {
                    if ($value['bytes-out'] >= $descarga) {
                        $descarga = $value['bytes-out'];                        
                    }else{
                        if ($value['bytes-out'] >= $tdescarga) {
                            $tdescarga = $value['bytes-out'] - $tdescarga;                            
                        }else{
                            $tdescarga = $value['bytes-out'];
                        }

                        
                        
                        $descarga = $descarga + $tdescarga;
                    }


                    if ($value['bytes-in'] >= $subida) {
                        $subida = $value['bytes-in'];                        
                    }else{
                        if ($value['bytes-in'] >= $tsubida) {
                            $tsubida = $value['bytes-in'] - $tsubida;                            
                        }else{
                            $tsubida = $value['bytes-in'];
                        }
                        $subida = $subida + $tsubida;    
                    }

                    DB::table('usuarios_hotspot')
                    ->where('email',$email)
                    ->update([
                        'tdescarga'  => $descarga,
                        'tsubida'    => $subida       
                    ]);

                    DB::table('trafico_usuario_hotspot')
                    ->where('idcliente',$idusuario)
                    ->update([
                        'tdescarga'  => $tdescarga,
                        'tsubida'    => $tsubida       
                    ]);

                    $descarga = number_format((($descarga)/1024)/1024,0);
                    $subida = number_format((($subida)/1024)/1024,0);
                }
                
            }
        }
       
        return view('forms.clientes2.perfilCliente',[
            'usuario'       => $usuario,
            'descarga'      => $descarga,
            'subida'        => $subida,
            'concurrencia'  => $concurrencia
        ]);
    }
    
}
