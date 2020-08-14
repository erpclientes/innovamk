<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;
use Carbon\Carbon;

class HerramientasController extends Controller
{
    public function importClientes()
    {
        $dia_facturacion = null;
        $dia_pago = null;
        $router = DB::table('router')->get();
        $tipo = DB::table('tipo_acceso')->get();
        $forma_pagos = DB::table('forma_pagos')
            ->select('idforma_pago', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $tipo_documento_venta = DB::table('documento_venta')
            ->where('estado', '1')
            ->get();
        $moneda = DB::table('tipo_moneda')
            ->select('idmoneda', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $parametros = DB::table('parametros')->where('tipo_parametro','FACTURACION')->get();

        foreach ($parametros as $val) {
            if ($val->parametro == "DIA_GENERACION_FAC") {
                $dia_facturacion = $val->valor_long;
            }
            if ($val->parametro == "DIA_PAGO_CLIENTES") {
                $dia_pago = $val->valor_long;
            }
            
        }


        return view('forms.herramientas.importarClientes', [
            'router'               => $router,
            'tipo'                 => $tipo,
            'forma_pagos'          => $forma_pagos,
            'tipo_documento_venta' => $tipo_documento_venta,
            'moneda'               => $moneda,
            'dia_facturacion'      => $dia_facturacion,
            'dia_pago'             => $dia_pago,
        ]);
    }

    //------------------------------------TRAER USUARIOS CREADOR DEL MIKROTIK--------------------------------------------------------
    public function showUsuarios(Request $request)
    {
        //dd($request);
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
        $perfiles = DB::table('perfiles')->where('idtipo',$request->idtipo)->get();

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                if ($request->idtipo == 'PPP') {
                    $ARRAY = $API->comm("/ppp/secret/print"); 
                    //dd($ARRAY);
                }elseif ($request->idtipo == 'HST') {
                    $ARRAY = $API->comm("/ip/hotspot/user/print");
                }elseif ($request->idtipo == 'QUE') {
                    $ARRAY = $API->comm("/queue/simple/print");
                }elseif ($request->idtipo == 'PCQ') {
                    $ARRAY = $API->comm("/ip/firewall/address-list/print");
                }                                                                     
            }
        }


        for ($i=0; $i < count($ARRAY) ; $i++) { 
            if(isset($ARRAY[$i]['comment'])){
                $ARRAY[$i]['comment'] = utf8_encode($ARRAY[$i]['comment']);  
            }
            if($request->idtipo == 'PPP'){      
                
                if(!isset($ARRAY[$i]['comment']) or $ARRAY[$i]['comment'] == 'undefined'){
                        $ARRAY[$i]['comment'] = $ARRAY[$i]['name']; 
                } 
                foreach ($perfiles as $val) {
                    //dd($ARRAY,$perfiles);
                    if(isset($ARRAY[$i]['profile']) and trim($ARRAY[$i]['profile']) == trim($val->name)){
                        $ARRAY[$i]['idperfil'] = $val->idperfil;
                        $ARRAY[$i]['perfil'] = $val->name;
                        $ARRAY[$i]['precio'] = $val->precio;
                        break;
                    }else{
                        $ARRAY[$i]['idperfil'] = 'SN';
                        $ARRAY[$i]['perfil'] = 'SIN PERFIL';
                        $ARRAY[$i]['precio'] = '-';
                    }
                }
            }
            if($request->idtipo == 'QUE'){      
                //dd($ARRAY);
                if(isset($ARRAY[$i]['target'])){
                    $ARRAY[$i]['target'] = substr($ARRAY[$i]['target'], 0, strpos($ARRAY[$i]['target'], '/')); 
                }  
                if ($ARRAY[$i]['dynamic'] === "true") {
                    unset($ARRAY[$i]);
                }  
                if(isset($ARRAY[$i]['name'])){
                    $ARRAY[$i]['name'] = utf8_encode($ARRAY[$i]['name']);  
                }              
            }
            if($request->idtipo == 'PCQ'){      
                foreach ($perfiles as $val) {
                    if(isset($ARRAY[$i]['list']) and $ARRAY[$i]['list'] == $val->address_list){
                        $ARRAY[$i]['idperfil'] = $val->idperfil;
                        $ARRAY[$i]['perfil'] = $val->name;
                        $ARRAY[$i]['precio'] = $val->precio;
                        break;
                    }else{
                        $ARRAY[$i]['idperfil'] = 'SN';
                        $ARRAY[$i]['perfil'] = 'SIN PERFIL';
                        $ARRAY[$i]['precio'] = '-';
                    }
                }
            }
            if($request->idtipo == 'HST'){  
                foreach ($perfiles as $val) {
                    if(!isset($ARRAY[$i]['comment']) or $ARRAY[$i]['comment'] == 'undefined'){
                        $ARRAY[$i]['comment'] = 'Sin Descripción'; 
                    }
                    if(isset($ARRAY[$i]['profile']) and $ARRAY[$i]['profile'] == $val->name){
                        $ARRAY[$i]['idperfil'] = $val->idperfil;
                        $ARRAY[$i]['perfil'] = $val->name;
                        $ARRAY[$i]['precio'] = $val->precio;
                    }else{
                        $ARRAY[$i]['idperfil'] = 'SN';
                        $ARRAY[$i]['perfil'] = 'SIN PERFIL';
                        $ARRAY[$i]['precio'] = '-';
                    }
                }
            }

            
        }
        //dd($ARRAY);

        return response()->json($ARRAY);   
    }    

