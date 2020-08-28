<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use Illuminate\Support\Collection as Collection;
use Carbon\Carbon;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idcliente)
    {
        $idemisor = null;
        $idreceptor = null;
        $parent = null;

        $modo = DB::table('modo_equipo')->where('estado',1)->get();
        foreach ($modo as $value) {
            if($value->es_emisor == 1)
                $idemisor = $value->idmodo;
            if($value->es_cliente == 1)
                $idreceptor = $value->idmodo;
        }

        $servicio = DB::table('servicio_internet')->get();
        $router = DB::table('router')->get();
        $tipo = DB::table('tipo_acceso')->get();
        $queues = DB::table('queues')->get();
        $eqemisor = DB::table('equipos')->where('idmodo',$idemisor)->get();
        $eqreceptor = DB::table('equipos')->where('idmodo',$idreceptor)->get();
        $perfiles = DB::table('perfiles')->get();
        $tecnicos = DB::table('tecnicos')->get();
        $parametros = DB::table('parametros')->where('tipo_parametro','SISTEMA')->get();
        $zonas = DB::table('zonas')
            ->select('id', 'nombre', 'dsc_corta')
            ->where('estado', '1')
            ->get();

        foreach ($parametros as $val) {
            if ($val->parametro == 'ADD_PARENT_QUEUE') {
                $parent = $val->valor;
            }
        }

        

        $parametros = DB::table('parametros')->where('tipo_parametro','FACTURACION')->get();

        return view('forms.servicio.mntServicio', [
                    'servicio'   => $servicio,
                    'router'     => $router,
                    'tipo'       => $tipo,
                    'queues'     => $queues,
                    'eqemisor'   => $eqemisor,
                    'eqreceptor' => $eqreceptor,
                    'idcliente'  => $idcliente,
                    'perfiles'   => $perfiles,
                    'parametros' => $parametros,
                    'parent'     => $parent,
                    'tecnicos'   => $tecnicos,
                    'zonas'      => $zonas
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
         //dd($request);
        $key = new MaestroController();
        $codigo = $key->codigoN(10);

        $rules = array(            
            'idrouter'          => 'required',
            'tipo_acceso'       => 'required',
            'perfil_internet'   => 'required',
            'precio'            => 'required',
            'fecha_instalacion' => 'required',
            'dia_pago'          => 'required',
            'zonas'             =>'required',
            'tecnico'           =>'required',
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {

        DB::table('servicio_internet')
            ->insert([
                'idempresa'         => '001',
                'idservicio'        => $codigo,
                'estado'            => 1,
                'idrouter'          => $request->idrouter,
                'tipo_acceso'       => $request->tipo_acceso,
                'perfil_internet'   => $request->perfil_internet,
                'usuario_cliente'   => $request->usuario_cliente,
                'contrasena_cliente' => $request->contrasena_cliente,
                'direccion'         => $request->direccion, 
                'ip'                => $request->ip,
                'mac'               => $request->mac,
                'fecha_instalacion' => Carbon::createFromFormat('d/m/Y', $request->fecha_instalacion),
                'dia_pago'          => $request->dia_pago,
                'precio'            => $request->precio,
                'idtecnico'         => $request->tecnico,                 
                'glosa'             => $request->glosa,               
                'fecha_creacion'    => date('Y-m-d h:m:s'),
                'idcliente'         => $request->idcliente,
                'formulario'        => 'MNT_SERVICIO_INTERNET',
                'idusuario'         => Auth::user()->id,
                'idZona'            =>$request->zonas,
                'parent'            => $request->parent
        ]);

            /*if (!is_null($request->usuario_receptor)) {
                DB::table('dequipos')
                ->insert([
                    'idequipo'       => $request->equipo_receptor,
                    'idservicio'     => $codigo,
                    'idcliente'      => $request->idcliente,
                    'formulario'     => 'MNT_SERVICIO_INTERNET',
                    'glosa'          => (empty($request->p_glosa)) ? null : $p_request->glosa,
                    'fecha_creacion' => date('Y-m-d h:m:s'),
                    'idusuario'      => Auth::user()->id,
                    'relacion_servicio' => 'PR'
                ]);
            }*/

            $parametros = DB::table('parametros')->whereIn('tipo_parametro',['SISTEMA','CLIENTES','FACTURACION'])->get();
            $dia_facturacion = null;
            $activar_notificacion = null;
            $aviso = 0;
            $corte = 0;
            $frecuencia_corte = 0;
            $parent = null;
            $valorInstalacion=0;
            
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
                }else if ($parametro->parametro == 'ADD_PARENT_QUEUE') {
                    $parent = $parametro->valor;
                }
            }
            //dd("ingreso a grabar");  

            $cliente = DB::table('clientes')->where('idcliente',$request->idcliente)->get();
            $nombre = null;

            foreach ($cliente as $val) {
                $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
            } 
            $idusu = Auth::user()->id;
            $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

            if(count($validacion) > 0) {           
                DB::table('validacion')
                ->where('idusuario',strval($idusu))
                ->update(['valor' => 1]);  
            }

            $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
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
           //dd("llego");
           $perfil = DB::table('perfiles')->where('idperfil',$request->perfil_internet)->get();
            foreach ($router as $rou) {
                //dd($perfil);
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                    foreach ($perfil as $val) {                    

                        if( trim($request->tipo_acceso) == "HST" ){     
                            $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                "name"      => $request->usuario_cliente,
                                "password"  => $request->contrasena_cliente,  
                                "profile"   => $val->hotspot_perfil,  
                                "server"    => 'hotspot1',
                                "comment"   => $nombre
                            ));  
                        }else if(trim($request->tipo_acceso) == "QUE"){
                            if ($parent == 'SI') {
                                //dd($request->parent);
                                $ARRAY = $API->comm("/queue/simple/add", array(
                                    "name"      => $nombre,
                                    "target"    => $request->ip,  
                                    "max-limit" => $val->target,
                                    "parent"    => $request->parent 
                                )); 
                            }else{
                                $ARRAY = $API->comm("/queue/simple/add", array(
                                    "name"      => $nombre,
                                    "target"    => $request->ip,  
                                    "max-limit" => $val->target  
                                ));     
                            }
                            
                        }else if(trim($request->tipo_acceso) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => $val->address_list,
                                "address"   => $request->ip,
                                "comment"   => $nombre
                            )); 
                        }else if(trim($request->tipo_acceso) == "PPP"){
                            if ($addLocalIP == 'SI' and $addRemoteIP == 'SI') {
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $request->usuario_cliente,
                                    "password"  => $request->contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre,
                                    "local-address" => $localAddr,
                                    "remote-address" => $request->ip
                                ));  
                            }else if($addLocalIP == 'SI'){
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $request->usuario_cliente,
                                    "password"   => $request->contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre,
                                    "local-address" => $localAddr
                                ));  
                            }else if($addRemoteIP == 'SI'){
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $request->usuario_cliente,
                                    "password"  => $request->contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre,
                                    "remote-address" => $request->ip
                                ));  
                            }else{
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $request->usuario_cliente,
                                    "password"  => $request->contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre
                                ));  
                            }                                                        
                        }
                    }                
                }       
            }
            //dd($perfil);
            

            if($request->facturable =='SI'){
                //--------
                $dia_pago = Carbon::now()->addMonth()->day($request->dia_pago);
                $fecha_aviso = Carbon::now()->addMonth()->day($request->dia_pago)->subDays($aviso);
                $fecha_corte = Carbon::now()->addMonth()->day($request->dia_pago)->addDays($corte);
                $fecha_facturacion = Carbon::now()->addMonth(1);  
                $fecha_frecuencia = Carbon::now()->day($request->dia_pago)->addMonths($frecuencia_corte+1); 
                DB::table('notificaciones')
                ->insert([
                    'idempresa'         => '001',
                    'idservicio'        => $codigo,
                    'aviso'             => $aviso,
                    'corte'             => $corte,
                    'frecuencia'        => $frecuencia_corte,
                    'facturacion'       => $request->facturacion,
                    'fecha_pago'        => $dia_pago,
                    'fecha_aviso'       => $fecha_aviso,
                    'fecha_corte'       => $fecha_corte,
                    'fecha_frecuencia'  => $fecha_frecuencia,
                    'fecha_facturacion' => $fecha_facturacion
                ]);  
        
                //Se actualiza la fecha de pago del servicio en la tabla de clientes
                DB::table('clientes')->where('idcliente',$request->idcliente)
                ->update(['dia_pago' => $request->dia_pago]); 

                $doc_venta = DB::table('documento_venta')->where('estado',1)->get();

                foreach ($doc_venta as $val) {
                    if ($val->descripcion == 'BOLETA') {
                        $serie = $val->serie;
                        $numero = $val->correlativo;    
                    }
                }
                $fechaInicio=Carbon::createFromFormat('d/m/Y',$request->fecha_instalacion);
                $fechaFin=Carbon::createFromFormat('d/m/Y',$request->fecha_instalacion)->addMonth(1)->subDays(1);
                $fechaCorte=Carbon::createFromFormat('d/m/Y',$request->fecha_instalacion)->addMonth(1)->addDays(1);
                foreach ($perfil as $per) {
                    $detalle="Servicio de Internet Banda ancha 
                    Periodo: 
                            desde  $fechaInicio 
                            hasta  $fechaFin 
                    Fecha de corte: $fechaCorte 
                    Plan de Internet: $per->name 
                    Descarga: $per->vbajada  
                    Subida: $per->vsubida ";
                    
                } 
                $codigoFac = $key->codigoN(10);
                $fecha = Carbon::now();  
                $cliente = DB::table('clientes')->where('idcliente', $request->idcliente)->get();
                foreach ($cliente as $clien) {
                    $empresa=$clien->idempresa;
                    $moneda=$clien->moneda;
                    $doc_venta=$clien->doc_venta;
                    $forma_pago=$clien->forma_pago; 
                }
                //dd($cliente); 
                DB::table('factura')
                ->insert([  
                    'codigo'            => $codigoFac,
                    'idempresa'         => $empresa,
                    'idestado'          => 'EM',
                    'periodo'           => $fecha,
                    'fecha_emision'     => Carbon::now(),
                    'fecha_vencimiento' => $dia_pago,
                    'idcliente'         => $request->idcliente,
                    'idservicio'        => $codigo,
                    'formulario'        => 'CLIENTE_SERVICIOS_ADDCOMPROBANTE',
                    'idusuario'         => (int) Auth::user()->id, 
                    'idmoneda'          => $moneda,   
                    'idforma_pago'      => $forma_pago,  
                    'iddocumento'       => $doc_venta,       
                    'serie'             => $serie,  
                    'numero'            => str_pad($numero, 8, "0", STR_PAD_LEFT),
                    'costo_servicio'    => $request->precio, 
                    'subtotal'          => $request->precio,  
                    'descuento'         => 0,  
                    'subtotal_neto'     => $request->precio,  
                    'impuesto'          => 0,   
                    'total'             => $request->precio, 
                    'detalle'           => $detalle, 
                    'fecha_inicio'      => $fechaInicio,
                    'fecha_fin'         => $fechaFin,
                    'fecha_corte'       => $fecha_corte,
                    'idestado'          => 'EM',
                    'perfil'            => $per->name,
                    'vbajada'           => $per->vbajada,
                    'vsubida'           => $per->vsubida,
                    'fecha_creacion'    => date('Y-m-d h:m:s')
                ]);

                DB::table('dfactura')
                ->insert([     
                    'idfactura'         => $codigoFac,  
                    'idservicio'        => $codigo,
                    'cantidad'          => 1,
                    'precio'            => $request->precio,
                    'descuento'         => 0,  
                    'subtotal'          => $request->precio,  
                    'impuesto'          => 0,   
                    'total'             => $request->precio, 
                    'descripcion'       => $detalle
                ]);
                
                if($request->instalacion=='SI'){
                    $codigoServicio = $key->codigoN(10);
                    DB::table('dfactura')
                    ->insert([     
                        'idfactura'         => $codigoFac,  
                        'idconcepto'        => $codigoServicio,
                        'cantidad'          => 1,
                        'precio'            => $request->valorInstalacion,
                        'descuento'         => 0,  
                        'subtotal'          => $request->valorInstalacion,  
                        'impuesto'          => 0,   
                        'total'             => $request->valorInstalacion, 
                        'descripcion'       => 'Costo por instalación del servicio de Internet '
                    ]);
                    
                    $total= $request->precio+$request->valorInstalacion;
                    DB::table('factura')
                    ->where('codigo', $codigoFac)
                    ->update([
                        'idempresa'         => $empresa,
                        'subtotal'          => $total,
                        'subtotal_neto'     => $total,
                        'total'             => $total 
                    ]); 
                }
                $numero = $numero + 1;
                $numero = str_pad($numero, 8, "0", STR_PAD_LEFT); 
                DB::table('documento_venta')
                    ->where('iddocumento', $request->iddocumento)
                    ->update(['correlativo' => $numero]); 
            } 
            else{
                if ($activar_notificacion == 'SI') {
                    $dia_pago = Carbon::now()->addMonth()->day($request->dia_pago);
                    $fecha_aviso = Carbon::now()->addMonth()->day($request->dia_pago)->subDays($aviso);
                    $fecha_corte = Carbon::now()->addMonth()->day($request->dia_pago)->addDays($corte);
                    $fecha_facturacion = Carbon::now()->addMonth(1); 
    
                    $fecha_frecuencia = Carbon::now()->day($request->dia_pago)->addMonths($frecuencia_corte+1); 
                    DB::table('notificaciones')
                    ->insert([
                        'idempresa'         => '001',
                        'idservicio'        => $codigo,
                        'aviso'             => $aviso,
                        'corte'             => $corte,
                        'frecuencia'        => $frecuencia_corte,
                        'facturacion'       => $request->facturacion,
                        'fecha_pago'        => $dia_pago,
                        'fecha_aviso'       => $fecha_aviso,
                        'fecha_corte'       => $fecha_corte,
                        'fecha_frecuencia'  => $fecha_frecuencia,
                        'fecha_facturacion' => $fecha_facturacion
                    ]);  
    
                }else{
                    $fecha = Carbon::now();            
                    $fecha->day = $request->dia_pago;
                    $fecha_fin = Carbon::now();            
                    $fecha_fin->day = $request->dia_pago - 1;
                    $fecha_fin->addMonth();
                    $fecha_facturacion = Carbon::now()->addMonth()->day($request->p_fecha_factura);
                    DB::table('notificaciones')
                    ->insert([
                            'idempresa'         => '001',
                            'idservicio'        => $codigo,
                            'aviso'             => 0,
                            'corte'             => 0,
                            'frecuencia'        => 0,
                            'facturacion'       => $dia_facturacion,
                            'fecha_creacion'    => date('Y-m-d h:m:s'),
                            'idservicio'        => $codigo,
                            'fecha_inicio'      => $fecha->format('Y-m-d'),
                            'fecha_fin'         => $fecha_fin->format('Y-m-d'),
                            'fecha_facturacion' => $fecha_facturacion
                    ]);    
                }
    
                
                
            }


            $servicios = DB::table('servicio_internet')->get();


           
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
        $idemisor = null;
        $idreceptor = null;
        $idrouter = null;
        $idcliente = null;

        $modo = DB::table('modo_equipo')->where('estado',1)->get();
        foreach ($modo as $value) {
            if($value->es_emisor == 1)
                $idemisor = $value->idmodo;
            if($value->es_cliente == 1)
                $idreceptor = $value->idmodo;
        }
        
        $servicio = DB::table('servicio_internet')
                    ->where('idservicio',$id)->get();

        foreach ($servicio as $val) {
            $idrouter = $val->idrouter;
            $idcliente = $val->idcliente;
        }
        $router = DB::table('router')->get();
        $tipo = DB::table('tipo_acceso')->where('idrouter', $idrouter)->get();
        $queues = DB::table('queues')->get();
        $eqemisor = DB::table('equipos')->where('idmodo',$idemisor)->get();
        $eqreceptor = DB::table('equipos')->where('idmodo',$idreceptor)->get();
        $zonas = DB::table('zonas')
            ->select('id', 'nombre', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        
        $perfiles = DB::table('perfiles')->get();

        if (Auth::user()->idtipo == 'CLE') {
            return view('clientes.servicios.vwServicio', [
                    'servicio'   => $servicio,
                    'router'     => $router,
                    'tipo'       => $tipo,
                    'queues'     => $queues,
                    'eqemisor'   => $eqemisor,
                    'eqreceptor' => $eqreceptor,
                    'perfiles'   => $perfiles,
                    'idcliente'  => $idcliente
                ]);
        }

        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

            }
        }

        return view('forms.servicio.updServicio', [
                    'servicio'   => $servicio,
                    'router'     => $router,
                    'tipo'       => $tipo,
                    'queues'     => $queues,
                    'eqemisor'   => $eqemisor,
                    'eqreceptor' => $eqreceptor,
                    'perfiles'   => $perfiles,
                    'idcliente'  => $idcliente,
                    'zonas'      => $zonas
                ]);
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
       // dd($request);
        $request->session()->flash('latitud' );
        $request->session()->flash('longitud' );
        $request->session()->flash('direccion' );
        //dd($request);
        $rules = array(            
            'idrouter'          => 'required',
            'tipo_acceso'       => 'required',
            'perfil_internet'   => 'required',
            'precio'            => 'required',
            'dia_pago'          => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            $usuario = null;
            $idperfil = null;
            $idequipo = null;

            $servicio = DB::table('servicio_internet')->where('idservicio',$request->idservicio)->get();
            

            foreach ($servicio as $val) {
                $usuario = $val->usuario_cliente;
                $idperfil = $val->tipo_acceso;
                $idequipo = $val->usuario_receptor;

                DB::table('dequipos')->where(['idequipo' => $val->equipo_receptor,'idservicio' => $val->idservicio])->delete();
            }

            
            DB::table('servicio_internet')
            ->where('idservicio',$request->idservicio)
            ->update([      
                'idrouter'          => $request->idrouter,
                'tipo_acceso'       => $request->tipo_acceso,
                'perfil_internet'   => $request->perfil_internet,
                'usuario_cliente'   => $request->usuario_cliente,
                'contrasena_cliente'=> $request->contrasena_cliente,
                'direccion'         => $request->direccionSU, 
                'latitud'           => $request->latitudSU,
                'longitud'          => $request->longitudSU, 
                'ip'                => $request->ip,
                'mac'               => $request->mac,
                'dia_pago'          => $request->dia_pago,
                'precio'            => $request->precio,
                'fecha_instalacion' => Carbon::createFromFormat('d/m/Y', $request->fecha_instalacion),
                'emisor_conectado'  => $request->emisor_conectado,
                'equipo_receptor'   => $request->equipo_receptor,
                'ip_receptor'       => $request->ip_receptor,
                'usuario_receptor'  => $request->usuario_receptor,
                'contrasena_receptor'   => $request->contrasena_receptor, 
                'idcliente'         => $request->idcliente,
                'idZona'            =>$request->zonas,
                'glosa'             => $request->glosa
            ]);

            if (!is_null($request->usuario_receptor)) {
                DB::table('dequipos')
                ->insert([
                    'idequipo'       => $request->equipo_receptor,
                    'idservicio'     => $request->idservicio,
                    'idcliente'      => $request->idcliente,
                    'formulario'     => 'MNT_SERVICIO_INTERNET',
                    'glosa'          => (empty($request->p_glosa)) ? null : $p_request->glosa,
                    'fecha_creacion' => date('Y-m-d h:m:s'),
                    'idusuario'      => Auth::user()->id,
                    'relacion_servicio' => 'PR'
                ]);   
            }
            
            
            $servicio = DB::table('servicio_internet')->where('idservicio',$request->idservicio)->get();
            $idcliente = null;
            foreach ($servicio as $value) {
                $idcliente = $value->idcliente;
            }
            DB::table('clientes')->where('idcliente',$idcliente)
            ->update(['dia_pago' => $request->dia_pago]);


            //Se actualiza el estado a ASIGNADO en la tabla Equipos
            DB::table('equipos')->where('idequipo',$request->equipo_receptor)
            ->update(['idestado' => 'AS']);

            $cliente = DB::table('clientes')->where('idcliente',$request->idcliente)->get();
            $nombre = null;

            foreach ($cliente as $val) {
                $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
            }

            $idusu = Auth::user()->id;
            $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

            if (count($validacion) > 0) {           
                DB::table('validacion')
                ->where('idusuario',strval($idusu))
                ->update(['valor' => 2]);  
            }

            $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
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

                    $perfil = DB::table('perfiles')->where('idperfil',$request->perfil_internet)->get();

                    foreach ($perfil as $val) {  
                        //--ELiminar los usuarios antiguos del Mikrotik
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

                            foreach ($ARRAY as $value) {
                                if (isset($value['comment']) and $value['comment'] == $nombre) {
                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']  
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
                        }                  

                        //--Crear los nuevos usuarios en el Mikrotik
                        if( trim($request->tipo_acceso) == "HST" ){ 
                            $ARRAY = $API->comm("/ip/hotspot/user/print");

                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $usuario) {
                                    $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }    

                            $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                "name"      => $request->usuario_cliente,
                                "password"  => $request->contrasena_cliente,  
                                "profile"   => $val->hotspot_perfil,  
                                "server"    => 'hotspot1',
                                "comment"   => $nombre
                            ));                             
                        }else if(trim($request->tipo_acceso) == "QUE"){
                            $ARRAY = $API->comm("/queue/simple/print");

                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $nombre) {
                                    $ARRAY = $API->comm("/queue/simple/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            } 

                            $ARRAY = $API->comm("/queue/simple/add", array(
                                "name"      => $nombre,
                                "target"    => $request->ip,  
                                "max-limit" => $val->target  
                            ));                                
                        }else if(trim($request->tipo_acceso) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");

                            foreach ($ARRAY as $value) {
                                if (isset($value['address'])  and $value['address'] == $request->ip) {
                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }                 

                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => $val->address_list,
                                "address"   => $request->ip,
                                "comment"   => $nombre
                            )); 
                        }else if(trim($request->tipo_acceso) == "PPP"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");

                            foreach ($ARRAY as $value) {
                                if (isset($value['comment']) and $value['comment'] == $request->usuario_cliente) {
                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }            

                            if ($addLocalIP == 'SI' and $addRemoteIP == 'SI') {
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $request->usuario_cliente,
                                    "password"  => $request->contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre,
                                    "local-address" => $localAddr,
                                    "remote-address" => $request->ip
                                ));  
                            }else if($addLocalIP == 'SI'){
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "list"      => $request->usuario_cliente,
                                    "address"   => $request->contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre,
                                    "local-address" => $localAddr
                                ));  
                            }else if($addRemoteIP == 'SI'){
                               
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $request->usuario_cliente,
                                    "password"  => $request->contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre,
                                    "remote-address" => $request->ip
                                ));  
                            }else{
                                $ARRAY = $API->comm("/ppp/secret/add", array(
                                    "name"      => $request->usuario_cliente,
                                    "password"  => $request->contrasena_cliente,
                                    "service"   => 'pppoe',
                                    "profile"   => $val->perfil_pppoe,
                                    "comment"   => $nombre
                                ));  
                            }                                                        
                        }
                    }                
                }       
            }

            $servicios = DB::table('servicio_internet')->get();
            $collection = Collection::make($servicios);
            
            return response()->json($collection->toJson());        
        }         
    }

    public function updateNotificaciones(Request $request)
    {
        $dia_pago = Carbon::now()->addMonth()->day($request->dia_pago);
        $fecha_aviso = Carbon::now()->addMonth()->day($request->dia_pago)->subDays($request->aviso);
        $fecha_corte = Carbon::now()->addMonth()->day($request->dia_pago)->addDays($request->corte);
        $fecha_facturacion = Carbon::now()->addMonth()->day($request->facturacion);
        $fecha_frecuencia = Carbon::now()->day($request->dia_pago)->addMonths($request->frecuencia+1); 


        DB::table('notificaciones')
            ->where('codigo',$request->codigo)
            ->update([
                'aviso'         => $request->aviso,
                'corte'         => $request->corte,
                'frecuencia'    => $request->frecuencia,
                'facturacion'   => $request->facturacion,
                'fecha_pago'    => $dia_pago,
                'fecha_aviso'   => $fecha_aviso,
                'fecha_corte'   => $fecha_corte,
                'fecha_frecuencia'  => $fecha_frecuencia,
                'fecha_facturacion' => $fecha_facturacion
            ]);            
                
        return response()->json(['estado' => 'correcto']);          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idrouter = null;
        $idperfil = null;
        $idcliente = null;
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


        $servicio = DB::table('servicio_internet')->where('idservicio',$id)->get();

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
                                if (isset($value['address'])  and  $value['address'] == trim($serv->ip)) {
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
        }
        

        DB::table('servicio_internet')
            ->where('idservicio',$id)->delete();

        DB::table('notificaciones')
            ->where('idservicio',$id)->delete();

        DB::table('dequipos')
            ->where(['idservicio' => $id])->delete();

        return redirect('/cliente/'.$idcliente);
    }

    public function disabled(Request $request)
    {
        //dd($request);
        $idrouter = null;
        $idperfil = null;


        $servicio = DB::table('servicio_internet')->where('idservicio',$request->id)->get();

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
                                $ip = substr($value['target'], 0,strpos($value['target'], '/'));
                                
                                if ($ip == trim($serv->ip)) {
                                    $ARRAY = $API->comm("/queue/simple/disable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                        }else if(trim($val->idtipo) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");     
                            
                            foreach ($ARRAY as $value) {
                                if (isset($value['address'])  and  $value['address'] == $serv->ip) {
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
        }
        

        DB::table('servicio_internet')
        ->where('idservicio',$request->id)
        ->update([
            'estado'    => 0
        ]);



        $servicio = DB::table('servicio_internet')->where('idservicio',$request->id)->get();
        $collection = Collection::make($servicio);
                
        return response()->json($collection->toJson());   
    }

    public function habilitar(Request $request)
    {
        //dd($request);
        $idrouter = null;
        $idperfil = null;


        $servicio = DB::table('servicio_internet')->where('idservicio',$request->id)->get();

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
                                $ip = substr($value['target'], 0,strpos($value['target'], '/'));
                                
                                if ($ip == trim($serv->ip)) {
                                    $ARRAY = $API->comm("/queue/simple/enable", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }  
                        }else if(trim($val->idtipo) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");     
                            
                            foreach ($ARRAY as $value) {
                                if (isset($value['address'])  and  $value['address'] == $serv->ip) {
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
        }
        

        DB::table('servicio_internet')
        ->where('idservicio',$request->id)
        ->update([
            'estado'    => 1
        ]);



        $servicio = DB::table('servicio_internet')->where('idservicio',$request->id)->get();
        $collection = Collection::make($servicio);
                
        return response()->json($collection->toJson());   
    }

    public function index2($id)
    {
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
        $dequipos = DB::table('dequipos as DE')
            ->select('DE.idequipo', 'DE.idservicio','DE.facturado', 'DE.costo','E.descripcion','M.descripcion as marca', 'MO.descripcion as modelo','MD.descripcion as modo', 'E.ip','E.idestado')
            ->leftjoin('equipos as E', 'E.idequipo','=', 'DE.idequipo')
            ->leftjoin('marca as M', 'M.idmarca', '=', 'E.idmarca')
            ->leftjoin('modelo as MO', [['MO.idmodelo', '=', 'E.idmodelo'], ['MO.idmarca', '=', 'E.idmarca']])
            ->leftjoin('modo_equipo as MD', 'MD.idmodo', '=', 'E.idmodo')
            ->leftjoin('clientes as c', 'c.idcliente', '=', 'DE.idcliente')
            ->where('c.idcliente', Auth::user()->idcliente)
            ->get();
       
        $servicio = DB::table('servicio_internet as s')
            ->select('s.*')
            ->leftjoin('clientes as c', 'c.idcliente', '=', 's.idcliente')            
            ->where('c.idcliente', Auth::user()->idcliente)
            ->get();

        $router       = DB::table('router')->get();
        $tipo         = DB::table('tipo_acceso')->get();
        $perfiles     = DB::table('perfiles')->get();
       

        return view('clientes.servicios.lstServicios', [
            'servicio'             => $servicio,
            'dequipos'             => $dequipos,
            'router'               => $router,
            'tipo'                 => $tipo,
            'perfiles'             => $perfiles
        ]);
    }

    public function activar(Request $request)
    {
        //dd($request);
        $idrouter = null;
        $idperfil = null;


        $servicio = DB::table('servicio_internet')->where('idservicio',$request->id)->get();

        foreach ($servicio as $serv) {
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

                    $cliente = DB::table('clientes')->where('idcliente',$serv->idcliente)->get();
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
                        }else if(trim($val->idtipo) == "PCQ"){  
                        //dd('entro');                                                      
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $ip,
                                "comment"   => $nombre
                            ));                                  
                        }else if(trim($val->idtipo) == "PPP"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $ip,
                                "comment"   => $nombre
                            ));    
                                                        
                        }
                    }                
                }       
            }   
        }
        

        DB::table('servicio_internet')
        ->where('idservicio',$request->id)
        ->update([
            'activar_notificacion'    => 1
        ]);



        $servicio = DB::table('servicio_internet')->where('idservicio',$request->id)->get();
        $collection = Collection::make($servicio);
                
        return response()->json($collection->toJson());   
    }

    public function desactivar(Request $request)
    {
        //dd($request);
        $idrouter = null;
        $idperfil = null;


        $servicio = DB::table('servicio_internet')->where('idservicio',$request->id)->get();

        foreach ($servicio as $serv) {
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

                    $cliente = DB::table('clientes')->where('idcliente',$serv->idcliente)->get();
                    $nombre = null;

                    foreach ($cliente as $val) {
                        $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
                    }

                    $perfil = DB::table('perfiles')->where('idperfil',$idperfil)->get();

                    foreach ($perfil as $val) {                    

                        if( trim($val->idtipo) == "HST" ){ 
                            //Logica por desarrollar
                                
                        }else if(trim($val->idtipo) == "QUE"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");

                            foreach ($ARRAY as $value) {  
                                if ($value['address'] == $ip and $value['list'] == 'Notificacion::InnovaTec') {

                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']
                                    ));                                            
                                }
                            }               
                        }else if(trim($val->idtipo) == "PCQ"){  
                        //dd('entro');                                                      
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");

                            foreach ($ARRAY as $value) {  
                                if ($value['address'] == $ip and $value['list'] == 'Notificacion::InnovaTec') {

                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']
                                    ));                                            
                                }
                            }                                       
                        }else if(trim($val->idtipo) == "PPP"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");

                            foreach ($ARRAY as $value) {  
                                if ($value['address'] == $ip and $value['list'] == 'Notificacion::InnovaTec') {

                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']
                                    ));                                            
                                }
                            }               
                                                        
                        }
                    }                
                }       
            }   
        }
        

        DB::table('servicio_internet')
        ->where('idservicio',$request->id)
        ->update([
            'activar_notificacion'    => 0
        ]);



        $servicio = DB::table('servicio_internet')->where('idservicio',$request->id)->get();
        $collection = Collection::make($servicio);
                
        return response()->json($collection->toJson());   
    }

    //------JPaiva--27-08-2019------------------------------------------GESTION DE IPs DISPONIBLES-------------------------------------------------
    public function getIpPool(Request $request)
    {
        //dd($request);
        $ip_inicial = null;
        $ip_final = null;
        $pool = DB::table('ip_pool')->where('idrouter',$request->idrouter)->get();
        
        return response()->json($pool);   
    }    

    public function listaIpDisponibles(Request $request)
    {
        //dd($request);
        $ip_inicial = null;
        $ip_final = null;
        $pool = DB::table('ip_pool')->where('codigo',$request->codigo)->get();

        foreach ($pool as $val) {
            $ip_inicial = $val->ip_inicial;
            $ip_final = $val->ip_final;
        }

        $ipsOcupados = DB::table('servicio_internet')
            ->select('ip')
            ->where('tipo_acceso', $request->idtipo)
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
        
        return response()->json($rango);   
    }    
}
