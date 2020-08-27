<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Validator;
use Excel;
use Carbon\Carbon; 

class ClientesController extends Controller
{      
    public function index()
    {
        //dd("paso");
        $clienteseliminados = null;
        $valida = 0; 
        //-- Validación para mostrar mensajes al realizar un CRUD
        $validacion = DB::table('validacion')
            ->select('valor')
            ->where('idusuario', Auth::user()->id)->get();

        foreach ($validacion as $val) {
            $valida = $val->valor;
        }
        if ($valida > 0) {
            DB::table('validacion')
                ->where('idusuario', strval(Auth::user()->id))
                ->update(['valor' => 0]);
        }

        //--
        $suspendidos = DB::table('servicio_internet')->where('activar_notificacion',2)->get();
        $avisos = DB::table('servicio_internet')->where('activar_notificacion',1)->get();
        $comprobantes = DB::table('factura')->where('idestado','EM')->get();

        if (empty(Auth::user()->idempresa) or Auth::user()->idtipo == 'SUD') {  //---------SUD = Super Admin-----------
            $clientes = DB::table('clientes as c')
            ->select('c.idcliente', 'c.razon_social', 'c.nombres','c.apaterno','c.amaterno', 'c.direccion', 'd.descripcion', 'd.dsc_corta', 'c.nro_documento', 'c.contacto', 'c.estado','s.ip','s.dia_pago','s.precio')
            ->leftjoin('documento as d', 'c.iddocumento', '=', 'd.iddocumento')
            ->leftjoin('servicio_internet as s','s.idcliente','=','c.idcliente')
            ->get();
        }else{
            $clientes = DB::table('clientes as c')
            ->select('c.idcliente', 'c.razon_social', 'c.nombres','c.apaterno','c.amaterno', 'c.direccion', 'd.descripcion', 'd.dsc_corta', 'c.nro_documento', 'c.contacto', 'c.estado','s.ip','s.dia_pago','s.precio')
            ->leftjoin('documento as d', 'c.iddocumento', '=', 'd.iddocumento')
            ->leftjoin('servicio_internet as s','s.idcliente','=','c.idcliente')
            //->where(['c.idempresa','c.estado'], [Auth::user()->idempresa,1])
            ->where('c.idempresa', Auth::user()->idempresa)
            //->where('c.estado',[1,2]) 
            //->Where('c.estado',[1,2])
            //->whereNotIn('c.estado',  1)
            //->where('c.estado', 1) 
            ->get(); 
            $clienteseliminados = DB::table('clientes')->where ('estado',3)->get(); 
             
 
        }
       // dd($suspendidos,$avisos,$comprobantes,$clientes);
        return view('forms.clientes.lstClientes', [
            'clientes'              => $clientes,
            'suspendidos'           => $suspendidos,
            'avisos'                => $avisos,
            'comprobantes'          => $comprobantes, 
            'clienteseliminados'    => $clienteseliminados, 
            'valida'                => $valida
        ]);
        
    }

    public function cliente($id)
    {
        

        session(['idcliente' => $id]);

        $lat = session('latitud');
        $valida = 0;
        $dia_fecha_venc = 0;

        //-- Validación para mostrar mensajes al realizar un CRUD
        $validacion = DB::table('validacion')
            ->select('valor')
            ->where('idusuario', Auth::user()->id)->get();

        foreach ($validacion as $val) {
            $valida = $val->valor;
        }
        if ($valida > 0) {
            DB::table('validacion')
                ->where('idusuario', strval(Auth::user()->id))
                ->update(['valor' => 0]);
        }
        //--
        $empresa = DB::table('empresa')->where('estado',1)->get(); 
 
        $equipos = DB::table('equipos as e')
            ->select('e.idequipo','e.idestado','e.estado','e.descripcion','e.ip','m.descripcion as marca','mo.descripcion as modelo','md.descripcion as modo')
            ->leftjoin('marca as m', 'm.idmarca', '=', 'e.idmarca')            
            ->leftjoin('modelo as mo', [['m.idmarca', '=', 'mo.idmarca'],['mo.idmodelo','e.idmodelo']]) 
            ->leftjoin('modo_equipo as md', 'md.idmodo', '=', 'e.idmodo') 
            ->whereNull('e.idestado')
            ->orWhere('e.idestado','SN')
            ->get();
        //$dequipos = DB::select('CALL DEQUIPO_SERVICIO(?)', array($id));
        $dequipos = DB::table('dequipos as DE')
            ->select('DE.idequipo','ZN.nombre','E.direccion','E.latitud','E.longitud', 'DE.idservicio','DE.facturado', 'DE.costo','E.descripcion','M.descripcion as marca', 'MO.descripcion as modelo','MD.descripcion as modo', 'E.ip','E.idestado')
            ->leftjoin('equipos as E', 'E.idequipo','=', 'DE.idequipo')
            ->leftjoin('marca as M', 'M.idmarca', '=', 'E.idmarca')
            ->leftjoin('modelo as MO', [['MO.idmodelo', '=', 'E.idmodelo'], ['MO.idmarca', '=', 'E.idmarca']])
            ->leftjoin('modo_equipo as MD', 'MD.idmodo', '=', 'E.idmodo')
            ->leftjoin('zonas as ZN', 'ZN.id', '=', 'E.idZona') 
            ->where('DE.idcliente', $id)
            ->get();
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['FACTURACION','CLIENTES','ADD_MAPA_GPS'])
            ->where('estado',1)->get();
        $clientes = DB::table('clientes')
            ->where('idcliente', $id)->get();
        $servicio = DB::table('servicio_internet')
            ->where('idcliente', $id)->get();
        $router       = DB::table('router')->get();
        $tipo         = DB::table('tipo_acceso')->get();
        $queues       = DB::table('queues')->get();
        $eqemisor     = DB::table('equipos')->where(['idmodo' => 2, 'estado' => 1])->get();
        $eqreceptor   = DB::table('equipos')->where(['idmodo' => 3, 'estado' => 1])->get();
        $perfiles     = DB::table('perfiles')->get();
        $comprobantes = DB::table('factura')
            ->where(['idcliente' => $id, 'idestado' => 'EM'])->get();
        $comprobantes2 = DB::table('factura')
            ->where([
                ['idcliente', '=', $id],
                ['idestado' ,'<>', 'EM']
            ])->get();
        $dfactura = DB::table('dfactura as d')
            ->select('d.*')
            ->leftjoin('factura as f', 'f.codigo', '=', 'd.idfactura')
            ->where(['f.idcliente' => $id, 'f.idestado' => 'EM'])
            ->get();

         //dd($tipo);
        $idservicio = null;
        foreach ($servicio as $serv) {
            $idservicio = $serv->idservicio;
        } 

        $notificaciones = DB::table('notificaciones')
            /* ->where('idservicio', $idservicio) */->get();