    //----------------------------------VALIDAR PARAMETROS PARA LA IMPORTACION----------------------------------------
    public function validaParametros(Request $request)
    {
        $rules = array(      
            'idrouter'      => 'required',
            'idtipo'        => 'required',
            'forma_pago'    => 'required',
            'doc_venta'     => 'required',
            'moneda'        => 'required',
            'dia_pago'      => 'required|max:2',
            'aviso'         => 'required',
            'corte'         => 'required',
            'frecuencia'    => 'required',
            'fecha_factura' => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }else{
            return response()->json(array('valor' => 'CONFORME'));
        }          
    }

    //-------------------------------------GUARDAR CLIENTES IMPORTADOS DESDE PPPoE---------------------------------
    public function guardarImportPPPoE(Request $request)
    {
        //dd($request);
        $key = new MaestroController();
        $codigo = null;
        $cont = $request->cont;
        $estado = 0;

        for ($i=0; $i <= $cont; $i++) {
           // dd($request['name'.$i]);
            if (!is_null($request['check'.$i])) { 
                if (count(DB::table('servicio_internet')->where('usuario_cliente', $request['name'.$i])->get()) == 0) { 

                $codigo = $key->codigoN(10);
                if ($request['disabled'.$i] == "false") {
                    $estado = 1;
                }
                //-------------------Creacion de los clientes------------------
                DB::table('clientes')
                ->insert([
                    'idempresa'      => "001",
                    'estado'         => $estado,
                    'idcliente'      => $codigo,
                    'nombres'        => ($request['comment'.$i] == "undefined" )? $request['name'.$i] : $request['comment'.$i],
                    'forma_pago'     => (empty($request->p_forma_pago)) ? null : $request->p_forma_pago,
                    'doc_venta'      => (empty($request->p_doc_venta)) ? null : $request->p_doc_venta,
                    'moneda'         => (empty($request->p_moneda)) ? null : $request->p_moneda,
                    'dia_pago'       => (empty($request->p_dia_pago)) ? null : strval($request->p_dia_pago),
                    'idpersonal'     => Auth::user()->id,
                    'razon_social'   => ($request['comment'.$i] == "undefined")? $request['name'.$i] : $request['comment'.$i],
                    'facturacion'    => $request->fecha_factura,
                    'formulario'     => 'FORM_IMPORTEXPORTCLIENTES',
                    'glosa'          => (empty($request->p_glosa)) ? null : $p_request->glosa,
                    'fecha_creacion' => date('Y-m-d h:m:s'),
                ]);


                $perfiles = DB::table('perfiles')->where('name',$request['profile'.$i])->get();
                $idperfil = null;
                $precio = null;
                //dd($perfiles);
                foreach ($perfiles as $val) {
                    $idperfil = $val->idperfil;
                    $precio = $val->precio;
                }
                
                //----------Creación de los servicios de internet-----------------
                
                DB::table('servicio_internet')
                ->insert([
                    'idempresa'         => '001',
                    'idservicio'        => $key->codigoN(10),
                    'estado'            => $estado,
                    'idrouter'          => $request->id_router,
                    'tipo_acceso'       => 'PPP',
                    'ip'                => $request['remote-address'.$i],
                    'perfil_internet'   => $idperfil,
                    'usuario_cliente'   => $request['name'.$i],
                    'contrasena_cliente' => $request['password'.$i],
                    'dia_pago'          => strval($request->p_dia_pago),
                    'precio'            => (is_null($request['precio'.$i]))? $precio : $request['precio'.$i],
                    'glosa'             => $request->p_glosa,               
                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'idcliente'         => $codigo
                ]);

                $estado = 0;


                //-------------Crear Notificaciones------------------------------
                $servicio = DB::table('servicio_internet')->where('idcliente',$codigo)->get();
                
                $fecha = Carbon::now();            
                $fecha->day = $request->p_dia_pago;
                $fecha_fin = Carbon::now();            
                $fecha_fin->day = $request->p_dia_pago - 1;
                $fecha_fin->addMonth();

                $dia_pago = Carbon::now()->addMonth()->day($request->p_dia_pago);
                $fecha_aviso = Carbon::now()->addMonth()->day($request->p_dia_pago)->subDays($request->p_aviso);
                $fecha_corte = Carbon::now()->addMonth()->day($request->p_dia_pago)->addDays($request->p_corte);
                $fecha_facturacion = Carbon::now()->addMonth()->day($request->p_fecha_factura);
                $fecha_frecuencia = Carbon::now()->day($request->p_dia_pago)->addMonths($request->p_frecuencia+1);   

                foreach ($servicio as $value) {

                    DB::table('notificaciones')
                    ->insert([
                        'idempresa'         => '001',
                        'aviso'             => $request->p_aviso,
                        'corte'             => $request->p_corte,
                        'frecuencia'        => $request->p_frecuencia,
                        'facturacion'       => $request->p_fecha_factura,
                        'fecha_creacion'    => date('Y-m-d h:m:s'),
                        'fecha_pago'        => $dia_pago,
                        'fecha_aviso'       => $fecha_aviso,
                        'fecha_corte'       => $fecha_corte,
                        'idservicio'        => $value->idservicio,
                        'fecha_inicio'      => $fecha->format('Y-m-d'),
                        'fecha_fin'         => $fecha_fin->format('Y-m-d'),
                        'fecha_facturacion' => $fecha_facturacion
                    ]);
                }
                }
            }
        } 

        return response()->json(array('valor' => 'CONFORME'));        
    }

