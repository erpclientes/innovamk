<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;
use Image;
use Carbon\Carbon;

class PagosController extends Controller
{
    public function index()
    {
        $valida = 0;
        $idcliente = null;

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

        $factura = DB::table('factura')->whereIn('idestado',['EM','PV'])->get();
        $doc_venta = DB::table('documento_venta')->where('estado',1)->get();

        foreach ($factura as $value) {
            $idcliente = $value->idcliente;
        }

        $cliente = DB::table('clientes')->get();

        return view('forms.pagos.lstPagos', [
            'factura'       => $factura,
            'valida'        => $valida,
            'doc_venta'     => $doc_venta,
            'cliente'       => $cliente
        ]);
    }

    public function show($id)
    {        
        $idcliente = null;
        $idservicio = null;

        $factura = DB::table('factura')->where('codigo', $id)->get();
        $doc_venta = DB::table('documento_venta')->where('estado',1)->get();
        $documento = DB::table('documento')->where('estado',1)->get();
        $forma_pagos = DB::table('forma_pagos')->where('estado',1)->get();
        $moneda = DB::table('tipo_moneda')->where('estado',1)->get();
        $perfiles = DB::table('perfiles')->where('estado',1)->get();
        $notificaciones = DB::table('notificaciones')->get();
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['FACTURACION'])
            ->where('estado',1)->get();

        foreach ($factura as $value) {
            $idcliente = $value->idcliente;
        }

        $cliente = DB::table('clientes')->where('idcliente',$idcliente)->get();
        $servicio = DB::table('servicio_internet')->where('idcliente',$idcliente)->get();
        $dfactura = DB::table('dfactura')->where('idfactura',$id)->get();

        if(Auth::user()->idtipo == 'CLE'){
            return view('clientes.pagos.vwComprobante',[
                'factura'       => $factura,
                'cliente'       => $cliente,
                'doc_venta'     => $doc_venta,
                'documento'     => $documento,
                'forma_pagos'   => $forma_pagos,
                'moneda'        => $moneda,
                'servicio'      => $servicio,
                'perfiles'      => $perfiles,
                'notificaciones' => $notificaciones,
                'parametros'    => $parametros,
                'dfactura'      => $dfactura
            ]);
        }

