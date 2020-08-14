<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class MaestroController extends Controller
{
    public function codigo(){
        $key = '';

        $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789\|@#!$%&/()=?¿";
        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
        $length = 10;
        $max = strlen($caracteres) - 1;

        for ($i=0;$i<$length;$i++) {
            $key .= substr($caracteres, rand(0, $max), 1);
        }

        return $key;
    }

    public function codigoN(int $n){
        $key = '';

        $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
        $length = $n;
        $max = strlen($caracteres) - 1;

        for ($i=0;$i<$length;$i++) {
            $key .= ''.substr($caracteres, rand(0, $max), 1);
        }

        return $key;
    }

    public function codigoNletras(int $n){
      $key = '';

      $caracteres = "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz";
      //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
      $length = $n;
      $max = strlen($caracteres) - 1;

      for ($i=0;$i<$length;$i++) {
          $key .= ''.substr($caracteres, rand(0, $max), 1);
      }

      return $key;
  }
    public function codigoNnumeros(int $n){
      $key = '';

      $caracteres = "0123456789012345678901234567890123456789012345678901234567890123456789";
      //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
      $length = $n;
      $max = strlen($caracteres) - 1;

      for ($i=0;$i<$length;$i++) {
          $key .= ''.substr($caracteres, rand(0, $max), 1);
      }

      return $key;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTipoAcceso()
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

        //--

        $tipo = DB::table('tipo_acceso')->get();

        return view('forms.tipoAcceso.tipoAcceso', [
                    'tipo'   => $tipo,
                    'valida'     => $valida
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTipoAcceso(Request $request)
    {        
        $rules = array(            
            'idtipo'        => 'required',
            'descripcion'   => 'required',
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('tipo_acceso')
            ->insert([
                'idempresa'         => '001',
                'estado'            => 1,
                'idtipo'            => $request->idtipo,
                'descripcion'       => $request->descripcion,
                'dsc_corta'         => $request->dsc_corta,
                'glosa'             => $request->glosa,
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            $tipo = DB::table('vw_tipo_acceso')->get();
            $collection = Collection::make($tipo);
            
            return response()->json($collection->toJson());   
        }     
    }

    public function updateTipoAcceso(Request $request)
    {
        $rules = array(      
            'descripcion'   => 'required',
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('tipo_acceso')
            ->where('idtipo',$request->idtipo)
            ->update([
                'descripcion'       => $request->descripcion,
                'dsc_corta'         => $request->dsc_corta,
                'glosa'             => (empty($request->glosa))? null : $request->glosa     
            ]);

            $tipo = DB::table('tipo_acceso')->where('idtipo',$request->idtipo)->get();
            $collection = Collection::make($tipo);
                
            return response()->json($collection->toJson());   
        }
    }

    public function updateEstadoTipoAcceso(Request $request)
    {
        
            DB::table('tipo_acceso')
            ->where('idtipo',$request->idtipo)
            ->update([
                'estado'       => $request->estado
            ]);            
                
            return response()->json(['estado' => 'correcto']);          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function destroyTipoAcceso(Request $request)
    {
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        if (count($validacion) === 0) {
            DB::table('validacion')
            ->insert([
                'idusuario' => $idusu,
                'valor'     => 3
            ]);
        }else{
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 3]);
            
        }

        DB::table('tipo_acceso')
            ->where('idtipo',$request->idtipo)->delete();

        return response()->json();
    }

    public function prueba(){
        $API = new routeros_api();
        $API->debug = false;

        $router = DB::table('router')->where('idrouter','R01')->get();

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                //Recursos del Mikrotik
                $ARRAY = $API->comm("/ip/hotspot/user/profile/add", array(
                                    "name" => 'PRUEBA',
                                //  "session-timeout" => $session,                                    
                                    "idle-timeout" => 'none',
                                    "keepalive-timeout" => '2m',
                                    "status-autorefresh" => '1m',
                                    "shared-users" => '1',
                                    "rate-limit" => '512k/2M',
                                //  "address-list" => $list,
                                    "on-login" => 'prueba'
                                ));   

                 $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                      "name"     => 'otro01',
                                      "password" => '123456',  
                                      "profile"  => 'PRUEBA',  
                                      "server"   => 'hotspot1',
                            ));  

                 $ARRAY = $API->comm("/queue/simple/add", array(
                                      "name"     => 'PROBANDO',
                                      "target" => '192.168.0.51',  
                                      "max-limit"  => '512k/1M',  
                            ));  

                 $ARRAY = $API->comm("/queue/simple/remove", array(
                                      "numbers"     => '7',
                            ));  

                 $ARRAY = $API->comm("/queue/simple/set", array(
                                      "numbers"     => '7',
                                      "name"        => "OTRO02",
                            ));  

                 $ARRAY = $API->comm("/queue/simple/disable", array(
                                      "numbers"     => '7',
                            ));  



                $ARRAY = $API->comm("/queue/simple/print");

                dd($ARRAY);
            
            }
       
        }

        
    }

    public function pppoe(){
       $API = new routeros_api();
        $API->debug = false;

        $router = DB::table('router')->where('idrouter','R01')->get();

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
              
              $ARRAY = $API->comm("/ppp/profile/add", array(
                    "name" => 'prueba',
                    "local-address" => '192.168.0.1',
                    "remote-address" => 'PPPoE_pool',
                    "rate-limit" => '512k/4M',
                  ));   

            }

            dd($ARRAY);
        }

    }

    public function getPoolIp(Request $request)
    {
        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/ip/pool/print");
                $collection = Collection::make($ARRAY);
            
            }       
        }
                
        return response()->json($ARRAY);   
    }

    public function getPerfil(Request $request){

      $tipo = DB::table('perfiles')
            ->where('idtipo',$request->idtipo)->get();

      $collection = Collection::make($tipo);
                
      return response()->json($collection);   
        
    }

    public function getQueues(Request $request){

      $router = DB::table('router')->where('idrouter',$request->idrouter)->get();

      $API = new routeros_api();
      $API->debug = false;
      $ARRAY = null;

      foreach ($router as $rou) {
        if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
          $ARRAY = $API->comm("/queue/simple/print");
        }
      }

      $collection = Collection::make($ARRAY);
      //dd($collection);

      return response()->json($collection);   
        
    }

    public function getTipoAcceso(Request $request){
      //dd($request);
      $tipo = DB::table('tipo_acceso')->where([
          'idrouter'  => $request->idrouter,
          'estado'    => 1
      ])->get();

      return response()->json($tipo);
    }

    public function getMarca(Request $request){
      $marca = DB::table('marca')->where([
          'idgrupo'  => $request->idgrupo,
          'estado'    => 1
      ])->get();

      return response()->json($marca);
    }

    public function getModelo(Request $request){
      $modelo = DB::table('modelo')->where([
          'idmarca'  => $request->idmarca,
          'estado'    => 1
      ])->get();

      return response()->json($modelo);
    }

    //-------------------PRUEBA CON DOMPDF---------------
    public function indexPDF()
    {
        $clientes = DB::table('clientes')->get();

        return view('forms.pruebas.frmPDF', compact('clientes'));
    }

    public function pdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $clientes = DB::table('clientes')->get();

        $pdf = PDF::loadView('forms.pruebas.clientePDF', compact('clientes'));

        return $pdf->download('listado.pdf');
    }

    public function getInterfaces(Request $request)
    {
        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/interface/print");
                $collection = Collection::make($ARRAY);            
            }       
        }
        //dd($ARRAY);
                        
        return response()->json($ARRAY);   
    }

    public function corte()
    { 
      //dd('entro');
        $fecha_actual = new \DateTime();
        $fecha_actual = date_format($fecha_actual,'Y-m-d');
        $fecha_pago = null;
        $fecha_corte = null;
        $tipo_servicio = null;
        $usuario = null;
        $ip = null;
        $nombre = null;
        $idcliente = null;
        $ip_server = null;

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['SISTEMA'])
            ->where('estado',1)->get();

        foreach ($parametros as $val) {
          if($val->parametro == 'ADD_IP_SERVER')
            $ip_server = $val->valor_long;
        }

        $notificaciones = DB::table('notificaciones')->get();
        //$facturas = DB::table('factura')->where('idestado','EM')->get();

        $facturas = DB::table('factura as fac')
        //->select('s.idservicio','s.precio','s.ip','p.name','s.estado','c.razon_social','s.activar_notificacion')
        ->leftjoin('servicio_internet as s','s.idservicio','=','fac.idservicio')
        ->leftjoin('clientes as c','c.idcliente','=','s.idcliente')
        ->leftjoin('perfiles as p','p.idperfil','=','s.perfil_internet')
        //->where('fac.idestado','EM')
        ->where([
          ['s.activar_notificacion','<>',2],
          ['fac.idestado','=','EM'],
          ['c.estado','=',1]
        ])->get();