        $tipo_documento = DB::table('documento')
            ->select('iddocumento', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $forma_pagos = DB::table('forma_pagos')
            ->select('idforma_pago', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();

        
        $zonas = DB::table('zonas')
            ->select('id', 'nombre', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        
        $tipo_documento_venta = DB::table('documento_venta')
            ->where('estado', 1)
            ->where('es_proforma', 0)
            ->get();
        //dd($tipo_documento_venta);
        $moneda = DB::table('tipo_moneda')
            ->select('idmoneda', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();

        $adjuntos= DB::table('documentos_adjuntos')->where(['idcliente' => $id,'estado' => '1'])->get();
        $marca = DB::table('marca')->where('estado',1)->get(); 
        $modelo = DB::table('modelo')->where('estado',1)->get();
        $modo = DB::table('modo_equipo')->where('estado',1)->get();
        $grupo = DB::table('grupo')->where('estado',1)->get();
        $documento = DB::table('documento_venta')->where('estado',1)->get(); 
        foreach ($parametros as $val) {
            if ($val->parametro == "DIA_FECHA_VENC") {
                $dia_fecha_venc = $val->valor_long;
            }
        }
       // dd($adjuntos);

        return view('forms.clientes.clientes', [
            'clientes'             => $clientes,
            'servicio'             => $servicio,
            'grupo'                => $grupo,
            'documento'            => $documento,
            'router'               => $router,
            'tipo'                 => $tipo,
            'queues'               => $queues,
            'eqemisor'             => $eqemisor,
            'eqreceptor'           => $eqreceptor,
            'notificaciones'       => $notificaciones,
            'perfiles'             => $perfiles,
            'comprobantes'         => $comprobantes,
            'comprobantes2'        => $comprobantes2,
            'valida'               => $valida,
            'tipo_documento'       => $tipo_documento,
            'forma_pagos'          => $forma_pagos,
            'zonas'                =>$zonas,
            'tipo_documento_venta' => $tipo_documento_venta,
            'moneda'               => $moneda,
            'parametros'           => $parametros,
            'dequipos'             => $dequipos,
            'equipos'              => $equipos,
            'modelo'               => $modelo,
            'modo'                 => $modo,
            'idcliente'            => $id,
            'dfactura'             => $dfactura,
            'dia_fecha_venc'       => $dia_fecha_venc,
            'empresa'              => $empresa,
            'adjuntos'             =>$adjuntos, 
            'marca'                => $marca,
            'latitud'              =>$lat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parametros = DB::table('parametros')->where('tipo_parametro','CLIENTES')->get();
        $tipo_documento = DB::table('documento')
            ->select('iddocumento', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $forma_pagos = DB::table('forma_pagos')
            ->select('idforma_pago', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $zonas = DB::table('zonas')
            ->select('id', 'nombre', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $tipo_documento_venta = DB::table('documento_venta')
            ->select('iddocumento', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $moneda = DB::table('tipo_moneda')
            ->select('idmoneda', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $empresa = DB::table('empresa')->where('estado',1)->get();

        return view('forms.clientes.mntClientes', [
            'tipo_documento'            => $tipo_documento,
            'forma_pagos'               => $forma_pagos,
            'tipo_documento_venta'      => $tipo_documento_venta,
            'moneda'                    => $moneda,
            'parametros'                => $parametros,
            'empresa'                   => $empresa,
            'zonas'                     =>  $zonas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
        $request->session()->flash('latitud' );
        $request->session()->flash('longitud' );
        $request->session()->flash('direccion' );
        $idusu      = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario', $idusu)->get();
        $key = new MaestroController();
        $codigo = null;
        $codigo = $key->codigoN(10);

         

        if($request->parametro == 'NO'){
                //$codigo = $request->nro_documento;
            $usuario = DB::table('users')->where('nro_documento', $request->codigo)->get();

                $rules = array(      
                    'idempresa'     => 'required',
                    'nro_documento' => 'required|max:50',
                    'apaterno'      => 'required|max:50',
                    'amaterno'      => 'required|max:50',
                    'nombres'       => 'required|string|max:50'            
                ); 
        }else{
            $usuario = DB::table('users')->where('idcliente', $request->codigo)->get();
                $rules = array(      
                    'idempresa'     => 'required',
                    'apaterno'      => 'required|max:50',
                    'amaterno'      => 'required|max:50',
                    'nombres'       => 'required|max:50'            
                );
        }


        if (count($validacion) === 0) {
            DB::table('validacion')
                ->insert([
                    'idusuario' => $idusu,
                    'valor'     => 1,
                ]);
        } else {
            DB::table('validacion')
                ->where('idusuario', strval($idusu))
                ->update(['valor' => 1]);

        } 
        //dd($rules);
        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        } 

      
        if(count($usuario) > 0){
            if($request->parametro == 'NO'){  
                DB::table('clientes')
                ->where('nro_documento', strval($request->nro_documento))
                ->update([ 
                    'idempresa'     => $request->idempresa,
                    'apaterno'      => $request->apaterno,
                    'amaterno'      => $request->amaterno,
                    'nombres'       => $request->nombres,
                    'iddocumento'   => $request->iddocumento,
                    'nro_documento' => $request->nro_documento,
                    'direccion'     => $request->direccion,
                    'latitud'       => $request->latitudF,
                    'longitud'      => $request->longitudF,
                    'idZonas'       =>$request->zonas, 
                    'link_mapa'     => $request->link_mapa,
                    'correo'        => $request->correo,
                    'estado'        => 1,
                    'telefono1'     => $request->telefono1,
                    'telefono2'     => $request->telefono2,
                    'forma_pago'    => $request->forma_pago,
                    'doc_venta'     => $request->doc_venta,
                    'moneda'        => $request->moneda,
                    'dia_pago'      => $request->dia_pago,
                    'contacto'      => $request->contacto,
                    'idpersonal'    => Auth::user()->id,
                    'razon_social'  => $request->apaterno . ' ' . $request->amaterno . ' ' . $request->nombres,
                    'glosa'         => $request->glosa
                ]);
                 
                DB::table('proforma')
                ->where('nro_documento', strval($request->nro_documento))
                ->update([ 
                    'datos_Utilizado'      =>'SI',//   se utiliza  
                ]);
                if (!is_null($request->correo)) {
                    DB::table('users')
                    ->insert([
                        //'id'              => $id,
                        'nombre'            => $request->nombres,
                        'apellidos'         => $request->apaterno.' '.$request->amaterno,
                        'idtipo'            => 'CLE',
                        'estado'            => 1,
                        'email'             => $request->correo,
                        'password'          => Hash::make($codigo),
                        'usuario'           => $codigo,
                        'nro_documento'     => $codigo,
                        'cargo'             => 'CLIENTE',
                        'avatar'            => null,
                        'telefono'          => $request->telefono1,
                        'glosa'             => $request->glosa,
                        'created_at'        => date('Y-m-d h:m:s')
                    ]);

                // 'datos_Utilizado'      =>'NO',,// 1 -> se utiliza 
                } 
                
            } 
        }else {
            DB::table('clientes')
            ->insert([
                'idempresa'      => $request->idempresa,
                'estado'         => 1,
                'idcliente'      => $codigo,
                'apaterno'       => $request->apaterno,
                'amaterno'       => $request->amaterno,
                'nombres'        => $request->nombres,
                'iddocumento'    => $request->iddocumento,
                'nro_documento'  => $codigo,
                'direccion'      => $request->direccion, 
                'idZonas'      => $request->zonas,
                'latitud'     => $request->latitudC,
                'longitud'     => $request->longitudC,
                'link_mapa'      => $request->link_mapa,
                'correo'         => $request->correo,
                'telefono1'      => $request->telefono1,
                'telefono2'      => $request->telefono2,
                'forma_pago'     => (empty($request->forma_pago)) ? null : $request->forma_pago,
                'doc_venta'      => (empty($request->doc_venta)) ? null : $request->doc_venta,
                'moneda'         => (empty($request->moneda)) ? null : $request->moneda,
                'dia_pago'       => (empty($request->dia_pago)) ? null : $request->dia_pago,
                'contacto'       => (empty($request->contacto)) ? null : $request->contacto,
                'idpersonal'     => Auth::user()->id,
                'razon_social'   => $request->apaterno . ' ' . $request->amaterno . ' ' . $request->nombres,
                'glosa'          => (empty($request->glosa)) ? null : $request->glosa,
                'fecha_creacion' => date('Y-m-d h:m:s'),
            ]); 
            if (!is_null($request->correo)) {
                DB::table('users')
                ->insert([
                    //'id'              => $id,
                    'nombre'            => $request->nombres,
                    'apellidos'         => $request->apaterno.' '.$request->amaterno,
                    'idtipo'            => 'CLE',
                    'estado'            => 1,
                    'email'             => $request->correo,
                    'password'          => Hash::make($codigo),
                    'usuario'           => $codigo,
                    'nro_documento'     => $codigo,
                    'cargo'             => 'CLIENTE',
                    'avatar'            => null,
                    'telefono'          => $request->telefono1,
                    'glosa'             => $request->glosa,
                    'created_at'        => date('Y-m-d h:m:s')
                ]);
            }

        }
         
       // return redirect('/clientes');
    }

    public function storeServicio(Request $request)
    {
        $rules = array(
            'idrouter'         => 'required',
            'tipo_acceso'      => 'required',
            'perfil_internet'  => 'required',
            'emisor_conectado' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        } else {
            DB::table('servicio_internet')
                ->insert([
                    'idempresa'           => '001',
                    'estado'              => 1,
                    'idrouter'            => $request->idrouter,
                    'tipo_acceso'         => $request->tipo_acceso,
                    'perfil_internet'     => $request->perfil_internet,
                    'usuario_cliente'     => $request->usuario_cliente,
                    'contrasena_cliente'  => $request->contrasena_cliente,
                    'direccion'           => $request->direccion,
                    'coordenadas'         => $request->coordenadas,
                    'ip'                  => $request->ip,
                    'mac'                 => $request->mac,
                    'fecha_instalacion'   => date('Y-m-d'),
                    'dia_pago'            => $request->dia_pago,
                    'precio'              => $request->precio,
                    'emisor_conectado'    => $request->emisor_conectado,
                    'equipo_receptor'     => $request->equipo_receptor,
                    'ip_receptor'         => $request->ip_receptor,
                    'usuario_receptor'    => $request->usuario_receptor,
                    'contrasena_receptor' => $request->contrasena_receptor,
                    'glosa'               => $request->glosa,
                    'fecha_creacion'      => date('Y-m-d h:m:s'),
                ]);

            $servicios  = DB::table('vw_servicio_internet')->get();
            $collection = Collection::make($servicios);

            return response()->json($collection->toJson());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientes = DB::table('clientes')
            ->where('idcliente', $id)->get();

        return view('forms.clientes.edtClientes', ['clientes' => $clientes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);

        $request->session()->flash('latitud' );
        $request->session()->flash('longitud' );
        $request->session()->flash('direccion' );
 
        $idusu      = Auth::user()->id;
        $nombre = null;
        $nombre_new = null;
        $validacion = DB::table('validacion')->where('idusuario', $idusu)->get();

        if (count($validacion) > 0) {
            DB::table('validacion')
                ->where('idusuario', strval($idusu))
                ->update(['valor' => 2]);
        }

        $servicio = DB::table('servicio_internet')->where('idcliente',$request->idcliente)->get();
        $cliente = DB::table('clientes')->where('idcliente',$request->idcliente)->get();        

        foreach ($cliente as $val) {
            $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
        }

        $nombre_new = $request->nombres.' '.$request->apaterno.' '.$request->amaterno;
        //dd($nombre,$nombre_new);
        foreach ($servicio as $serv) {
            $idperfil = $serv->tipo_acceso;
            $ip = $serv->ip;
            $usuario = $serv->usuario_cliente;
            $contrasena_cliente = $serv->contrasena_cliente;
            
            $router = DB::table('router')->where('idrouter',$serv->idrouter)->get();
            $parametros = DB::table('parametros')->where('tipo_parametro','PPPOE')->get();
            $addLocalIP = null;
            $addRemoteIP = null;
            $localAddr = null;

            foreach ($parametros as $val) {
                if ($val->parametro == 'ADD_LOCAL_ADDR') {
                    $addLocalIP = $val->valor;
                }
                if ($val->parametro == 'ADD_REMOTE_ADDR') {
                    $addRemoteIP = $val->valor;
                }
                if ($val->parametro == 'LOCAL_ADDR') {
                    $localAddr = $val->valor_long;
                }
            }
            
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $perfil = DB::table('perfiles')->where('idperfil',$serv->perfil_internet)->get();
                
                    foreach ($perfil as $val) {  
                        //--Actualizar los usuarios antiguos del Mikrotik
                        if( trim($idperfil) == "HST" ){     
                            $ARRAY = $API->comm("/ip/hotspot/user/print");

                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $usuario) {
                                    $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                          
                                }
                            }              
                        }else if(trim($idperfil) == "QUE"){
                            $ARRAY = $API->comm("/queue/simple/print");
                        
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $nombre) {
                                    $ARRAY = $API->comm("/queue/simple/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }                           
                        }else if(trim($idperfil) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");
                        //dd($ARRAY);
                            foreach ($ARRAY as $value) {
                                //if (isset($value['comment']) and trim($value['comment']) == trim($nombre)) {
                                if ($value['address'] == $serv->ip) {
                                    //dd($value['comment'],$value['.id'],trim($nombre),$nombre_new);
                                    $ARRAY = $API->comm("/ip/firewall/address-list/set", array(
                                        ".id"       => $value['.id'],
                                        "comment"   => $nombre_new
                                    )); 
                                }
                            }               
                        }else if(trim($idperfil) == "PPP"){
                            $ARRAY = $API->comm("/ppp/secret/print");

                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $usuario) {
                                    $ARRAY = $API->comm("/ppp/secret/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                          
                                }
                            } 

                            if ($addLocalIP == 'SI' and $addRemoteIP == 'SI') {
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $usuario,
                                    "password"  => $contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre_new,
                                    "local-address" => $localAddr,
                                    "remote-address" => $ip
                                ));  
                            }else if($addLocalIP == 'SI'){
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "list"      => $usuario,
                                    "address"   => $contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre_new,
                                    "local-address" => $localAddr
                                ));  
                            }else if($addRemoteIP == 'SI'){
                               
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $usuario,
                                    "password"  => $contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre_new,
                                    "remote-address" => $ip
                                ));
                            }else{
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $usuario_cliente,
                                    "password"  => $contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre_new
                                ));  
                            }                                                    
                        }
                    }                  
                }
            }
        }
        
        //dd('paso');

        DB::table('clientes')
            ->where('idcliente', strval($request->idcliente))
            ->update([
                'idcliente'     =>  (is_null($request->nro_documento))? $request->idcliente : $request->nro_documento,
                'idempresa'     => $request->idempresa,
                'apaterno'      => $request->apaterno,
                'amaterno'      => $request->amaterno,
                'nombres'       => $request->nombres,
                'iddocumento'   => $request->iddocumento,
                'nro_documento' => $request->nro_documento,
                'direccion'     => $request->direccion,
                'latitud'       => $request->latitudF,
                'longitud'      => $request->longitudF,
                'idZonas'       =>$request->zonas, 
                'link_mapa'     => $request->link_mapa,
                'correo'        => $request->correo,
                'telefono1'     => $request->telefono1,
                'telefono2'     => $request->telefono2,
                'forma_pago'    => (empty($request->forma_pago)) ? null : $request->forma_pago,
                'doc_venta'     => (empty($request->doc_venta)) ? null : $request->doc_venta,
                'moneda'        => (empty($request->moneda)) ? null : $request->moneda,
                'dia_pago'      => (empty($request->dia_pago)) ? null : $request->dia_pago,
                'contacto'      => (empty($request->contacto)) ? null : $request->contacto,
                'idpersonal'    => Auth::user()->id,
                'razon_social'  => $request->apaterno . ' ' . $request->amaterno . ' ' . $request->nombres,
                'glosa'         => (empty($request->glosa)) ? null : $request->glosa,
            ]);

               

        return redirect('/clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idusu      = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario', $idusu)->get();

        if (count($validacion) === 0) {
            DB::table('validacion')
                ->insert([
                    'idusuario' => $idusu,
                    'valor'     => 3,
                ]);
        } else {
            DB::table('validacion')
                ->where('idusuario', strval($idusu))
                ->update(['valor' => 3]);

        }

        $servicio = DB::table('servicio_internet')->where('idcliente',$id)->get();

        foreach ($servicio as $serv) {
            $idrouter = $serv->idrouter;
            $idperfil = $serv->perfil_internet; 
            $usuario = $serv->usuario_cliente;
            $idcliente = $serv->idcliente;

            $router = DB::table('router')->where('idrouter',$idrouter)->get();
            DB::table('dequipos')->where(['idequipo' => $serv->equipo_receptor,'idservicio' => $serv->idservicio])->delete();

            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $cliente = DB::table('clientes')->where('idcliente',$serv->idcliente)->get();
                    $nombre = null;

                    foreach ($cliente as $val) {
                        $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
                    }

                    $perfil = DB::table('perfiles')->where('idperfil',$idperfil)->get();

                    foreach ($perfil as $val) {                    

                        if( trim($val->idtipo) == "HST" ){ 
                            $ARRAY = $API->comm("/ip/hotspot/user/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $serv->usuario_cliente) {
                                    $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }      
                                
                        }else if(trim($val->idtipo) == "QUE"){
                            $ARRAY = $API->comm("/queue/simple/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == trim($nombre)) {
                                    $ARRAY = $API->comm("/queue/simple/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                        }else if(trim($val->idtipo) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");     
                            
                            foreach ($ARRAY as $value) {
                                if (isset($value['comment'])  and $value['comment'] == trim($nombre)) {
                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                                
                        }else if(trim($val->idtipo) == "PPP"){
                            $ARRAY = $API->comm("/ppp/secret/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $serv->usuario_cliente) {
                                    $ARRAY = $API->comm("/ppp/secret/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                                                        
                        }
                    }                
                }       
            } 

            DB::table('servicio_internet')
                ->where('idservicio',$serv->idservicio)->delete();

            DB::table('notificaciones')
                ->where('idservicio',$serv->idservicio)->delete();  

            DB::table('dequipos')
                ->where(['idservicio' => $serv->idservicio, 'idcliente' => $id])->delete();
        }
        
        

        DB::table('clientes')
            ->where('idcliente', $id)->delete();

            DB::table('clientes')
            ->where('idcliente', strval($id))
            ->update(['estado' => 3]);

        return redirect('/clientes');
    }

    public function showHerramientas()
    {

        return view('forms.herramientas.frmHerramientas');
    }

    public function verificarID(Request $request)
    {
        //dd($request);
        //--- Parametro->NO= documentos -----------Parametro->SI=Cod Interno
       // $cliente = DB::table('clientes')->where('idcliente', $request->codigo)->get();
       if($request->parametro == 'NO'){
        $cliente = DB::table('clientes')->where('nro_documento', $request->codigo)->get(); 
       }else{
        $cliente = DB::table('clientes')->where('idcliente', $request->codigo)->get();
       }
       
       // dd($cliente);

        foreach ($cliente as $value) {
            $nro_documento=$value->nro_documento; 
            $estado=$value->estado; 
            $apaterno=$value->apaterno;
            $amaterno=$value->amaterno;
            $nombres=$value->nombres;
            $direccion=$value->direccion;
            $correo=$value->correo;
            $telefono1=$value->telefono1;
            $longitud=$value->longitud;
            $latitud=$value->latitud;
        } 
        
        //dd($estado);

        if(count($cliente) > 0){
           // dd("ingreso");
            if($estado==5){
                return response()->json([ 
                    
                    'errors'        => 'ESTADO_5',
                    'apaterno'      =>$apaterno,
                    'amaterno'      =>$amaterno,
                    'nombres'       =>$nombres,
                    'direccion'     =>$direccion,
                    'correo'        =>$correo,
                    'telefono1'     =>$telefono1,
                    'longitud'      =>$longitud,
                    'latitud'       =>$latitud ,
                    'nro_documento' =>$nro_documento
                ]);
            }else{
                return response()->json(array('errors'=> 'EXISTE'));

            }
           
        }
        
        $collection = Collection::make($cliente); 
        return response()->json($collection->toJson());   
    }

    public function disabled(Request $request)
    {
        //dd($request);
        $idrouter = null;
        $idperfil = null;


        $servicio = DB::table('servicio_internet')->where('idcliente',$request->id)->get();

        foreach ($servicio as $serv) {
            $idrouter = $serv->idrouter;
            $idperfil = $serv->perfil_internet; 
            $usuario = $serv->usuario_cliente;

            $router = DB::table('router')->where('idrouter',$idrouter)->get();

            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $cliente = DB::table('clientes')->where('idcliente',$serv->idcliente)->get();
                    $nombre = null;

                    foreach ($cliente as $val) {
                        $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
                    }

                    $perfil = DB::table('perfiles')->where('idperfil',$idperfil)->get();

                    foreach ($perfil as $val) {                    

                        if( trim($val->idtipo) == "HST" ){ 
                            $ARRAY = $API->comm("/ip/hotspot/user/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $serv->usuario_cliente) {
                                    $ARRAY = $API->comm("/ip/hotspot/user/disable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }      
                                
                        }else if(trim($val->idtipo) == "QUE"){
                            $ARRAY = $API->comm("/queue/simple/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $nombre) {
                                    $ARRAY = $API->comm("/queue/simple/disable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                        }else if(trim($val->idtipo) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");     
                
                            foreach ($ARRAY as $value) {
                                if ($value['address'] == $serv->ip) {
                                    $ARRAY = $API->comm("/ip/firewall/address-list/disable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                                
                        }else if(trim($val->idtipo) == "PPP"){
                            $ARRAY = $API->comm("/ppp/secret/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $serv->usuario_cliente) {
                                    $ARRAY = $API->comm("/ppp/secret/disable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                                                        
                        }
                    }                
                }       
            }   

            //--Desabilitamos el servicio de internet
            DB::table('servicio_internet')
            ->where('idservicio',$serv->idservicio)
            ->update([
                'estado'    => 0
            ]);
        }
        

        DB::table('clientes')
        ->where('idcliente',$request->id)
        ->update([
            'estado'    => 0
        ]);



        $cliente = DB::table('clientes')->where('idcliente',$request->id)->get();
        $collection = Collection::make($cliente);
                
        return response()->json($collection->toJson());   
    }

    public function habilitar(Request $request)
    {
        //dd($request);
        $idrouter = null;
        $idperfil = null;


        $servicio = DB::table('servicio_internet')->where('idcliente',$request->id)->get();

        foreach ($servicio as $serv) {
            $idrouter = $serv->idrouter;
            $idperfil = $serv->perfil_internet; 
            $usuario = $serv->usuario_cliente;

            $router = DB::table('router')->where('idrouter',$idrouter)->get();
            
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $cliente = DB::table('clientes')->where('idcliente',$serv->idcliente)->get();
                    $nombre = null;

                    foreach ($cliente as $val) {
                        $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
                    }

                    $perfil = DB::table('perfiles')->where('idperfil',$idperfil)->get();

                    foreach ($perfil as $val) {                    

                        if( trim($val->idtipo) == "HST" ){ 
                            $ARRAY = $API->comm("/ip/hotspot/user/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $serv->usuario_cliente) {
                                    $ARRAY = $API->comm("/ip/hotspot/user/enable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }      
                                
                        }else if(trim($val->idtipo) == "QUE"){
                            $ARRAY = $API->comm("/queue/simple/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $nombre) {
                                    $ARRAY = $API->comm("/queue/simple/enable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                        }else if(trim($val->idtipo) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['address'] == $serv->ip) {
                                    $ARRAY = $API->comm("/ip/firewall/address-list/enable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                                
                        }else if(trim($val->idtipo) == "PPP"){
                            $ARRAY = $API->comm("/ppp/secret/print");     
                            
                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $serv->usuario_cliente) {
                                    $ARRAY = $API->comm("/ppp/secret/enable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                                                        
                        }
                    }                
                }       
            }   

            //--Habilitamos el servicio de internet
            DB::table('servicio_internet')
            ->where('idservicio',$serv->idservicio)
            ->update([
                'estado'    => 1
            ]);
        }
        

        DB::table('clientes')
        ->where('idcliente',$request->id)
        ->update([
            'estado'    => 1
        ]);



        $cliente = DB::table('clientes')->where('idcliente',$request->id)->get();
        $collection = Collection::make($cliente);
                
        return response()->json($collection->toJson());   
    }

    public function exportExcelClientes()
    {
        $headerExport = DB::table('clientes as c')
                    ->select('c.idcliente','c.razon_social', 'p.name', 's.ip', 's.dia_pago','s.precio')
                    ->leftjoin('servicio_internet as s', 's.idcliente', '=', 'c.idcliente')
                    ->leftjoin('perfiles as p', 'p.idperfil', '=', 's.perfil_internet')
                    //->where('c.idcarrito',$id)
                    ->get()
                    ->toArray();     

        $header_array[] = array('Codigo','Razon Social', 'Perfil', 'IP','Dia Pago','Precio');

        foreach ($headerExport as $header) {
             $header_array[] = array(
                'Codigo'        => $header->idcliente,
                'Razon Social'  => $header->razon_social,
                'Perfil'        => $header->name,
                'IP'            => $header->ip,
                'Dia Pago'      => $header->dia_pago,
                'Precio'        => $header->precio
            );
        }

       
        $data = $header_array;
              
                //dd($data);
        return Excel::create('LISTA CLIENTES', function($exportExcel) use ($data){         
                $exportExcel->sheet('Lista de clientes', function($sheet) use ($data){ 

                                                                                           
                $sheet->fromArray($data, null, 'A1', false, false);   

                $sheet->cells('A1:F1', function($cells) {
                   $cells->setBackground('#64b5f6');
                   $cells->setFontWeight('bold'); 
                });              

               
            });

        })->download('xlsx');

    }

    public function exonerar(Request $request)
    {
        //dd($request);
        $idrouter = null;
        $idperfil = null;

        //--Exoneramos el cliente de pagos del servicio
        DB::table('clientes')
        ->where('idcliente',$request->id)
        ->update([
            'estado'    => 2
        ]);


        $cliente = DB::table('clientes')->where('idcliente',$request->id)->get();
        $collection = Collection::make($cliente);
                
        return response()->json($collection->toJson());   
    }
    public function notificaciones()
    {
        $fecha_actual = Carbon::now();
        //$fecha_actual = $fecha_actual->addDays(1);
        $factura = DB::table('factura')->get();

        $notificaciones = DB::table('clientes as c')
            ->select('c.razon_social','r.alias','s.estado','s.idservicio','p.name','s.activar_notificacion','s.dia_pago','c.idcliente')
            ->leftjoin('servicio_internet as s','c.idcliente','s.idcliente')
            ->leftjoin('router as r','r.idrouter','s.idrouter')
            //->leftjoin('factura as f','f.idservicio','s.idservicio')
            ->leftjoin('perfiles as p','p.idperfil','s.perfil_internet')
            ->where([
                ['s.activar_notificacion','<>',0],
                //['f.idestado','=','EM'],
                ['c.estado','=',1],
               // ['f.fecha_corte','<=',$fecha_actual],
            ])
            ->get();

        return view('forms.clientes.lstNotificaciones',[
            'notificaciones'        => $notificaciones,
            'factura'               => $factura
        ]);
    }

    public function calendario(){
        return view('forms.pruebas.calendario');
    }

    public function setCorte(Request $req)
    {
        $ip_server = null;
        $nombre = null;

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['SISTEMA'])
            ->where('estado',1)->get();

        foreach ($parametros as $val) {
          if($val->parametro == 'ADD_IP_SERVER')
            $ip_server = $val->valor_long;
        }

        $servicio = DB::table('servicio_internet as s')
        ->leftjoin('clientes as c','c.idcliente','s.idcliente')
        ->leftjoin('perfiles as p','p.idperfil','s.perfil_internet')
        ->where('s.idservicio',$req->id)->get();

        foreach ($servicio as $serv) {
            $nombre = $serv->nombres.' '.$serv->apaterno.' '.$serv->amaterno;
            $tipo_servicio = $serv->tipo_acceso;
            $router = DB::table('router')->where('idrouter',$serv->idrouter)->get();
     
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
              if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                //Eliminar aviso y corte de la lista de acceso del proxy
                $ARRAY = $API->comm("/ip/proxy/access/print");
                foreach ($ARRAY as $value) {  
                    if (isset($value['src-address']) and $value['src-address'] == $serv->ip) {
                             
                        $ARRAY = $API->comm("/ip/proxy/access/remove", array(
                            ".id"       => $value['.id']
                        ));                                            
                    }
                }
                   
                //Eliminar aviso y corte de la lista de acceso del address list
                $ARRAY = $API->comm("/ip/firewall/address-list/print");
                foreach ($ARRAY as $value) {  
                    if ($value['address'] == $serv->ip){

                        $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                            ".id"       => $value['.id']
                        ));                                            
                    }
                } 
                
                //Agregar morosos segun tipo de acceso
                if ($tipo_servicio == 'HST') {                  
                  
                  $ARRAY = $API->comm("/ip/hotspot/user/print");

                  foreach ($ARRAY as $value) {   
                    if ($value['name'] == $serv->usuario_cliente) {
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
                        "address"   => $serv->ip,
                        "comment"   => $nombre
                      ));                                                                               
                    }
                  }   

                  $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $serv->ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/vwCorte"
                  ));

                }else if ($tipo_servicio == 'PCQ'){
                    
                    $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $serv->ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/vwCorte"
                    ));  


                    $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Morosos::InnovaTec',
                                "address"   => $serv->ip,
                                "comment"   => $nombre
                    )); 

                                     

                }else if ($tipo_servicio == 'PPP'){
                  $ARRAY = $API->comm("/ppp/secret/print");

                  foreach ($ARRAY as $value) {   
                    if ($value['name'] == $usuario) {
                      $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                        "list"      => 'Morosos::InnovaTec',  
                        "address"   => $serv->ip,
                        "comment"   => $nombre
                      ));                                            
                    }
                  }  

                  $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $serv->ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/vwCorte"
                  ));              
                }

                DB::table('servicio_internet')
                  ->where('idservicio',$serv->idservicio)
                  ->update([
                      'activar_notificacion'    => 2
                ]);                                                    
              }       
            } 

            
        }

        return response()->json(array('valor' => 'CONFORME'));   
    }

    public function setAviso(Request $req)
    {
        {
        $ip_server = null;
        $nombre = null;

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['SISTEMA'])
            ->where('estado',1)->get();

        foreach ($parametros as $val) {
          if($val->parametro == 'ADD_IP_SERVER')
            $ip_server = $val->valor_long;
        }

        $servicio = DB::table('servicio_internet as s')
        ->leftjoin('clientes as c','c.idcliente','s.idcliente')
        ->leftjoin('perfiles as p','p.idperfil','s.perfil_internet')
        ->where('s.idservicio',$req->id)->get();

        foreach ($servicio as $serv) {
            $nombre = $serv->nombres.' '.$serv->apaterno.' '.$serv->amaterno;
            $tipo_servicio = $serv->tipo_acceso;
            $router = DB::table('router')->where('idrouter',$serv->idrouter)->get();
     
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
              if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                //Eliminar aviso y corte de la lista de acceso del proxy
                $ARRAY = $API->comm("/ip/proxy/access/print");
                foreach ($ARRAY as $value) {  
                    if (isset($value['src-address']) and $value['src-address'] == $serv->ip ) {
                             
                        $ARRAY = $API->comm("/ip/proxy/access/remove", array(
                            ".id"       => $value['.id']
                        ));                                            
                    }
                }
                   
                //Eliminar aviso y corte de la lista de acceso del address list
                $ARRAY = $API->comm("/ip/firewall/address-list/print");
                foreach ($ARRAY as $value) {  
                    if ($value['address'] == $serv->ip) {

                        $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                            ".id"       => $value['.id']
                        ));                                            
                    }
                } 
                
                //Agregar morosos segun tipo de acceso
                if ($tipo_servicio == 'HST') {                  
                  
                  $ARRAY = $API->comm("/ip/hotspot/user/print");

                  foreach ($ARRAY as $value) {   
                    if ($value['name'] == $serv->usuario_cliente) {
                      $ARRAY = $API->comm("/ip/hotspot/user/set", array(
                          "profile"   => 'Aviso',  
                          ".id"       => $value['.id']
                      ));                                                 
                    }
                  }                     
                }else if ($tipo_servicio == 'QUE'){
                    $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $serv->ip,
                                "comment"   => $nombre
                    ));  

                    $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $serv->ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/aviso"
                    ));

                }else if ($tipo_servicio == 'PCQ'){
                    //dd('entro');
                    $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => $serv->address_list,
                                "address"   => $serv->ip,
                                "comment"   => $nombre
                    )); 

                    $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $serv->ip,
                                "comment"   => $nombre
                    )); 

                  $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $serv->ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/aviso"
                  ));      

                }else if ($tipo_servicio == 'PPP'){
                    $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $serv->ip,
                                "comment"   => $nombre
                    ));   

                    $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $serv->ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/aviso"
                    ));              
                }                                                   
              }       
            } 

            DB::table('servicio_internet')
              ->where('idservicio',$serv->idservicio)
              ->update([
                  'activar_notificacion'    => 1
            ]); 
        }

        return response()->json(array('valor' => 'CONFORME'));   
    }
    }

    public function restablecer(Request $req)
    {
        {
        $ip_server = null;
        $nombre = null;

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['SISTEMA'])
            ->where('estado',1)->get();

        foreach ($parametros as $val) {
          if($val->parametro == 'ADD_IP_SERVER')
            $ip_server = $val->valor_long;
        }

        $servicio = DB::table('servicio_internet as s')
        ->leftjoin('clientes as c','c.idcliente','s.idcliente')
        ->leftjoin('perfiles as p','p.idperfil','s.perfil_internet')
        ->where('s.idservicio',$req->id)->get();

        foreach ($servicio as $serv) {
            $nombre = $serv->nombres.' '.$serv->apaterno.' '.$serv->amaterno;
            $tipo_servicio = $serv->tipo_acceso;
            $router = DB::table('router')->where('idrouter',$serv->idrouter)->get();
     
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
              if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                //Eliminar aviso y corte de la lista de acceso del proxy
                $ARRAY = $API->comm("/ip/proxy/access/print");
                foreach ($ARRAY as $value) {  
                    if (isset($value['src-address']) and $value['src-address'] == $serv->ip ) {
                             
                        $ARRAY = $API->comm("/ip/proxy/access/remove", array(
                            ".id"       => $value['.id']
                        ));                                            
                    }
                }
                   
                //Eliminar aviso y corte de la lista de acceso del address list
                $ARRAY = $API->comm("/ip/firewall/address-list/print");
                foreach ($ARRAY as $value) {  
                    if ($value['address'] == $serv->ip) {

                        $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                            ".id"       => $value['.id']
                        ));                                            
                    }
                } 
                
                //Agregar morosos segun tipo de acceso
                if ($tipo_servicio == 'HST') {                  
                  
                    $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                "name"      => $serv->usuario_cliente,
                                "password"  => $serv->contrasena_cliente,  
                                "profile"   => $serv->hotspot_perfil,  
                                "server"    => 'hotspot1',
                                "comment"   => $nombre
                    ));        

                               
                }else if ($tipo_servicio == 'QUE'){
                    
                    $ARRAY = $API->comm("/queue/simple/add", array(
                                "name"      => $nombre,
                                "target"    => $serv->ip,  
                                "max-limit" => $serv->target  
                    ));   
                }else if ($tipo_servicio == 'PCQ'){
                    //dd('entro');
                    $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => $serv->address_list,
                                "address"   => $serv->ip,
                                "comment"   => $nombre
                    )); 

                    
                }else if ($tipo_servicio == 'PPP'){
                    
                }                                                   
              }       
            } 

            DB::table('servicio_internet')
              ->where('idservicio',$serv->idservicio)
              ->update([
                  'activar_notificacion'    => 0
            ]); 
        }

        return response()->json(array('valor' => 'CONFORME'));   
    }
    }

   //-----JPaiva--16-10-2019----------------------------HERRAMIENTAS---------------------------------------------------
   public function herramientaClientes()
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

       return view('forms.clientes.herramientas.importExport',[
           'valida'    => $valida
       ]);
   }

   public function importarClientes(Request $request)
   {   //dd($request);
       $key = new MaestroController();
       $codigo = null;
       $estado = 0;
       $iddocumento = null;
       $idforma_pago = null;
       $iddoc_venta = null;
       $idmoneda = null;
       $cliente = null;

       $file = $request->file('clientesXLS');
       //dd($file);

       Excel::load($file, function($reader) {
           foreach ($reader->get() as $excel){
               $codigo = null;
             //  dd($excel->codigo);
               if (isset($excel->codigo) and strlen($excel->codigo) > 0) {
                   if (isset($excel->ip) and strlen($excel->ip) > 0) {
                       $cliente = DB::table('clientes as c')
                       ->leftjoin('servicio_internet as s','s.idcliente','=','c.idcliente')
                       ->where('c.idcliente',$excel->codigo)
                       ->orWhere('s.ip',$excel->ip)
                       ->get();
                   }else{
                       $cliente = DB::table('clientes as c')
                       ->leftjoin('servicio_internet as s','s.idcliente','=','c.idcliente')
                       ->where('c.idcliente',$excel->codigo)
                       //->orWhere('s.ip',$excel->ip)
                       ->get();
                   }
               }               
               //dd("paso");
                               
               if (count($cliente) > 0) {  
                  // dd("ingreso al primer if");   
                   foreach ($cliente as $valor) {
                       $codigo = $valor->idcliente;
                   }           
           
                   //----------------------------Actualiza Cliente----------------------------------------                
                   DB::table('clientes')
                   ->where('idcliente',$codigo)
                   ->update([
                       'idempresa'      => (isset($excel->idempresa))? $excel->idempresa : 'E01',
                       'apaterno'       => (isset($excel->apaterno)? $excel->apaterno : null),
                       'amaterno'       => (isset($excel['a.materno'])? $excel['a.materno'] : null),
                       'nombres'        => (isset($excel->nombre))? $excel->nombre : $excel->razon_social,
                       'direccion'      => $excel->direccion,
                       'telefono1'      => $excel->telefono,
                       'idpersonal'     => Auth::user()->id,
                       'nro_documento'  => (isset($excel->cedula)? $excel->cedula : null),
                       'razon_social'   => (!empty($nombre))? $nombre : $excel->razon_social,
                       'correo'         => (isset($excel->correo)? $excel->correo : null),
                       'formulario'     => 'FORM_IMPORTEXPORTCLIENTES',                    
                       'fecha_creacion' => date('Y-m-d h:m:s')
                   ]);  
                   //dd("actualizo cliente") ;

                   //----------Creación de los servicios de internet-----------------      
                   $dia_pago = (isset($excel->dia_pago) and !empty($excel->dia_pago))? substr($excel->dia_pago, 0,2) : null;

                   DB::table('servicio_internet')
                   ->where('idcliente',$codigo)
                   ->update([
                       'ip'                => (isset($excel->ip)? $excel->ip : null),
                       'dia_pago'          => $dia_pago,
                       'precio'            => strval($excel->precio)
                   ]); 
               

           }else{
               //dd("paso");
               $tipo_documento = DB::table('documento')->where('estado', '1')->get();
               $forma_pagos = DB::table('forma_pagos')->where('estado', '1')->get();
               $tipo_documento_venta = DB::table('documento_venta')->where('estado', '1')->where('es_proforma', 0)->get();
               $moneda = DB::table('tipo_moneda')->where('estado', '1')->get();

               foreach ($tipo_documento as $val) {
                   $iddocumento = $val->iddocumento;
               }
               foreach ($forma_pagos as $val) {
                   $idforma_pago = $val->idforma_pago;
               }

               foreach ($tipo_documento_venta as $val) {
                   $iddoc_venta = $val->iddocumento;
               }

               foreach ($moneda as $val) {
                   $idmoneda = $val->idmoneda;
               }
    
               
                   $nombre = null;
                   $key = new MaestroController();
                   $codigo = $key->codigoN(10);

                   if (isset($excel->nombre) and !empty($excel->nombre)) {
                       $nombre =$excel->aparterno. ' ' . $excel->amaterno. ' ' . $excel->nombre;
                       //dd($nombre);
                   }else{
                       $nombre = $excel->razon_social;
                   }
                  // dd($nombre);
                   //dd("por grabar");
                   //-------------------Creacion de los clientes------------------
                   DB::table('clientes')
                   ->insert([
                       'idempresa'      => (isset($excel->idempresa))? $excel->idempresa : '001',
                      // 'estado'         => (isset($excel->estado))? $excel->estado : 1,
                        'estado'         => $excel->estado,
                       'idcliente'      => $codigo,
                       'apaterno'       => (isset($excel->aparterno)? $excel->aparterno: null),
                       'amaterno'       => (isset($excel->amaterno)? $excel->amaterno : null),
                       'nombres'        => (isset($excel->nombre))? $excel->nombre : $excel->razon_social,
                       'iddocumento'    => $iddocumento,
                       'nro_documento'  => (isset($excel->dni))? $excel->dni : $codigo,
                       'direccion'      => trim($excel->direccion),
                       'telefono1'      => $excel->telefono,
                       'forma_pago'     => $idforma_pago,
                       'doc_venta'      => $iddoc_venta,
                       'moneda'         => $idmoneda,
                       //'dia_pago'       => $excel->dia_pago,
                       'idpersonal'     => Auth::user()->id,
                       'razon_social'   => (!empty($nombre))? $nombre : $excel->razon_social,
                       'formulario'     => 'FORM_IMPORTEXPORTCLIENTES',                    
                       'fecha_creacion' => date('Y-m-d h:m:s')
                   ]);

                   //dd("se registro");

                   //dd("grabado");
                   $perfiles = DB::table('perfiles')->where('name',$excel->perfil)->get(); 
                  // dd($perfiles);
                   //------CAMBIAR--------
                   $idperfil = null;
                   $precio = null;
                   $idrouter = null;
                   $usuario_cliente = null;
                   $contrasena_cliente = null;
                   //dd($perfiles);
                   foreach ($perfiles as $val) {
                       $idperfil = $val->idperfil;
                       $precio = $val->precio;
                       $idrouter = $val->idrouter;
                   }
                  // dd("perfiles");

                   if (is_null($idrouter) and empty($idrouter)) {
                       dd($excel->razon_social);    
                   }

                   $API = new routeros_api();
                   $API->debug = false;
                   $ARRAY = null;

                   $router = DB::table('router')->where('idrouter',$idrouter)->get();

                   if (isset($excel->usuario) and !empty($excel->usuario)) {
                       $usuario_cliente = $excel->usuario;
                       $contrasena_cliente = (isset($excel->contra) and !empty($excel->contra))? $excel->contra : null;
                   }elseif($excel->tipo_acceso == 'PPP') {
                       foreach ($router as $rou) {
                           if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                               $ARRAY = $API->comm("/ppp/secret/print"); 

                               if (isset($excel->ip) and !empty($excel->ip)) {
                                   foreach ($ARRAY as $val) {
   
                                       if (trim($val['remote-address']) == trim($excel->ip)) {
                                           $usuario_cliente = (isset($val['name']))? trim($val['name']) : null;
                                           $contrasena_cliente = (isset($val['password']))? trim($val['password']) : null;
                                       }
                                   }
                               }elseif (isset($excel->razon_social) and !empty($excel->razon_social)) {
                                   foreach ($ARRAY as $val) {
                                       if (trim($val['name']) == trim($excel->razon_social)) {
                                           $usuario_cliente = (isset($val['name']))? trim($val['name']) : null;
                                           $contrasena_cliente = (isset($val['password']))? trim($val['password']) : null;
                                       }
                                   }
                               }
                               
                           }
                       }
                   }

                   //dd("por crear sevicio de internet");         
                   //----------Creación de los servicios de internet----------------- 
                   $dia_pago = (isset($excel->dia_pago) and !empty($excel->dia_pago))? substr($excel->dia_pago, 0,2) : null;
                   $idservicio = $key->codigoN(10);          

                   DB::table('servicio_internet')
                   ->insert([
                       'idempresa'         => (isset($excel->idempresa))? $excel->idempresa : '001',
                       'idservicio'        => $idservicio,
                       'estado'            => 1,
                       'idrouter'          => $idrouter,
                       'tipo_acceso'       => $excel->tipo_acceso,
                       'perfil_internet'   => $idperfil,
                       'ip'                => (isset($excel->ip)? $excel->ip : null),
                       'usuario_cliente'   => $usuario_cliente,                        
                       'contrasena_cliente' => $contrasena_cliente,
                       //'dia_pago'          => $excel->dia_pago,
                       'dia_pago'          => (isset($excel->dia_pago) and !empty($excel->dia_pago))? $dia_pago : null,
                       'precio'            => (isset($excel->precio) and !empty($excel->precio))? strval($excel->precio) : $precio,
                       'fecha_creacion'    => (isset($excel->fecha_instalacion) and !empty($excel->fecha_instalacion))? $excel->fecha_instalacion : date('Y-m-d h:m:s'),
                       'idZona'             =>'001',
                       'idcliente'         => $codigo
                   ]);
                   //dd("creo el servicio",$idservicio);

                   $parametros = DB::table('parametros')->where('tipo_parametro',['CLIENTES','FACTURACION'])->get();   
                   $dia_facturacion = null;
                   $activar_notificacion = null;
                   $aviso = 0;
                   $corte = 0;
                   $frecuencia_corte = 0;
                  // dd("no se donde estoy");
                   foreach ($parametros as $parametro) {
                       if ($parametro->parametro == 'DIA_GENERACION_FAC') {
                           $dia_facturacion = $parametro->valor_long;
                       }else if ($parametro->parametro == 'ACTIVAR_NOTIFICA') {
                           $activar_notificacion = $parametro->valor;
                       }else if ($parametro->parametro == 'ADD_INICIO_AVISO') {
                           $aviso = $parametro->valor_long;
                       }else if ($parametro->parametro == 'ADD_APLICAR_CORTE') {
                           $corte = $parametro->valor_long;
                       }else if ($parametro->parametro == 'ADD_FREC_CORTE') {
                           $frecuencia_corte = $parametro->valor_long;
                       }
                   }

                   if ($activar_notificacion == 'SI') {
                       $dia_pago = substr($excel->dia_pago, 0,2);
                       $fecha_aviso = Carbon::now()->addMonth()->day($dia_pago)->subDays($aviso);
                       $fecha_corte = Carbon::now()->addMonth()->day($dia_pago)->addDays($corte);
                       $fecha_facturacion = Carbon::now()->addMonth()->day($dia_facturacion);
                       $fecha_frecuencia = Carbon::now()->day($dia_pago)->addMonths($frecuencia_corte+1); 

                       $fecha = Carbon::now();            
                       $fecha->day = $dia_pago;
                       $fecha_fin = Carbon::now();            
                       $fecha_fin->day = $dia_pago - 1;
                       $fecha_fin->addMonth();

                       $dia_pago = Carbon::now()->addMonth()->day($dia_pago);

                       DB::table('notificaciones')
                       ->insert([
                           'idempresa'         => (isset($excel->idempresa))? $excel->idempresa : '001',
                           'idservicio'        => $idservicio,
                           'aviso'             => $aviso,
                           'corte'             => $corte,
                           'frecuencia'        => $frecuencia_corte,
                           'facturacion'       => $dia_facturacion,
                           'fecha_pago'        => $dia_pago,
                           'fecha_aviso'       => $fecha_aviso,
                           'fecha_corte'       => $fecha_corte,
                           'fecha_frecuencia'  => $fecha_frecuencia,
                           'fecha_facturacion' => $fecha_facturacion,
                           'fecha_inicio'      => $fecha->format('Y-m-d'),
                           'fecha_fin'         => $fecha_fin->format('Y-m-d')
                       ]);  

                   }else{
                       $dia_pago = substr($excel->dia_pago, 0,2);
                       $fecha = Carbon::now();            
                       $fecha->day = $dia_pago;
                       $fecha_fin = Carbon::now();            
                       $fecha_fin->day = $dia_pago - 1;
                       $fecha_fin->addMonth();

                       $fecha_facturacion = Carbon::now()->addMonth()->day($dia_facturacion);

                       DB::table('notificaciones')
                       ->insert([
                               'idempresa'         => (isset($excel->idempresa))? $excel->idempresa : '001',
                               'idservicio'        => $idservicio,
                               'aviso'             => 0,
                               'corte'             => 0,
                               'frecuencia'        => 0,
                               'facturacion'       => $dia_facturacion,
                               'fecha_creacion'    => date('Y-m-d h:m:s'),
                               'idservicio'        => $codigo,
                               'fecha_inicio'      => $fecha->format('Y-m-d'),
                               'fecha_fin'         => $fecha_fin->format('Y-m-d'),
                               'impuesto'          =>'NO',
                               'fecha_facturacion' => $fecha_facturacion
                       ]);    
                   }
                  // dd("por crear equipo");

                   //-------JPaiva--23-10-2019--------------Creación de Equipos-----------------------------
                   $idgrupo = null;
                   $idmarca = null;
                   $idmodelo = null;
                   $idmodo = null;

                   if (isset($excel->marca) and !empty($excel->marca)) {
                       $grupo = DB::table('grupo')->where('descripcion',(isset($excel->grupo))? $excel->grupo : null )->get();                        
                       $modo = DB::table('modo_equipo')->where('es_cliente',1)->get();

                       if (count($grupo) > 0) {
                           foreach ($grupo as $val) {
                               $idgrupo = $val->idgrupo;
                           }
                       }else{
                           $grupo = DB::table('grupo')->where('descripcion', 'CLIENTES')->get();                        

                           if (count($grupo) == 0) {
                               DB::table('grupo')
                               ->insert([
                                   'descripcion'    => "CLIENTES",
                                   'dsc_corta'      => "CLIE",
                                   'fecha_creacion' => date('Y-m-d H:m:s'),
                                   'estado'         => '1',
                               ]);

                               $grupo = DB::table('grupo')->where('descripcion', 'CLIENTES')->get();
                           }                            

                           foreach ($grupo as $val) {
                               $idgrupo = $val->idgrupo;
                           }
                       }

                       $marca = DB::table('marca')->where(
                           ['descripcion'      => (isset($excel->marca))? $excel->marca : null ],
                           ['idgrupo'          => $idgrupo]
                       )->get();

                       if (count($marca) > 0) {
                           foreach ($marca as $val) {
                               $idmarca = $val->idmarca;
                           }
                       }else{
                           if (isset($excel->marca) and !empty($excel->marca)) {
                               DB::table('marca')
                               ->insert([
                                   'descripcion'    => $excel->marca,
                                   //'dsc_corta'      => $request->dsc_corta,
                                   'idgrupo'        => $idgrupo,
                                   'fecha_creacion' => date('Y-m-d H:m:s'),
                                   'estado'         => '1',
                               ]);

                               $marca = DB::table('marca')->where(['idgrupo' => $idgrupo], ['descripcion' => $excel->marca])->get();
                               foreach ($marca as $val) {
                                   $idmarca = $val->idmarca;
                               }
                           }                            
                       }

                       $modelo = DB::table('modelo')->where(
                           ['descripcion'      => (isset($excel->modelo))? $excel->modelo : null],
                           ['idgrupo'          => $idgrupo],
                           ['idmarca'          => $idmarca]
                       )->get();

                       if (count($modelo) > 0) {
                           foreach ($modelo as $val) {
                               $idmodelo = $val->idmodelo;
                           }
                       }else{
                           if (isset($excel->modelo) and !empty($excel->modelo)) {
                               DB::table('modelo')
                               ->insert([
                                   'descripcion'    => $excel->modelo,
                                   //'dsc_corta'      => $request->dsc_corta,
                                   'idmarca'        => $idmarca,
                                   'fecha_creacion' => date('Y-m-d H:m:s'),
                                   'estado'         => '1',
                               ]);

                               $marca = DB::table('modelo')->where(['idmarca' => $idmarca], ['descripcion' => $excel->modelo])->get();

                               foreach ($modelo as $val) {
                                   $idmodelo = $val->idmodelo;
                               }
                           }
                       }

                       foreach ($modo as $val) {
                           $idmodo = $val->idmodo;
                       }  

                       DB::table('equipos')
                       ->insert([
                           'idempresa'     => (isset($excel->idempresa))? $excel->idempresa : '001',
                           'estado'        => 1,
                           'idcliente'     => $codigo,
                           'idgrupo'       => $idgrupo,
                           'idmarca'       => $idmarca,
                           'idmodelo'      => $idmodelo,
                           'descripcion'   => (isset($request->dsc_equipo) and strlen($request->dsc_equipo) > 0)? $request->dsc_equipo : 'Equipo Cliente'.$excel->razon_social,
                           'fecha_ingreso' => date('Y-m-d h:m:s'),
                           'idmodo'        => $idmodo,
                           'ip'            => (isset($excel->ip)? $excel->ip : null),
                           'mac'           => (isset($excel->mac)? $excel->mac : null),
                           'idestado'      => 'AS',
                           'ccq'           => (isset($excel->ccq) and !empty($excel->ccq))? $excel->ccq : null,
                           'senal'         => (isset($excel->senal) and !empty($excel->senal))? $excel->senal : null,
                           'rx'            => (isset($excel->rx) and !empty($excel->rx))? $excel->rx : null,
                           'tx'            => (isset($excel->tx) and !empty($excel->tx))? $excel->tx : null,
                           'coordenadas'   => (isset($excel->coordenadas) and !empty($excel->coordenadas))? $excel->coordenadas : null,
                           'idusuario'     => Auth::user()->id,
                           'formulario'    => 'FORM_IMPORTEXPORTCLIENTES',   
                           'fecha_creacion' => date('Y-m-d h:m:s')
                       ]);

                       //-------------------Creacion del detalle de EQUIPOS_SERVICIO------------------
                       $idequipo = null;
                       $equipo = DB::table('equipos')->where('idcliente',$codigo)->get();

                       foreach ($equipo as $val) {
                           $idequipo = $val->idequipo;
                       }
                       
                       DB::table('dequipos')
                       ->insert([
                           'idequipo'       => $idequipo,
                           'idservicio'     => $idservicio,
                           'idcliente'      => $codigo,
                           'formulario'     => 'FORM_IMPORTEXPORTCLIENTES', 
                           'fecha_creacion' => date('Y-m-d h:m:s'),
                           'idusuario'      => Auth::user()->id,
                           'relacion_servicio' => 'SE',
                           'facturado'      => 'NO',
                           'idestado'       => 'AS'
                       ]);

                   }  
                //dd("grabado");               
               }
               //dd("grabado");

           }
           

           $datos = DB::table('grupo_pro')->get();                
           $data['success'] = $datos;

           return $data;
       });

   }

   public function addUserPPPoE()
   {
       $usuario_cliente = null;
       $contrasena_cliente = null;
       $ip = null;
       
       $router = DB::table('router')->get();

       foreach ($router as $rou) {
           $API = new routeros_api();
           $API->debug = false;
           $ARRAY = null;

           $servicios = DB::table('servicio_internet')->where('idrouter',$rou->idrouter)->get();

           if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) { 
               $ARRAY = $API->comm("/ppp/active/print");

                   foreach ($servicios as $serv) {
                       foreach ($ARRAY as $value) {
                           if ($value['name'] == trim($serv->usuario_cliente)) {
                               $ip = $value['address'];   
                               
                               $ARRAY2 = $API->comm("/ppp/secret/print"); 

                               foreach ($ARRAY2 as $data) {
                                   if ($data['name'] == trim($serv->usuario_cliente)) {
                                       $id = $data['.id'];  
                                   }
                               }
                               
                               $ARRAY2 = $API->comm("/ppp/secret/set", array(
                                     ".id"     => $id,
                                     "remote-address" => $ip
                               )); 

                               //----------Creación de los servicios de internet-----------------                    
                               DB::table('servicio_internet')
                               ->where('idcliente',$serv->idcliente)
                               ->update([
                                   'ip'        => $ip
                               ]);  

                               dd($serv->idcliente, $ip, $serv->usuario_cliente);
                           }
                       }     
                   }                            
               }    

           
       }
   }

   public function addIpPool()
   {
       //dd($request);
       $ip_inicial = null;
       $ip_final = null;
       $pool = DB::table('ip_pool')->get();

       foreach ($pool as $val) {
           $ip_inicial = $val->ip_inicial;
           $ip_final = $val->ip_final;
       }

       $ipsOcupados = DB::table('servicio_internet')
           ->select('ip')
           ->get();

       $rango[] = null;
       $x = 0;
       $bandera = null;

       $ini = strpos($ip_inicial, '.',4)+1;
       $fin = strpos($ip_inicial, '.',$ini);
       $var = substr($ip_inicial, $ini,$fin-$ini);
       $xini = substr($ip_inicial, $fin+1,strlen($ip_inicial));

       $cadena = substr($ip_inicial, 0,$ini);

       $ini = strpos($ip_final, '.',4)+1;
       $fin = strpos($ip_final, '.',$ini);
       $var2 = substr($ip_final, $ini,$fin-$ini);
       $xfin = substr($ip_final, $fin+1,strlen($ip_final));

       for ($i=$var; $i <= $var2; $i++) { 
           $valor = 1;
           $valor2 = 255;
           if ($i == $var) {
               $valor = $xini;
           }            
           if ($i == $var2) {
               $valor2 = $xfin;
           }
           
           for ($a=$valor; $a <= $valor2; $a++) {
               $IP = $cadena.$i.'.'.$a;
               foreach ($ipsOcupados as $value) {
                   $bandera = 0;
                   if ($IP == $value->ip) {
                       $bandera = 1;
                       break;
                   }
               } 
               if ($bandera == 0) {
                   array_push($rango, ['ip' => $cadena.$i.'.'.$a]);
               }                
           }            
       }

       unset($rango[0]);
       //dd($rango);

       $usuario_cliente = null;
       $contrasena_cliente = null;
       $ip = null;
       
       $router = DB::table('router')->get();

       foreach ($router as $rou) {
           

               foreach ($rango as $pool) {
                   //dd($pool);
                   //$servicios = DB::table('servicio_internet')->where('idrouter',$rou->idrouter)->get();
                   //foreach ($servicios as $serv) {
                       //if (empty($serv->ip)) {
                   $API = new routeros_api();
                   $API->debug = false;
                   $ARRAY = null;

                   //$servicios = DB::table('servicio_internet')->where('idrouter',$rou->idrouter)->get();

                   if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) { 
                       $ARRAY = $API->comm("/ppp/secret/print"); 

                           foreach ($ARRAY as $value) {
                               //if ($value['name'] == trim($serv->usuario_cliente)) {
                                   
                                   $ARRAY2 = $API->comm("/ppp/secret/set", array(
                                         ".id"     => $value['.id'],
                                         "remote-address" => $pool['ip']
                                   )); 

                                   //----------Creación de los servicios de internet-----------------                    
                                   DB::table('servicio_internet')
                                   ->where('usuario_cliente',trim($value['name']))
                                   ->update([
                                       'ip'        => $pool['ip']
                                   ]);  

                                   //dd($serv->idcliente, $ip, $serv->usuario_cliente);
                                   //break 1;
                               }
                           //} 
                           //break; 

                       //}                        
                   }         
               //}

                                      
           }
           
       }
   }

   public function addIpPool2()
   {
       //dd($request);
       $ip_inicial = null;
       $ip_final = null;
       $pool = DB::table('ip_pool')->get();

       foreach ($pool as $val) {
           $ip_inicial = $val->ip_inicial;
           $ip_final = $val->ip_final;
       }

       $ipsOcupados = DB::table('servicio_internet')
           ->select('ip')
           ->get();

       $rango[] = null;
       $x = 0;
       $bandera = null;

       $ini = strpos($ip_inicial, '.',4)+1;
       $fin = strpos($ip_inicial, '.',$ini);
       $var = substr($ip_inicial, $ini,$fin-$ini);
       $xini = substr($ip_inicial, $fin+1,strlen($ip_inicial));

       $cadena = substr($ip_inicial, 0,$ini);

       $ini = strpos($ip_final, '.',4)+1;
       $fin = strpos($ip_final, '.',$ini);
       $var2 = substr($ip_final, $ini,$fin-$ini);
       $xfin = substr($ip_final, $fin+1,strlen($ip_final));

       for ($i=$var; $i <= $var2; $i++) { 
           $valor = 1;
           $valor2 = 255;
           if ($i == $var) {
               $valor = $xini;
           }            
           if ($i == $var2) {
               $valor2 = $xfin;
           }
           
           for ($a=$valor; $a <= $valor2; $a++) {
               $IP = $cadena.$i.'.'.$a;
               foreach ($ipsOcupados as $value) {
                   $bandera = 0;
                   if ($IP == $value->ip) {
                       $bandera = 1;
                       break;
                   }
               } 
               if ($bandera == 0) {
                   array_push($rango, ['ip' => $cadena.$i.'.'.$a]);

                   $router = DB::table('router')->get();

                   foreach ($router as $rou) {   
                       $API = new routeros_api();
                       $API->debug = false;
                       $ARRAY = null;

                       if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) { 
                           $ARRAY = $API->comm("/ppp/secret/print"); 

                               foreach ($ARRAY as $value) {
                                   if ($value['name'] == trim($serv->usuario_cliente)) {
                                       
                                       $ARRAY2 = $API->comm("/ppp/secret/set", array(
                                             ".id"     => $value['.id'],
                                             "remote-address" => $pool['ip']
                                       )); 

                                       //----------Creación de los servicios de internet-----------------                    
                                       DB::table('servicio_internet')
                                       ->where('usuario_cliente',trim($value['name']))
                                       ->update([
                                           'ip'        => $pool['ip']
                                       ]);  

                                       //dd($serv->idcliente, $ip, $serv->usuario_cliente);
                                       //break 1;
                                   }
                               } 
                               //break; 

                           //}                        
                       }       
                   }
               }                
           }            
       }

       unset($rango[0]);
       //dd($rango);

       $usuario_cliente = null;
       $contrasena_cliente = null;
       $ip = null;
       
       $router = DB::table('router')->get();

       foreach ($router as $rou) {
           

               foreach ($rango as $pool) {
                   //dd($pool);
                   //$servicios = DB::table('servicio_internet')->where('idrouter',$rou->idrouter)->get();
                   //foreach ($servicios as $serv) {
                       //if (empty($serv->ip)) {
                   $API = new routeros_api();
                   $API->debug = false;
                   $ARRAY = null;

                   //$servicios = DB::table('servicio_internet')->where('idrouter',$rou->idrouter)->get();

                   if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) { 
                       $ARRAY = $API->comm("/ppp/secret/print"); 
                       $cont = count($ARRAY);

                           foreach ($ARRAY as $value) {
                               //if ($value['name'] == trim($serv->usuario_cliente)) {
                                   
                                   $ARRAY2 = $API->comm("/ppp/secret/set", array(
                                         ".id"     => $value['.id'],
                                         "remote-address" => $pool['ip']
                                   )); 

                                   //----------Creación de los servicios de internet-----------------                    
                                   DB::table('servicio_internet')
                                   ->where('usuario_cliente',trim($value['name']))
                                   ->update([
                                       'ip'        => $pool['ip']
                                   ]);  

                                   //dd($serv->idcliente, $ip, $serv->usuario_cliente);
                                   //break 1;
                               }
                           //} 
                           //break; 

                       //}                        
                   }         
               //}

                                      
           }
           
       }
   }

   public function mapaPrueba(){
    return view('forms.pruebas.mapaAutocomplete');
   //return view('forms.clientes.mapa.modalUpdate');
}