    //-------------------------------------GUARDAR CLIENTES IMPORTADOS DESDE QUEUES SIMPLES---------------------------------
    public function guardarImportQUEUES(Request $request)
    {
        //dd($request);
        $key = new MaestroController();
        $codigo = null;
        $cont = $request->contQUEUES;
        $estado = 0;

        for ($i=0; $i <= $cont; $i++) {
           
            if (!is_null($request['check'.$i])) { 
                if (count(DB::table('servicio_internet')->where('usuario_cliente', $request['name'.$i])->get()) == 0) { 

                $codigo = $key->codigoN(10);
                if ($request['disabled'.$i] == "false") {
                    $estado = 1;
                }
                //-------------------Creacion de los clientes------------------
                DB::table('clientes')
                ->insert([
                    'idempresa'      => "001",
                    'estado'         => $estado,
                    'idcliente'      => $codigo,
                    'nombres'        => $request['name'.$i],
                    'forma_pago'     => (empty($request->q_forma_pago)) ? null : $request->q_forma_pago,
                    'doc_venta'      => (empty($request->q_doc_venta)) ? null : $request->q_doc_venta,
                    'moneda'         => (empty($request->q_moneda)) ? null : $request->q_moneda,
                    'dia_pago'       => (empty($request->q_dia_pago)) ? null : strval($request->q_dia_pago),
                    'idpersonal'     => Auth::user()->id,
                    'razon_social'   => $request['name'.$i],
                    'facturacion'    => $request->fecha_factura,
                    'formulario'     => 'FORM_IMPORTEXPORTCLIENTES',
                    'glosa'          => (empty($request->q_glosa)) ? null : $q_request->glosa,
                    'fecha_creacion' => date('Y-m-d h:m:s'),
                ]);

                $alm = array(1 => 'k', 2 => 'M', 3 => 'G');

                $up = strval(substr($request['max-limit'.$i], 0, strpos($request['max-limit'.$i], '/')));
                $down = strval(substr($request['max-limit'.$i], strpos($request['max-limit'.$i], '/')+1, strlen($request['max-limit'.$i])));
                //$up = $up/1000;
                //$down = ($down/1000)/1000;   
                

                for ($a=0; $a < 3; $a++) { 
                    if (strlen($up) > 3) {
                        $up = $up/1000;
                    }else{
                        $up = $up.$alm[$a];
                        break;
                    }
                }

                for ($a=0; $a < 3; $a++) { 
                    if (strlen($down) > 3) {
                        $down = $down/1000;
                    }else{
                        $down = $down.$alm[$a];
                        break;
                    }
                }
                $target = $up.'/'.$down;

                $perfiles = DB::table('perfiles')->where('target',$target)->get();    

                if(count($perfiles) == 0){
                    DB::table('perfiles')
                    ->insert([
                        'idempresa'         => '001',
                        'estado'            => 1,
                        'idrouter'          => $request->q_id_router,
                        'name'              => "PLAN INNOVATEC ".$target,
                        'precio'            => $request['precio'.$i],
                        'vsubida'           => $up,
                        'vbajada'           => $down,
                        'target'            => $target,
                        'idtipo'            => 'QUE',        
                        'fecha_creacion'    => date('Y-m-d h:m:s')
                    ]);

                    $perfiles = DB::table('perfiles')->where('target',$target)->get();    
                }
                
                $idperfil = null;
                $precio = null;
                //dd($perfiles);
                foreach ($perfiles as $val) {
                    $idperfil = $val->idperfil;
                    $precio = $val->precio;
                }
                
                //----------Creación de los servicios de internet-----------------
                
                DB::table('servicio_internet')
                ->insert([
                    'idempresa'         => '001',
                    'idservicio'        => $key->codigoN(10),
                    'estado'            => $estado,
                    'idrouter'          => $request->q_id_router,
                    'tipo_acceso'       => 'QUE',
                    'perfil_internet'   => $idperfil,
                    'usuario_cliente'   => $request['name'.$i],
                    'ip'                => $request['target'.$i],
                    'dia_pago'          => strval($request->q_dia_pago),
                    'precio'            => (is_null($request['precio'.$i]))? $precio : $request['precio'.$i],
                    'glosa'             => $request->q_glosa,               
                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'idcliente'         => $codigo
                ]);

                $estado = 0;


                //-------------Crear Notificaciones------------------------------
                $servicio = DB::table('servicio_internet')->where('idcliente',$codigo)->get();
                
                $fecha = Carbon::now();            
                $fecha->day = $request->q_dia_pago;
                $fecha_fin = Carbon::now();            
                $fecha_fin->day = $request->q_dia_pago - 1;
                $fecha_fin->addMonth();

                $dia_pago = Carbon::now()->addMonth()->day($request->q_dia_pago);
                $fecha_aviso = Carbon::now()->addMonth()->day($request->q_dia_pago)->subDays($request->q_aviso);
                $fecha_corte = Carbon::now()->addMonth()->day($request->q_dia_pago)->addDays($request->q_corte);
                $fecha_facturacion = Carbon::now()->addMonth()->day($request->q_fecha_factura);
                $fecha_frecuencia = Carbon::now()->day($request->q_dia_pago)->addMonths($request->q_frecuencia+1);   

                foreach ($servicio as $value) {

                    DB::table('notificaciones')
                    ->insert([
                        'idempresa'         => '001',
                        'aviso'             => $request->q_aviso,
                        'corte'             => $request->q_corte,
                        'frecuencia'        => $request->q_frecuencia,
                        'facturacion'       => $request->q_fecha_factura,
                        'fecha_creacion'    => date('Y-m-d h:m:s'),
                        'fecha_pago'        => $dia_pago,
                        'fecha_aviso'       => $fecha_aviso,
                        'fecha_corte'       => $fecha_corte,
                        'idservicio'        => $value->idservicio,
                        'fecha_inicio'      => $fecha->format('Y-m-d'),
                        'fecha_fin'         => $fecha_fin->format('Y-m-d'),
                        'fecha_facturacion' => $fecha_facturacion
                    ]);
                }
                }
            }
        } 

        return response()->json(array('valor' => 'CONFORME'));        
    }