//dd($facturas);
        foreach ($facturas as $fac) {
          //dd($fac);
          $fecha_corte = $fac->fecha_corte;
          //$servicio = DB::table('servicio_internet')->where(['estado' => 1, 'activar_notificacion' => 0])->get();

          //foreach ($servicio as $val) {
            $fecha_pago = Carbon::now()->addMonth()->day($fac->dia_pago);
            //$fecha_pago = $fecha_pago->format('Y-m-d');
            $tipo_servicio = $fac->tipo_acceso;
            $usuario = $fac->usuario_cliente;
            $ip = $fac->ip;
            $idcliente = $fac->idcliente;            
          //}

          $cliente = DB::table('clientes')->where('idcliente',$idcliente)->get();         

          foreach ($cliente as $clie) {
            $nombre = $clie->nombres.' '.$clie->apaterno.' '.$clie->amaterno;
          }        
            
            $fecha_actual = new \DateTime();
            $fecha_actual->subMonth();
            
            $dia =(int) date_format($fecha_actual,'d');
            $mes = (int) date_format($fecha_actual,'m');
            $year = (int) date_format($fecha_actual,'Y');
                      

            $fecha_validar = new \DateTime($fac->fecha_corte);
            
            $diaN = (int) date_format($fecha_validar,'d');
            $mesN = (int) date_format($fecha_validar,'m');
            $yearN = (int) date_format($fecha_validar,'Y');
            $bandera = false;

            if ($mes == $mesN and $year == $yearN) {
              if ($dia >= $diaN) {
                $bandera = true;
              }
            }else if ($mes > $mesN and $year >= $yearN) {
              if ($dia >= $diaN) {
                $bandera = true;
              }
            }

          if ($bandera) {
            $router = DB::table('router')->where('idrouter',$fac->idrouter)->get();

            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;
            $lista[] = array($ip);

            foreach ($router as $rou) {
              if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                
                if ($tipo_servicio == 'HST') {                  
                  
                  $ARRAY = $API->comm("/ip/hotspot/user/print");

                  foreach ($ARRAY as $value) {   
                    if ($value['name'] == $usuario) {
                      $ARRAY = $API->comm("/ip/hotspot/user/set", array(
                          "profile"   => 'Corte Morosos',  
                          ".id"       => $value['.id']
                      ));                                                 
                    }
                  }                     
                }else if ($tipo_servicio == 'QUE'){

                  $ARRAY = $API->comm("/queue/simple/print");
                  
                  foreach ($ARRAY as $value) {
                    if ($value['name'] == $nombre) {
                      $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                        "list"      => 'Morosos::InnovaTec',  
                        "address"   => $ip,
                        "comment"   => $nombre
                      ));                                                                               
                    }
                  }   

                  $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/vwCorte"
                  ));

                }else if ($tipo_servicio == 'PCQ'){
                  $ARRAY = $API->comm("/ip/firewall/address-list/print");

                  foreach ($ARRAY as $value) {  
                    if ($value['address'] == $ip) {
                      $ARRAY = $API->comm("/ip/firewall/address-list/set", array(
                          "list"   => 'Morosos::InnovaTec',  
                          ".id"       => $value['.id']
                      ));                                            
                    }else{
                      $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Morosos::InnovaTec',
                                "address"   => $ip,
                                "comment"   => $nombre
                      )); 
                    }
                  }  

                  $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/vwCorte"
                  ));      

                }else if ($tipo_servicio == 'PPP'){
                  $ARRAY = $API->comm("/ppp/secret/print");

                  foreach ($ARRAY as $value) {   
                    if ($value['name'] == $usuario) {
                      $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                        "list"      => 'Morosos::InnovaTec',  
                        "address"   => $ip,
                        "comment"   => $nombre
                      ));                                            
                    }
                  }  

                           
                }  

                DB::table('servicio_internet')
                  ->where('idservicio',$fac->idservicio)
                  ->update([
                      'activar_notificacion'    => 2
                ]);                                                  
              }       
            } 

            


          }

          
        }

        //dd($lista);

        return response()->json(array('dato' => 'CONFORME'));

    }

    public function avisos()
    {
        $fecha_actual = new \DateTime();
        $fecha_actual = date_format($fecha_actual,'Y-m-d');
        $fecha_aviso = null;
        $ip = null;
        $nombre = null;
        $idcliente = null;
        $aviso = 0;
        $corte = 0;
        $dia_pago = 0;
        $ip_server = null;

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['SISTEMA'])
            ->where('estado',1)->get();

        foreach ($parametros as $val) {
          if($val->parametro == 'ADD_IP_SERVER')
            $ip_server = $val->valor_long;
        }

        $notificaciones = DB::table('notificaciones')->get();
        $servicio = DB::table('servicio_internet as s')
          //->leftjoin('factura as f','f.idservicio','s.idservicio')
          //->leftjoin('notificaciones as n','n.idservicio','s.idservicio')
          ->where([
            's.estado' => 1, 
            's.activar_notificacion' => 0,
            //'f.idestado' => 'EM',
            //'n.aviso' => 2
          ])
          ->get();