public function mapaClientes(){
    //dd("llego");

    
        $zonas  = DB::table('zonas')->where('estado','1')->get(); 

        $usuarios = DB::table('servicio_internet')
        ->select('clientes.nombres','servicio_internet.emisor_conectado','equipos.modelo','modo_equipo.descripcion','servicio_internet.latitud','servicio_internet.longitud','zonas.nombre', DB::raw('equipos.latitud as latitudE'), DB::raw('equipos.longitud as longitudE'),'equipos.idequipo')
        ->join('clientes', 'servicio_internet.idcliente','=','clientes.idcliente') 
        ->join('equipos', 'equipos.idequipo', '=', 'servicio_internet.emisor_conectado') 
        ->join('modo_equipo', 'modo_equipo.idmodo', '=', 'equipos.idmodo')
        ->join('zonas', 'zonas.id', '=', 'servicio_internet.idZona')
        ->where('modo_equipo.descripcion',  'EMISOR')
        //->groupBy('equipos.modelo')
        ->get();  


       $equipos = DB::table('servicio_internet')
       ->select('equipos.modelo','modo_equipo.descripcion', 'equipos.idequipo','zonas.nombre','equipos.idZona',DB::raw('equipos.descripcion as modeloE'),DB::raw('equipos.latitud as latitudE'), DB::raw('equipos.longitud as longitudE')) 
       ->join('clientes', 'servicio_internet.idcliente','=','clientes.idcliente') 
       ->join('equipos', 'equipos.idequipo', '=', 'servicio_internet.emisor_conectado')
       ->join('modo_equipo', 'modo_equipo.idmodo', '=', 'equipos.idmodo')
       ->join('zonas', 'zonas.id', '=', 'servicio_internet.idZona')
       ->where('modo_equipo.descripcion',  'EMISOR')
       //->groupBy('equipos.modelo')
       ->get();
       //dd($usuarios ,$equipos);
       //dd($zonas,$usuarios,$equipos);

        return view('forms.clientes.mapa.lstClientesMapa', [
            'zonas'=>$zonas,
            'equipos' => $equipos ,
            'usuarios'=>$usuarios
    
        ]);
    

}