    //-------------------------------------GUARDAR CLIENTES IMPORTADOS DESDE PPPoE---------------------------------
    public function guardarImportPCQ(Request $request)
    {
        //dd($request);
        $key = new MaestroController();
        $codigo = null;
        $cont = $request->cont;
        $estado = 0;
        
        for ($i=0; $i <= $cont; $i++) {
            
            $perfil = DB::table('perfiles')->where('idperfil',$request['idperfil'.$i])->get();
        
            if (!is_null($request['check'.$i])) { 
                if (count(DB::table('servicio_internet')->where('usuario_cliente', $request['comment'.$i])->get()) == 0 and count($perfil) > 0) { 

                $codigo = $key->codigoN(10);
                if ($request['disabled'.$i] == "false") {
                    $estado = 1;
                }
                //-------------------Creacion de los clientes------------------
                DB::table('clientes')
                ->insert([
                    'idempresa'      => "001",
                    'estado'         => $estado,
                    'idcliente'      => $codigo,
                    'nombres'        => ($request['comment'.$i] == "undefined" )? $request['name'.$i] : $request['comment'.$i],
                    'forma_pago'     => (empty($request->pcq_forma_pago)) ? null : $request->pcq_forma_pago,
                    'doc_venta'      => (empty($request->pcq_doc_venta)) ? null : $request->pcq_doc_venta,
                    'moneda'         => (empty($request->pcq_moneda)) ? null : $request->pcq_moneda,
                    'dia_pago'       => (empty($request->pcq_dia_pago)) ? null : strval($request->pcq_dia_pago),
                    'idpersonal'     => Auth::user()->id,
                    'razon_social'   => ($request['comment'.$i] == "undefined")? $request['name'.$i] : $request['comment'.$i],
                    'facturacion'    => $request->fecha_factura,
                    'formulario'     => 'FORM_IMPORTEXPORTCLIENTES',
                    'glosa'          => (empty($request->pcq_glosa)) ? null : $pcq_request->glosa,
                    'fecha_creacion' => date('Y-m-d h:m:s'),
                ]);


                $perfiles = DB::table('perfiles')->where('name',$request['profile'.$i])->get();
                $idperfil = null;
                $precio = null;
                //dd($perfiles);
                foreach ($perfiles as $val) {
                    $idperfil = $val->idperfil;
                    $precio = $val->precio;
                }
                
                //----------Creación de los servicios de internet-----------------
                
                DB::table('servicio_internet')
                ->insert([
                    'idempresa'         => '001',
                    'idservicio'        => $key->codigoN(10),
                    'estado'            => $estado,
                    'idrouter'          => $request->id_router,
                    'tipo_acceso'       => 'PCQ',
                    'ip'                => $request['address'.$i],
                    'perfil_internet'   => $idperfil,
                    'dia_pago'          => strval($request->pcq_dia_pago),
                    'precio'            => (is_null($request['precio'.$i]))? $precio : $request['precio'.$i],
                    'glosa'             => $request->pcq_glosa,               
                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'idcliente'         => $codigo
                ]);

                $estado = 0;


                //-------------Crear Notificaciones------------------------------
                $servicio = DB::table('servicio_internet')->where('idcliente',$codigo)->get();
                
                $fecha = Carbon::now();            
                $fecha->day = $request->pcq_dia_pago;
                $fecha_fin = Carbon::now();            
                $fecha_fin->day = $request->pcq_dia_pago - 1;
                $fecha_fin->addMonth();

                $dia_pago = Carbon::now()->addMonth()->day($request->pcq_dia_pago);
                $fecha_aviso = Carbon::now()->addMonth()->day($request->pcq_dia_pago)->subDays($request->pcq_aviso);
                $fecha_corte = Carbon::now()->addMonth()->day($request->pcq_dia_pago)->addDays($request->pcq_corte);
                $fecha_facturacion = Carbon::now()->addMonth()->day($request->pcq_fecha_factura);
                $fecha_frecuencia = Carbon::now()->day($request->pcq_dia_pago)->addMonths($request->pcq_frecuencia+1);   

                foreach ($servicio as $value) {

                    DB::table('notificaciones')
                    ->insert([
                        'idempresa'         => '001',
                        'aviso'             => $request->pcq_aviso,
                        'corte'             => $request->pcq_corte,
                        'frecuencia'        => $request->pcq_frecuencia,
                        'facturacion'       => $request->pcq_fecha_factura,
                        'fecha_creacion'    => date('Y-m-d h:m:s'),
                        'fecha_pago'        => $dia_pago,
                        'fecha_aviso'       => $fecha_aviso,
                        'fecha_corte'       => $fecha_corte,
                        'idservicio'        => $value->idservicio,
                        'fecha_inicio'      => $fecha->format('Y-m-d'),
                        'fecha_fin'         => $fecha_fin->format('Y-m-d'),
                        'fecha_facturacion' => $fecha_facturacion
                    ]);
                }
                }
            }
        } 

        return response()->json(array('valor' => 'CONFORME'));        
    }
    //-------------------------------------GUARDAR CLIENTES IMPORTADOS DESDE HOTSPOT---------------------------------
    public function guardarImportHotspot(Request $request)
    {
        //dd($request);
        $key = new MaestroController();
        $codigo = null;
        $cont = $request->cont;
        $estado = 0;
        
        for ($i=0; $i <= $cont; $i++) {
           // dd($request['name'.$i]);
            $perfil = DB::table('perfiles')->where('idperfil',$request['idperfil'.$i])->get();
        
            if (!is_null($request['check'.$i])) { 
                if (count(DB::table('servicio_internet')->where('usuario_cliente', $request['comment'.$i])->get()) == 0 and count($perfil) > 0) { 
                //dd('entro');
                $codigo = $key->codigoN(10);
                if ($request['disabled'.$i] == "false") {
                    $estado = 1;
                }
                //-------------------Creacion de los clientes------------------
                DB::table('clientes')
                ->insert([
                    'idempresa'      => "001",
                    'estado'         => $estado,
                    'idcliente'      => $codigo,
                    'nombres'        => ($request['comment'.$i] == "Sin Descripción" )? $request['name'.$i] : $request['comment'.$i],
                    'forma_pago'     => (empty($request->hst_forma_pago)) ? null : $request->hst_forma_pago,
                    'doc_venta'      => (empty($request->hst_doc_venta)) ? null : $request->hst_doc_venta,
                    'moneda'         => (empty($request->hst_moneda)) ? null : $request->hst_moneda,
                    'dia_pago'       => (empty($request->hst_dia_pago)) ? null : strval($request->hst_dia_pago),
                    'idpersonal'     => Auth::user()->id,
                    'razon_social'   => ($request['comment'.$i] == "Sin Descripción")? $request['name'.$i] : $request['comment'.$i],
                    'facturacion'    => $request->fecha_factura,
                    'formulario'     => 'FORM_IMPORTEXPORTCLIENTES',
                    'glosa'          => (empty($request->hst_glosa)) ? null : $hst_request->glosa,
                    'fecha_creacion' => date('Y-m-d h:m:s'),
                ]);


                $perfiles = DB::table('perfiles')->where('name',$request['profile'.$i])->get();
                $idperfil = null;
                $precio = null;
                //dd($perfiles);
                foreach ($perfiles as $val) {
                    $idperfil = $val->idperfil;
                    $precio = $val->precio;
                }
                
                //----------Creación de los servicios de internet-----------------
                
                DB::table('servicio_internet')
                ->insert([
                    'idempresa'         => '001',
                    'idservicio'        => $key->codigoN(10),
                    'estado'            => $estado,
                    'idrouter'          => $request->id_router,
                    'tipo_acceso'       => 'HST',
                    'perfil_internet'   => $idperfil,
                    'usuario_cliente'   => $request['name'.$i],
                    'contrasena_cliente' => $request['password'.$i],
                    'dia_pago'          => strval($request->hst_dia_pago),
                    'precio'            => (is_null($request['precio'.$i]))? $precio : $request['precio'.$i],
                    'glosa'             => $request->hst_glosa,               
                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'idcliente'         => $codigo
                ]);

                $estado = 0;


                //-------------Crear Notificaciones------------------------------
                $servicio = DB::table('servicio_internet')->where('idcliente',$codigo)->get();
                
                $fecha = Carbon::now();            
                $fecha->day = $request->hst_dia_pago;
                $fecha_fin = Carbon::now();            
                $fecha_fin->day = $request->hst_dia_pago - 1;
                $fecha_fin->addMonth();

                $dia_pago = Carbon::now()->addMonth()->day($request->hst_dia_pago);
                $fecha_aviso = Carbon::now()->addMonth()->day($request->hst_dia_pago)->subDays($request->hst_aviso);
                $fecha_corte = Carbon::now()->addMonth()->day($request->hst_dia_pago)->addDays($request->hst_corte);
                $fecha_facturacion = Carbon::now()->addMonth()->day($request->hst_fecha_factura);
                $fecha_frecuencia = Carbon::now()->day($request->hst_dia_pago)->addMonths($request->hst_frecuencia+1);   

                foreach ($servicio as $value) {

                    DB::table('notificaciones')
                    ->insert([
                        'idempresa'         => '001',
                        'aviso'             => $request->hst_aviso,
                        'corte'             => $request->hst_corte,
                        'frecuencia'        => $request->hst_frecuencia,
                        'facturacion'       => $request->hst_fecha_factura,
                        'fecha_creacion'    => date('Y-m-d h:m:s'),
                        'fecha_pago'        => $dia_pago,
                        'fecha_aviso'       => $fecha_aviso,
                        'fecha_corte'       => $fecha_corte,
                        'idservicio'        => $value->idservicio,
                        'fecha_inicio'      => $fecha->format('Y-m-d'),
                        'fecha_fin'         => $fecha_fin->format('Y-m-d'),
                        'fecha_facturacion' => $fecha_facturacion
                    ]);
                }
                }
            }
        } 

        return response()->json(array('valor' => 'CONFORME'));        
    }