        return view('forms.pagos.viewPagos',[
            'factura'       => $factura,
            'cliente'       => $cliente,
            'doc_venta'     => $doc_venta,
            'documento'     => $documento,
            'forma_pagos'   => $forma_pagos,
            'moneda'        => $moneda,
            'servicio'      => $servicio,
            'perfiles'      => $perfiles,
            'notificaciones' => $notificaciones,
            'parametros'    => $parametros,
            'dfactura'      => $dfactura
        ]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $idfactura = $request->idfactura;
        $idcliente = null;
        $idservicio = null;
        $nombre = null;
        $usuario_cliente = null;
        $contrasena_cliente = null;
        $ip = null;
        $tipo_acceso = null;
        $idrouter = null;
        $idperfil = null;
        $target = null;
        $rate_limit = null;

        $factura = DB::table('factura')->where('codigo',$request->idfactura)->get();   
        foreach ($factura as $val) {
            $idcliente = $val->idcliente;
            $idservicio = $val->idservicio;            
        }

        $servicio = DB::table('servicio_internet')->where('idservicio',$idservicio)->get();
        foreach ($servicio as $val) {
            $tipo_acceso = $val->tipo_acceso;
            $idrouter = $val->idrouter;
            $idperfil = $val->perfil_internet;
            $usuario_cliente = $val->usuario_cliente;
            $contrasena_cliente = $val->contrasena_cliente;
            $ip = $val->ip;
        }

        $cliente = DB::table('clientes')->where('idcliente',$idcliente)->get();
        foreach ($cliente as $val) {
            $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
        }

        $subtotal_neto = $request->subtotal - $request->descuento;
        $total = $subtotal_neto - $request->impuesto;


        //--Se actualiza la factura con estado Pagado y se guarda la fecha
       DB::table('factura')
            ->where('codigo',$idfactura)
            ->update([
                'idestado'      => 'PA',
                'descuento'     => $request->descuento,
                'subtotal_neto' => $subtotal_neto,
                'total'         => $total,
                'glosa'         => $request->descripcion,
                'fecha_pago'    => date('Y-m-d h:m:s'),
                'idusuario_registro_pago' => Auth::user()->id
        ]);
       
       
        $router = DB::table('router')->where('idrouter',$idrouter)->get();
     
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $perfil = DB::table('perfiles')->where('idperfil',$idperfil)->get();
 
                foreach ($perfil as $val) {   

                    //--ELiminar los usuarios antiguos del Mikrotik
                        if( trim($tipo_acceso) == "HST" ){     
                            $ARRAY = $API->comm("/ip/hotspot/user/print");

                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $usuario) {
                                    $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                          
                                }
                            }              
                        }else if(trim($tipo_acceso) == "QUE"){
                            $ARRAY = $API->comm("/queue/simple/print");

                            foreach ($ARRAY as $value) {
                                if ($value['name'] == $nombre) {
                                    $ARRAY = $API->comm("/queue/simple/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }                           
                        }else if(trim($tipo_acceso) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");

                            foreach ($ARRAY as $value) {
                                if (isset($value['address'])  and $value['address'] == $ip) {
                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                          
                                }
                            }               
                        }else if(trim($tipo_acceso) == "PPP"){
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
                        if( trim($tipo_acceso) == "HST" ){ 
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
                        }else if(trim($tipo_acceso) == "QUE"){
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
                                "target"    => $ip,  
                                "max-limit" => $val->target  
                            ));                                
                        }else if(trim($tipo_acceso) == "PCQ"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");

                            foreach ($ARRAY as $value) {
                                if (isset($value['address'])  and $value['address'] == $ip) {
                                    $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                        ".id"       => $value['.id']  
                                    ));                                                                         
                                }
                            }                 

                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => $val->address_list,
                                "address"   => $ip,
                                "comment"   => $nombre
                            )); 
                        }else if(trim($tipo_acceso) == "PPP"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/print");

                            foreach ($ARRAY as $value) {
                                if ($value['comment'] == $request->usuario_cliente) {
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
                                    "remote-address" => $ip
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
                                    "remote-address" => $ip
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

                        $ARRAY = $API->comm("/ip/proxy/access/print");

                        foreach ($ARRAY as $value) {  
                            if (isset($value['src-address']) and $value['src-address'] == $ip) {
                             
                                $ARRAY = $API->comm("/ip/proxy/access/remove", array(
                                    ".id"       => $value['.id']
                                ));                                            
                            }
                        }
                   
                
                        $ARRAY = $API->comm("/ip/firewall/address-list/print");

                        foreach ($ARRAY as $value) {  
                            if ($value['address'] == $ip and $value['list'] == 'Notificacion::InnovaTec') {

                                $ARRAY = $API->comm("/ip/firewall/address-list/remove", array(
                                    ".id"       => $value['.id']
                                ));                                            
                            }
                        } 

                        

                        DB::table('servicio_internet')
                        ->where('idservicio',$idservicio)
                        ->update([
                            'activar_notificacion'    => 0
                        ]);                                      
                }
                
            }       
        }        
    }

    public function lstReporte()
    {
        $valida = 0;
        $total = 0;

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

        $facturas = DB::table('factura')->whereIn('idestado',['NI'])->get();
        $router = DB::table('router')->where('activo',1)->get();
        $formaPago = DB::table('forma_pagos')->where('estado',1)->get();

        return view('forms.pagos.rptPagos', [
            'facturas'       => $facturas,
            'router'       => $router,
            'formaPago'       => $formaPago,
            'total'       => $total,
            'valida'       => $valida
        ]);
    }

    public function reportePagos(Request $req)
    {
        //dd($req);
        $idrouter = $req->idrouter;
        $from = Carbon::createFromFormat('d/m/Y', $req->from);
        $to = Carbon::createFromFormat('d/m/Y', $req->to);
        $from = $from->subDay(1);
        $to = $to->addDay(1);
        $tipoPago = $req->idforma_pago;
        $valida = 0;
        $total = 0;

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

        $facturas = DB::table('factura as fac')
            ->select('s.idrouter','s.idservicio','fac.codigo','d.dsc_corta','fac.serie','fac.numero','c.razon_social','s.precio','p.name','fac.fecha_pago as fecha_pagado','n.fecha_pago','fac.idestado')
            ->leftjoin('servicio_internet as s','s.idservicio','fac.idservicio')
            ->leftjoin('clientes as c','c.idcliente','s.idcliente')
            ->leftjoin('perfiles as p','p.idperfil','s.perfil_internet')
            ->leftjoin('forma_pagos as f','f.idforma_pago','fac.idforma_pago')
            ->leftjoin('notificaciones as n','n.idservicio','s.idservicio')
            ->leftjoin('documento_venta as d','d.iddocumento','fac.iddocumento')
            ->whereBetween('fac.fecha_pago', array($from, $to))
            ->where('fac.idestado','PA')
            ->get();

        //dd($facturas);
        $router = DB::table('router')->where('activo',1)->get();
        $formaPago = DB::table('forma_pagos')->where('estado',1)->get();

        foreach ($facturas as $val) {
            $total = $total + $val->precio;
        }

        return view('forms.pagos.rptPagos', [
            'facturas'       => $facturas,
            'router'       => $router,
            'formaPago'       => $formaPago,
            'total'       => $total,
            'valida'       => $valida
        ]);
    }

    //-----------------------------------cPANEL CLIENTES-------------------------------------
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


        $comprobantes = DB::table('factura as f')
            ->select('f.*')
            ->leftjoin('clientes as c', 'c.nro_documento', '=', 'f.idcliente')    
            ->where(['c.idcliente' => Auth::user()->idcliente,])
            ->whereIn('f.idestado', ['EM','PV'])
            ->get();
        $forma_pagos = DB::table('forma_pagos')
            ->select('idforma_pago', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $tipo_documento_venta = DB::table('documento_venta')
            ->where('estado', '1')
            ->get();
        $clientes = DB::table('clientes')
            ->where('idcliente', Auth::user()->idcliente)->get();
        //dd($comprobantes,Auth::user()->nro_documento);
        
        return view('clientes.pagos.lstComprobantes', [
            'comprobantes'          => $comprobantes,
            'forma_pagos'           => $forma_pagos,
            'tipo_documento_venta'  => $tipo_documento_venta,
            'clientes'              => $clientes,
            'valida'                => $valida
        ]);
    }

    public function imgUpdate(Request $request)
    {
        //dd($request);
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();
        
        $file = $request->file('imagenURL');
        //dd($file);

        if ($file != null) {
            $extension = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $path = public_path('images/'.$fileName);
            //dd( $fileName);
            Image::make($file)->save($path);


            DB::table('factura')     
            ->where('codigo',$request->id)
            ->update([      
                'url_imagen'        => 'images/'.$fileName,
                'imagen'            => $fileName,
                'idestado'          => 'PV',
                'glosa'             => ''
            ]);
        }
        
        if (count($validacion) > 0) {           
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 2]);  
        }

        $carrito = DB::table('factura')->where('codigo',$request->id)->get();

        
        $data['success'] = $carrito;
        //$data['path'] = 'images/carrusel/'.$fileName . '?' . uniqid();

        return $data;
    }

    public function rechazar(Request $request)
    {         
        //dd($request);
        $rules = array(      
            'observacion'        => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('factura')
            ->where('codigo',$request->id)
            ->update([
                'glosa'        => $request->observacion,
                'idestado'     => 'EM'
            ]);

            
            $carrito = DB::table('factura')->where('codigo',$request->id)->get();
            $collection = Collection::make($carrito);
                
            return response()->json($collection->toJson());   
        }
        
    }

    public function aceptar(Request $request)
    {   
        //dd($request);          
        DB::table('factura')
            ->where('codigo',$request->idfactura)
            ->update([
                'idestado'      => 'PA',
                'glosa'         => '',
                'fecha_pago'    => date('Y-m-d h:m:s')
        ]);

        $pedido = DB::table('factura')->where('codigo',$request->idfactura)->get();
        $collection = Collection::make($pedido);
                
        return response()->json($collection->toJson());   
    }

    public function historial()
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


        $comprobantes = DB::table('factura as f')
            ->select('f.*')
            ->leftjoin('clientes as c', 'c.nro_documento', '=', 'f.idcliente')    
            ->where(['c.idcliente' => Auth::user()->idcliente])
            ->whereIn('f.idestado', ['AN','PA'])
            ->get();
        $forma_pagos = DB::table('forma_pagos')
            ->select('idforma_pago', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $tipo_documento_venta = DB::table('documento_venta')
            ->where('estado', '1')
            ->get();
        $clientes = DB::table('clientes')
            ->where('idcliente', Auth::user()->idcliente)->get();
        //dd($comprobantes,Auth::user()->nro_documento);
        
        return view('clientes.pagos.lstHistorial', [
            'comprobantes'          => $comprobantes,
            'forma_pagos'           => $forma_pagos,
            'tipo_documento_venta'  => $tipo_documento_venta,
            'clientes'              => $clientes,
            'valida'                => $valida
        ]);
    }
}