public function recibir(Request $request)
{  
        session(['latitud' => $request->latitude]);
        session(['longitud' => $request->longitud]);
        session(['direccion' => $request->direccionf]);  
}
public function pasar(Request $request)
{ 
        $datos = array(); 
        $latitud = session('latitud');
        $longitud = session('longitud');
        $direccion = session('direccion'); 
        $datos['latitud'] = $latitud;
        $datos['longitud'] = $longitud;
        $datos['direccion'] =  $direccion;
        /*if( $latitud !=null or  $latitud=='true'  )
        {
            $request->session()->flash('latitud' );
            $request->session()->flash('longitud' );
            $request->session()->flash('direccion' );
        } */
        //Session::flush();
       // dd($datos);
    return response()->json($datos);
}
public function pasarCreate(Request $request)
{ 
        $datos = array(); 
        $latitud = session('latitud');
        $longitud = session('longitud');
        $direccion = session('direccion'); 
        $datos['latitud'] = $latitud;
        $datos['longitud'] = $longitud;
        $datos['direccion'] =  $direccion;
        /*if( $latitud !=null or  $latitud=='true'  )
        {
            $request->session()->flash('latitud' );
            $request->session()->flash('longitud' );
            $request->session()->flash('direccion' );
        }  */

       // $request->session()->flash('latitud' );
      //  $request->session()->flash('longitud' );
       // $request->session()->flash('direccion' );
        //Session::flush();
       // dd($datos);
    return response()->json($datos);
}
public function iframe(){
    //$identificador_carrito = session('latitud');
    //$cookie_leida = $request->cookie('nombre');
    //dd($cookie_leida);
    /*$id = session('latitud');
    dd($id);*/
    $datos = array();
    $latitud = session('latitud');
        $longitud = session('longitud');
        $direccion = session('direccion');
         
        $datos['latitud'] = $latitud;
        $datos['longitud'] = $longitud;
        $datos['direccion'] =  $direccion;
       // Session::flush();
       //if(is_null($latitud)) 
       
        dd($datos);
    
    return view('forms.pruebas.iframe');
}

public function verificarCorreo(Request $request)
    {
       // dd($request); 
       $rules = array(  
        'correo'            => 'email',  
         
        );
        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            return response()->json($var);
        }
        //dd($validator);
       $cliente = DB::table('clientes')->where('correo', $request->correo)->get();  
        //dd($cliente); 
        if(count($cliente) > 0){
           // dd("ingreso");
           return response()->json(array('errors'=> 'EXISTE')); 
        }
         
        return response()->json(array('conforme'=> 'conforme'));   
    }



}