    //-------------------------------------------------------IP POOL------------------------------------------------------------------
    public function pool()
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
        
        $pool = DB::table('ip_pool')->get();
        $router = DB::table('router')->get();

        return view('forms.poolIp.lstPool', [
                    'pool'          => $pool,
                    'router'        => $router,
                    'valida'        => $valida
                ]);
    }

    public function storePool(Request $request)
    {
        //dd($request);
        $rules = array(            
            'descripcion'       => 'required',
            'idrouter'          => 'required',
            'ip_inicial'        => 'required',
            'ip_final'          => 'required'
        );

        $key = new MaestroController();
        $idfichas = $key->codigoN(10);  

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            $perfil = null;
            $perfiles = DB::table('perfiles')->where('idtipo','HST')->get();
            
            DB::table('ip_pool')
            ->insert([
                'estado'            => 1,
                'idrouter'          => $request->idrouter,
                'descripcion'       => $request->descripcion,
                'ip_inicial'        => $request->ip_inicial,
                'ip_final'          => $request->ip_final,
                'glosa'             => $request->glosa, 
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);
           
            
            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
            
            return response()->json($collection->toJson());        
        }         
            
    }

    public function updPool(Request $request)
    {
        //dd($request);
        $rules = array(      
            'idrouter'          => 'required',
            'descripcion'       => 'required',
            'ip_inicial'        => 'required',
            'ip_final'          => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('ip_pool')
            ->where('codigo',$request->codigo)
            ->update([
                'idrouter'          => $request->idrouter,
                'descripcion'       => $request->descripcion,
                'ip_inicial'        => $request->ip_inicial,
                'ip_final'          => $request->ip_final,
                'glosa'             => $request->glosa
            ]);

                            
            return response()->json(array('valor' => 'CONFORME'));   
        }
    }

    public function destroyPool(Request $request)
    {
        DB::table('ip_pool')
            ->where('codigo',$request->codigo)->delete();

        return response()->json(array('valor' => 'CONFORME'));
    }
}