//dd($servicio);
        foreach ($servicio as $serv) {
          foreach ($notificaciones as $not) {
            if ($not->idservicio == $serv->idservicio) {
              $dia_pago = $serv->dia_pago;
              $aviso = $not->aviso;
              $corte = (int) $not->corte;
            }
          }

          //$fecha_aviso = Carbon::now()->day($aviso);
          //$fecha_aviso = $fecha_aviso->format('Y-m-d');
          $ip = $serv->ip;
          $idcliente = $serv->idcliente;

          $fecha_actual = new \DateTime();
          $dia =(int) date_format($fecha_actual,'d');
          $mes = (int) date_format($fecha_actual,'m');
          $year = (int) date_format($fecha_actual,'Y');

          $fecha_aviso = Carbon::now()->day($dia_pago)->subDay($aviso);
          //dd($fecha_validar);
          $diaN = (int) date_format($fecha_aviso,'d');
          $mesN = (int) date_format($fecha_aviso,'m');
          $yearN = (int) date_format($fecha_aviso,'Y');

          $fecha_corte = Carbon::now()->day($dia_pago)->addDay(8);
          //$fecha_corte = Carbon::now()->day($dia_pago)->addDay($corte);
          //$fecha_corte = $fecha_corte->addDay($corte);
          //dd($fecha_validar);
          $diaC = (int) date_format($fecha_corte,'d');
          $mesC = (int) date_format($fecha_corte,'m');
          $yearC = (int) date_format($fecha_corte,'Y');
          $bandera = false;

          if ($mes == $mesN and $mes == $mesC) {
            //dd('entro');
                if ($dia >= $diaN and $dia < $diaC ) {
                    $bandera = true;
                }
          }elseif ($mes > $mesN and $mes == $mesC){
              if ($dia < $diaC ) {
                  $bandera = true;
              }
          }elseif ($mes == $mesN and $mes > $mesC){
              if ($dia >= $diaN ) {
                  $bandera = true;
              }
          }

          //dd($bandera,$fecha_actual,$fecha_aviso,$fecha_corte);
          
          if ($bandera) {
            $idrouter = $serv->idrouter;
            $idperfil = $serv->perfil_internet; 
            $usuario = $serv->usuario_cliente;
            $ip = $serv->ip;

            $router = DB::table('router')->where('idrouter',$idrouter)->get();

            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $cliente = DB::table('clientes')->where(['idcliente' => $serv->idcliente, 'estado' => 1])->get();
                    $nombre = null;

                    foreach ($cliente as $val) {
                        $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
                    }

                    $perfil = DB::table('perfiles')->where('idperfil',$idperfil)->get();

                    foreach ($perfil as $val) {                    

                        if( trim($val->idtipo) == "HST" ){ 
                            //Logica por desarrollar
                                
                        }else if(trim($val->idtipo) == "QUE"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $ip,
                                "comment"   => $nombre
                            ));    

                            $ARRAY = $API->comm("/ip/proxy/access/add", array(
                              "src-address" => $ip,  
                              "action"      => "deny",
                              "redirect-to" => $ip_server."/innovamk/public/aviso"
                            ));   
                        }else if(trim($val->idtipo) == "PCQ"){  
                        //dd('entro');                                                      
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $ip,
                                "comment"   => $nombre
                            )); 

                            $ARRAY = $API->comm("/ip/proxy/access/add", array(
                              "src-address" => $ip,  
                              "action"      => "deny",
                              "redirect-to" => $ip_server."/innovamk/public/aviso"
                            ));                                       
                        }else if(trim($val->idtipo) == "PPP"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $ip,
                                "comment"   => $nombre
                            ));   

                            $ARRAY = $API->comm("/ip/proxy/access/add", array(
                              "src-address" => $ip,  
                              "action"      => "deny",
                              "redirect-to" => $ip_server."/innovamk/public/aviso"
                            ));    
                                                        
                        }

                        DB::table('servicio_internet')
                        ->where('idservicio',$serv->idservicio)
                        ->update([
                            'activar_notificacion'    => 1
                        ]); 
                    }                
                }       
            }

            
          }

        }

    }

    public function datosHost()
    {
      $nombre = gethostname();
      //$ip = gethostbyname();

      global $HTTP_SERVER_VARS;
      if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"] != ""){
      $ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"];
      }else{
      $ip = $HTTP_SERVER_VARS["REMOTE_ADDR"]; }

      
      

      return 'Nombre: '.$nombre.' IP: '.$ip.' otro: '.$_SERVER['SERVER_ADDR'];
    }

    public function deleteUsuariosClientes()
    {
      $email = 'innovamk@innovatec.me';
      $cont = 0;
      
      $usuarios = DB::table('users')->where('email',$email)->get();
      
      DB::table('users')
      ->where('email',$email)
      ->delete();

      DB::table('clientes')
          //->where('idcliente',$datos->idcliente)
          ->update([
            'usu_cpanel'      => 0,
            'usuario_cpanel'  => null,
            'contra_cpanel'   => null
          ]);

      return 'Eliminación de usuarios exitoso';
    }

    public function generarUsuariosClientes()
    {
      $contra = 12345678;
      $email = 'innovamk@innovatec.me';
      $cont = 0;      
      $clientes = DB::table('clientes')->where('usu_cpanel',0)->orWhereNull('usu_cpanel')->get();

      foreach ($clientes as $datos) {            
        $usuario = DB::table('users')->where('usuario',$datos->idcliente)->orWhere('usuario',$datos->correo)->get();

        if (count($usuario) == 0) {
          $cont++;

          DB::table('users')
            ->insert([
                //'id'              => $id,
                'idcliente'         => $datos->idcliente,
                'nombre'            => $datos->nombres,
                'apellidos'         => $datos->apaterno.' '.$datos->amaterno,
                'idtipo'            => 'CLE',
                'estado'            => 1,
                'email'             => $email,
                'password'          => Hash::make($contra),
                'usuario'           => $datos->idcliente,
                'nro_documento'     => $datos->nro_documento,
                'cargo'             => 'CLIENTE',
                'avatar'            => null,
                'telefono'          => $datos->telefono1,
                'glosa'             => $datos->glosa,
                'created_at'        => date('Y-m-d h:m:s')
            ]);

          DB::table('clientes')
          ->where('idcliente',$datos->idcliente)
          ->update([
            'usu_cpanel'      => 1,
            'usuario_cpanel'  => $datos->idcliente,
            'contra_cpanel'   => $contra
          ]);

          echo '('.$cont.') usuario registrado: '.$datos->razon_social.' | usuario: '.$datos->idcliente.' | contraseña: '.$contra.'<br>';
        }
        
      }

      echo '<br>';
      return ':::Se crearon un total de '.$cont.' registros de usuarios para el cPanel de clientes:::';
    }

    public function usuariosCorte()
    {
      //$fecha_actual = date_format($fecha_actual,'Y-m-d');
      $fecha_actual = new \DateTime();
      $dia =(int) date_format($fecha_actual,'d');
      $mes = (int) date_format($fecha_actual,'m');
      $year = (int) date_format($fecha_actual,'Y');
      //$lista[] = array('idservicio','codigo','precio','ip','name','estado','razon_social','fecha_corte');

      $clientes = DB::table('factura as fac')
      ->select('s.idservicio','fac.codigo','s.precio','s.ip','p.name','s.estado','c.razon_social','fac.fecha_corte','s.activar_notificacion')
      ->leftjoin('servicio_internet as s','s.idservicio','=','fac.idservicio')
      ->leftjoin('clientes as c','c.idcliente','=','s.idcliente')
      ->leftjoin('perfiles as p','p.idperfil','=','s.perfil_internet')
      //->where('fac.idestado','EM')
      ->where([
        ['s.activar_notificacion','<>',2],
        ['fac.idestado','=','EM'],
        ['c.estado','<>',2]
      ])
      //->whereDate('fac.fecha_corte', $fecha_actual)
      ->get();

      foreach ($clientes as $val) {

        $fecha_validar = new \DateTime($val->fecha_corte);
        //dd($fecha_validar);
        $diaN = (int) date_format($fecha_validar,'d');
        $mesN = (int) date_format($fecha_validar,'m');
        $yearN = (int) date_format($fecha_validar,'Y');
        $bandera = false;

        if ($mes == $mesN and $year == $yearN) {
          if ($dia >= $diaN) {
            $bandera = true;
          }
        }else if ($mes > $mesN and $year >= $yearN) {
          if ($dia >= $diaN) {
            $bandera = true;
          }
        }

        if ($bandera) {
          $lista[] = array(
            'idservicio'    => $val->idservicio,
            'codigo'        => $val->codigo,
            'precio'        => $val->precio,
            'ip'            => $val->ip,
            'name'          => $val->name,
            'estado'        => $val->estado,
            'razon_social'  => $val->razon_social,
            'fecha_corte'   => $val->fecha_corte
          );
        }
      }

      if (!isset($lista)) {
        $lista[] = null;
      }

     
      //dd($lista);
      return response()->json($lista);
    }

    public function validarComprobante()
    {
      $cont = 0;
      $codigo = null;
      $facturas = DB::table('factura')->where('idestado','EM')->get();
      $clientes = DB::table('clientes')->where('estado',1)->get();


      foreach ($clientes as $datos) {
        foreach ($facturas as $fac) {
          if ($datos->idcliente === $fac->idcliente) {
            $cont++;
            $codigo = $fac->codigo;
          }
        }

        if ($cont == 2) {
          $lista[] = array(''.$datos->idcliente.'' => $cont);
          DB::table('factura')
            ->where('codigo',$codigo)->delete();
          }
        
        $cont = 0;
        $codigo = null;
      }

      dd($lista);    
    }

    public function eliminarComprobantesDuplicados()
    {
      $cont = 0;
      $codigo = null;
      $facturas = DB::table('factura')->whereIn('idestado',['EM','PA'])->get();
      $clientes = DB::table('clientes')->where('estado',1)->get();

dd($facturas);
      foreach ($clientes as $datos) {
        foreach ($facturas as $fac) {
          if ($datos->idcliente === $fac->idcliente) {
            $cont++;

            if ($fac->idestado == 'EM') {
              $codigo = $fac->codigo;  
            }            
          }
        }

        if ($cont == 2) {
          $lista[] = array(''.$datos->idcliente.'' => $cont);
          DB::table('factura')
            ->where('codigo',$codigo)->delete();
          }
        
        $cont = 0;
        $codigo = null;
      }

      dd($lista);    
    }

    public function eliminarComprobantesPagadosDuplicados()
    {
      $cont = 0;
      $count = 0;
      $codigo = null;
      
      $clientes = DB::table('clientes')->where('estado',1)->get();


      foreach ($clientes as $datos) {
        $facturas = DB::table('factura')->where('idcliente',$datos->idcliente)->whereIn('idestado',['PA'])->get();
        $count = count($facturas);

        if ($count > 0) {
          foreach ($facturas as $val) {
            $cont++;

            if ($cont > 1) {
              $lista[] = array(''.$datos->idcliente.'' => $cont);
              DB::table('factura')
                ->where('codigo',$fac->codigo)->delete();
              }

              $cont = 0;
              $codigo = null;
          }
        }
      }        


      dd($lista);    
    }

    public function validarFechaCorte()
    {
      $cont = 0;
      $codigo = null;
      $fecha_corte = null;

      $facturas = DB::table('factura')
      ->whereColumn([
        ['fecha_fin', '>', 'fecha_corte']
      ])->get();

      foreach ($facturas as $fac) {
        $fecha_corte = Carbon::createFromFormat('d/m/Y', $fac->fecha_corte);
        $fecha_corte = $fecha_corte->addMonth();

        DB::table('factura')
        ->where('codigo',$fac->codigo)
        ->update([
          'fecha_corte' => $fecha_corte
        ]);
      }

      dd($facturas);    
    }


}
