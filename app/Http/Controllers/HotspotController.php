<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;
use Carbon\Carbon;

class HotspotController extends Controller
{
    public function conexiones()
    {
        $router = DB::table('router')->where('idrouter','RO2')->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
        $collection = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/ip/hotspot/active/print");
                $collection = Collection::make($ARRAY);            
            }       
        }

        //dd($collection);
        $usuarios = DB::table('usuarios_hotspot')
        ->where([
            'idempresa'     => '001',
            'estado'        => 1
        ])->get();

        return view('forms.conexiones.lstConexiones',[
            'collection'    => $collection,
            'usuarios'      => $usuarios
        ]);
    }

    public function desconectar($id){
        $router = DB::table('router')->where('idrouter','R03')->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
        $collection = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $API->comm("/ip/hotspot/active/remove", array(
                                "numbers" => 0,
                ));

                $ARRAY = $API->comm("/ip/hotspot/active/print");
                $collection = Collection::make($ARRAY);   

                $API->disconnect();                
            }       
        }


        return redirect('/conexiones');
    }

    //------------------PAGINA DE BIENVENIDA-----------------------------
    public function bienvenida()
    {
        $bienvenida = DB::table('hotspot_bienvenida')->where('codigo',1)->get();

        return view('hotspot.login2',[
            'bienvenida'    => $bienvenida
        ]);
    }

    public function mntBienvenida()
    {
        $bienvenida = DB::table('hotspot_bienvenida')->get();

        return view('forms.hotspot.mntBienvenida',[
            'bienvenida'    => $bienvenida
        ]);
    }

    public function addBienvenida(Request $request)
    { 
        //dd($request);
        if (!$user = DB::table('hotspot_bienvenida')->where('codigo', 1)->first()) { 
            DB::table('hotspot_bienvenida')
             ->insert([
                'idempresa'             => '001',
                'codigo'                => 1,
                'color_fondo'           => $request->color_fondo,
                'color_btn_navegar'     => $request->color_btn_navegar,
                'color_btn_cerrar'      => $request->color_btn_cerrar,
                'link'                  => $request->link                
             ]);
        }else{
            DB::table('hotspot_bienvenida')
             ->where('codigo',1)
             ->update([
                'color_fondo'           => $request->color_fondo,
                'color_btn_navegar'     => $request->color_btn_navegar,
                'color_btn_cerrar'      => $request->color_btn_cerrar,
                'link'                  => $request->link
             ]);
        }

              
            
        $datos = DB::table('hotspot_bienvenida')->where('codigo',1)->get();
        $collection = Collection::make($datos);
                
        return response()->json($collection->toJson());   
    }

    public function addParametrosBienvenida(Request $request)
    { 
        //dd($request);
        $mostrar_ip = 0;
        $mostrar_mac = 0;
        $mostrar_up_down = 0;
        $mostrar_tiempo_con = 0;
        $mostrar_status = 0;

        if(!empty($request->mostrar_ip)){
            $mostrar_ip = 1;
        }
        if(!empty($request->mostrar_mac)){
            $mostrar_mac = 1;
        }
        if(!empty($request->mostrar_up_down)){
            $mostrar_up_down = 1;
        }
        if(!empty($request->mostrar_tiempo_con)){
            $mostrar_tiempo_con = 1;
        }
        if(!empty($request->mostrar_status)){
            $mostrar_status = 1;
        }

        if (!$user = DB::table('hotspot_bienvenida')->where('codigo', 1)->first()) { 
            DB::table('hotspot_bienvenida')
             ->insert([
                'idempresa'             => '001',
                'codigo'                => 1,
                'mostrar_ip'            => $mostrar_ip,
                'mostrar_mac'           => $mostrar_mac,
                'mostrar_up_down'       => $mostrar_up_down,
                'mostrar_tiempo_con'    => $mostrar_tiempo_con,
                'mostrar_status'        => $mostrar_status
             ]);
        }else{
            DB::table('hotspot_bienvenida')
             ->where('codigo',1)
             ->update([
                'mostrar_ip'            => $mostrar_ip,
                'mostrar_mac'           => $mostrar_mac,
                'mostrar_up_down'       => $mostrar_up_down,
                'mostrar_tiempo_con'    => $mostrar_tiempo_con,
                'mostrar_status'        => $mostrar_status
             ]);
        }

              
            
        $datos = DB::table('hotspot_bienvenida')->where('codigo',1)->get();
        $collection = Collection::make($datos);
                
        return response()->json($collection->toJson());   
    }

    //-----------PAGINA DE CIERRE DE SESIÓM----------------
    public function logout()
    {
        $logout = DB::table('hotspot_logout')->where('codigo',1)->get();

        return view('hotspot.logout2',[
            'logout'    => $logout
        ]);
    }

    public function mntLogout()
    {
        $logout = DB::table('hotspot_logout')->get();

        return view('forms.hotspot.mntLogout',[
            'logout'    => $logout
        ]);
    }

    public function addLogout(Request $request)
    { 
        //dd($request);
        if (!$user = DB::table('hotspot_logout')->where('codigo', 1)->first()) { 
            DB::table('hotspot_logout')
             ->insert([
                'idempresa'             => '001',
                'codigo'                => 1,
                'color_fondo'           => $request->color_fondo,
                'color_btn_iniciar'     => $request->color_btn_iniciar
             ]);
        }else{
            DB::table('hotspot_logout')
             ->where('codigo',1)
             ->update([
                'color_fondo'           => $request->color_fondo,
                'color_btn_iniciar'     => $request->color_btn_iniciar
             ]);
        }

              
            
        $datos = DB::table('hotspot_logout')->where('codigo',1)->get();
        $collection = Collection::make($datos);
                
        return response()->json($collection->toJson());   
    }

    public function addParametrosLogout(Request $request)
    { 
        //dd($request);
        $mostrar_ip = 0;
        $mostrar_mac = 0;
        $mostrar_up_down = 0;
        $mostrar_tiempo_con = 0;

        if(!empty($request->mostrar_ip)){
            $mostrar_ip = 1;
        }
        if(!empty($request->mostrar_mac)){
            $mostrar_mac = 1;
        }
        if(!empty($request->mostrar_up_down)){
            $mostrar_up_down = 1;
        }
        if(!empty($request->mostrar_tiempo_con)){
            $mostrar_tiempo_con = 1;
        }

        if (!$user = DB::table('hotspot_logout')->where('codigo', 1)->first()) { 
            DB::table('hotspot_logout')
             ->insert([
                'idempresa'             => '001',
                'codigo'                => 1,
                'mostrar_ip'            => $mostrar_ip,
                'mostrar_mac'           => $mostrar_mac,
                'mostrar_up_down'       => $mostrar_up_down,
                'mostrar_tiempo_con'    => $mostrar_tiempo_con
             ]);
        }else{
            DB::table('hotspot_logout')
             ->where('codigo',1)
             ->update([
                'mostrar_ip'            => $mostrar_ip,
                'mostrar_mac'           => $mostrar_mac,
                'mostrar_up_down'       => $mostrar_up_down,
                'mostrar_tiempo_con'    => $mostrar_tiempo_con
             ]);
        }

              
            
        $datos = DB::table('hotspot_logout')->where('codigo',1)->get();
        $collection = Collection::make($datos);
                
        return response()->json($collection->toJson());   
    }

    //-----------PAGINA DE LA PUBLICIDAD----------------
    public function publicidad()
    {
        return view('hotspot.publicidad2');
    }

    public function lstPublicidad()
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

        $publicidad = DB::table('hotspot_publicidad')->get();

        return view('forms.hotspot.lstPublicidad',[
            'publicidad'    => $publicidad,
            'valida'        => $valida
        ]);
    }

    public function create()
    {
        return view('forms.hotspot.mntPublicidad',[
            
        ]);
    }

    public function mntPublicidad()
    {
        $publicidad = DB::table('hotspot_publicidad')->get();

        return view('forms.hotspot.mntPublicidad',[
            'publicidad'    => $publicidad
        ]);
    }

    //-----------PAGINA DE INICIO----------------
    public function inicio()
    {
        $carrusel = DB::table('carrusel')->where([
            'estado'        => 1,
            'app'           => 'INNOVAWIFI'
        ])->get();

        $parametros = DB::table('parametros')
            ->where([
                'idempresa'         => '001',
                'tipo_parametro'    => 'HOTSPOT',
                'estado'            => 1
            ])->get();

        return view('hotspot.index2',[
            'carrusel'      => $carrusel,
            'parametros'    => $parametros
        ]);
    }


    public function usuarios()
    {
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

        dd($collection);
       
    }

    public function addUsuario()
    {
        $router = DB::table('router')->where('idrouter','RO2')->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
        $collection = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                "email"      => 'leo.pasho@gmail.com',
                                "name"      => 'prueba',
                                "password"  => '123456',  
                                "profile"   => 'PRUEBA 2M',  
                                "server"    => 'hotspot1',
                                "comment"      => 'leo.pasho@gmail.com',
                            ));            
            }       
        }

        dd($collection);
       
    }

}
