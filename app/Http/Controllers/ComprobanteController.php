<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Response;
use Carbon\Carbon;
use DateTime;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\Comprobante;

class ComprobanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function plantilla($id)
    {
        $idservicio = null;      
        $idcliente = null;
        $factura = DB::table('factura as f')
            ->select('f.*','d.dsc_corta')
            ->leftjoin('documento_venta as d','f.iddocumento','=','d.iddocumento')
            ->where('f.codigo', $id)->get();
    
        foreach ($factura as $val) {
            $idservicio = $val->idservicio;
            $idcliente = $val->idcliente;
        }

        $cliente = DB::table('clientes')->where('idcliente', $idcliente)->get();
        $servicio = DB::table('servicio_internet')->where('idservicio', $idservicio)->get();
        $notificaciones = DB::table('notificaciones')->where('idservicio', $idservicio)->get();
        $empresa = DB::table('empresa')->get();
        $dfactura = DB::table('dfactura')->where('idfactura',$id)->get();

        return view('forms.comprobante.PDF.plantilla', compact('factura','cliente','servicio','notificaciones','empresa','dfactura'));
    }

    public function pdf($id)
    {    
        
        
        $idservicio = null;      
        $idcliente = null;
        $factura = DB::table('factura as f')
            ->select('f.*','d.dsc_corta','d.descripcion')
            ->leftjoin('documento_venta as d','f.iddocumento','=','d.iddocumento')
            ->where('f.codigo', $id)->get();
    
        foreach ($factura as $val) {
            $idservicio = $val->idservicio;
            $idcliente = $val->idcliente;
            $idusuario=$val->idusuario;
        } 
        $usuario = DB::table('users')
                    ->where('id', $idusuario)->get();
        //dd($usuario);
        $cliente = DB::table('clientes')->where('idcliente', $idcliente)->get();
        $servicio = DB::table('servicio_internet')->get();
        $notificaciones = DB::table('notificaciones')->where('idservicio', $idservicio)->get();
        $empresa = DB::table('empresa as e')
            ->leftjoin('clientes as c','c.idempresa','=','e.idempresa')
            ->where('c.idcliente',$idcliente)
            ->get();
        //dd($cliente);
        $dfactura = DB::table('dfactura')->where('idfactura',$id)->get();
        $comprobante = null;
        $planes = DB::table('perfiles')->get();
        $equipos = DB::table('equipos')->get();  

        foreach ($factura as $value) {
            $comprobante = $value->dsc_corta.$value->serie.$value->numero.'.pdf';
        }


        $pdf = PDF::loadView('forms.comprobante.PDF.plantillaBoleta', compact('factura','cliente','servicio','notificaciones','empresa','dfactura','usuario','planes','equipos'));

        //return $pdf->download(''.$comprobante.'');
        return $pdf->stream(''.$comprobante.'');
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

    public function codigo(){
        $key = '';

        $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
        $length = 10;
        $max = strlen($caracteres) - 1;

        for ($i=0;$i<$length;$i++) {
            $key .= substr($caracteres, rand(0, $max), 1);
        }

        return $key;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCliente(Request $request)
    {
       // dd($request);
        $rules = array(            
            'fecha_emision'         => 'required',
            'fecha_vencimiento'     => 'required',
            'precio_unitario'       => 'required',
            'descripcion'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            $fecha = Carbon::now(); 

            $key = '';
            $serie = null;
            $numero = null;        

            $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
            $length = 10;
            $max = strlen($caracteres) - 1;

            for ($i=0;$i<$length;$i++) {
                $key .= substr($caracteres, rand(0, $max), 1);
            }

            $doc_venta = DB::table('documento_venta')->where('estado',1)->get();

            foreach ($doc_venta as $val) {
                if ($val->iddocumento == $request->iddocumento) {
                    $serie = $val->serie;
                    $numero = $val->correlativo;    
                }
            }
        
           
            DB::table('factura')
            ->insert([  
                'codigo'            => $key,
                'idempresa'         => '001',
                'idestado'          => 'EM',
                'periodo'           => $fecha,
                'fecha_emision'     => Carbon::createFromFormat('d/m/Y',$request->fecha_emision),
                'fecha_vencimiento' => Carbon::createFromFormat('d/m/Y',$request->fecha_vencimiento),
                'idcliente'         => $request->idcliente,
                'idservicio'        => $request->idservicio,
                'formulario'        => 'COMPROBANTE_CLIENTE_ADDCOMPROBANTE',
                'idusuario'         => (int) Auth::user()->id,
                'idmoneda'          => $request->idmoneda,  
                'idforma_pago'      => $request->idforma_pago,  
                'iddocumento'       => $request->iddocumento,       
                'serie'             => $serie,  
                'numero'            => str_pad($numero, 8, "0", STR_PAD_LEFT), 
                'costo_servicio'    => $request->subtotal, 
                'subtotal'          => $request->subtotal,  
                'descuento'         => $request->descuento,  
                'subtotal_neto'     => $request->subtotal_neto,  
                'impuesto'          => $request->impuesto,   
                'total'             => $request->total, 
                'detalle'           => $request->descripcion,
                'fecha_inicio'      => Carbon::createFromFormat('d/m/Y',$request->fecha_inicio),
                'fecha_fin'         => Carbon::createFromFormat('d/m/Y',$request->fecha_fin),
                'fecha_corte'       => Carbon::createFromFormat('d/m/Y',$request->fecha_corte),
                'perfil'            => $request->perfil,
                'vbajada'           => $request->vbajada,
                'vsubida'           => $request->vsubida,
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            DB::table('dfactura')
            ->insert([     
                'idfactura'         => $key,  
                'idservicio'        => $request->idservicio,
                'cantidad'          => 1,
                'precio'            => $request->subtotal,
                'descuento'         => $request->descuento,  
                'subtotal'          => $request->subtotal_neto,  
                'impuesto'          => $request->impuesto,   
                'total'             => $request->total, 
                'descripcion'       => $request->descripcion
            ]);

            $numero = $numero + 1;
            $numero = str_pad($numero, 8, "0", STR_PAD_LEFT);

            DB::table('documento_venta')
                ->where('iddocumento', $request->iddocumento)
                ->update(['correlativo' => $numero]);


        //---------------------Actualizar Notificaciones para proxima accion------------------
        $notificaciones = DB::table('notificaciones')->where('idservicio',$request->idservicio)->get();
        $fecha_pago = null;
        $fecha_aviso = null;
        $fecha_corte = null;
        $fecha_frecuencia = null;
        $fecha_facturacion = null;
        $fecha_inicio = null;
        $fecha_fin = null;

        foreach ($notificaciones as $val) {
            $fecha_pago = Carbon::parse($val->fecha_pago);
            $fecha_aviso = Carbon::parse($val->fecha_aviso);
            $fecha_corte = Carbon::parse($val->fecha_corte);
            $fecha_frecuencia = Carbon::parse($val->fecha_frecuencia);
            $fecha_facturacion = Carbon::parse($val->fecha_facturacion);
            $fecha_inicio = Carbon::parse($val->fecha_inicio);
            $fecha_fin = Carbon::parse($val->fecha_fin);
        }
        

        DB::table('notificaciones')
            ->where('idservicio',$request->idservicio)
            ->update([
                'fecha_pago'        => $fecha_pago->addMonth(),
                'fecha_aviso'       => $fecha_aviso->addMonth(),
                'fecha_corte'       => $fecha_corte->addMonth(),
                'fecha_frecuencia'  => $fecha_frecuencia->addMonth(),
                'fecha_facturacion' => $fecha_facturacion->addMonth(),
                'fecha_inicio'      => $fecha_inicio->addMonth(),
                'fecha_fin'         => $fecha_fin->addMonth()
            ]);            
            
                      
            return response()->json(array('valor' => 'CONFORME'));      
        }     
    }

    public function newComprobante(Request $request)
    {
        //dd($request);
        $rules = array(            
            'fecha_emision'         => 'required',
            'fecha_vencimiento'     => 'required',
            'idcomprobante'         => 'required',
            'precio'                => 'required',
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            $fecha = Carbon::now(); 

            $key = '';
            $serie = null;
            $numero = null;    
            $idmoneda = null;
            $idforma_pago = null;

            $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
            $length = 10;
            $max = strlen($caracteres) - 1;

            for ($i=0;$i<$length;$i++) {
                $key .= substr($caracteres, rand(0, $max), 1);
            }

            $doc_venta = DB::table('documento_venta')->where('estado',1)->get();
            $cliente = DB::table('clientes')->where('idcliente',$request->idcliente)->get();

            foreach ($doc_venta as $val) {
                if ($val->iddocumento == $request->idcomprobante) {
                    $serie = $val->serie;
                    $numero = $val->correlativo;    
                }
            }

            foreach ($cliente as $val) {
                $idmoneda = $val->moneda;
                $idforma_pago = $val->forma_pago;
            }
           
            DB::table('factura')
            ->insert([  
                'codigo'            => $key,
                'idempresa'         => '001',
                'idestado'          => 'EM',
                'periodo'           => $fecha,
                'fecha_emision'     => Carbon::createFromFormat('d/m/Y',$request->fecha_emision),
                'fecha_vencimiento' => Carbon::createFromFormat('d/m/Y',$request->fecha_vencimiento),
                'idcliente'         => $request->idcliente,
                'idservicio'        => $request->idservicio,
                'formulario'        => 'FORM_SERVICIO_CLIENTE',
                'idusuario'         => (int) Auth::user()->id,
                'idmoneda'          => $idmoneda,  
                'idforma_pago'      => $idforma_pago,  
                'iddocumento'       => $request->idcomprobante,       
                'serie'             => $serie,  
                'numero'            => str_pad($numero, 8, "0", STR_PAD_LEFT), 
                'subtotal'          => $request->precio, 
                'subtotal_neto'     => $request->precio, 
                'total'             => $request->precio, 
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            $idmarca = null;
            $idmodelo = null;
            $dsc_marca = null;
            $dsc_modelo = null;
            $equipo = null;

            $equipo = DB::table('equipos')->where('idequipo',$request->idequipo)->get();
                foreach ($equipo as $val) {
                    $idmarca = $val->idmarca;
                    $idmodelo = $val->idmodelo;
                    $equipo = $val->descripcion;
                }

                $marca = DB::table('marca')->select('descripcion')->where('idmarca',$idmarca)->get();
                $modelo = DB::table('modelo')->select('descripcion')->where(['idmarca' => $idmarca,'idmodelo' => $idmodelo])->get();

                foreach ($marca as $val) {
                   $dsc_marca = $val->descripcion; 
                }
                foreach ($marca as $val) {
                   $dsc_modelo = $val->descripcion; 
                }

            DB::table('dfactura')
            ->insert([     
                'idfactura'         => $key,  
                'idproducto'        => $request->idequipo,
                'cantidad'          => 1,
                'precio'            => $request->precio, 
                'subtotal'          => $request->precio, 
                'total'             => $request->precio, 
                'descripcion'       => $equipo.' Marca: '.$dsc_marca.' Modelo: '.$dsc_modelo
            ]);

            $numero = $numero + 1;
            $numero = str_pad($numero, 8, "0", STR_PAD_LEFT);

            DB::table('documento_venta')
                ->where('iddocumento', $request->idcomprobante)
                ->update(['correlativo' => $numero]);

            DB::table('dequipos')
                ->where([['idequipo', $request->idequipo],['idservicio',$request->idservicio],['facturado','NO']])
                ->update([
                    'facturado'   => "SI"             
            ]);

      
            
            return response()->json(array('valor' => 'CONFORME'));  
        }     
    }

    //--------JPaiva-12-03-2019------------------TEST GENERACION DE COMPROBANTE AUTOMATICO----------------------------
    public function generarComprobante()
    {
        $notificaciones = DB::table('notificaciones')->get();
        $fecha_actual = new \DateTime();
        $fecha_actual = date_format($fecha_actual,'d/m/Y');
        $fecha_facturacion = null;
        $idrouter = null;
        $usuario = null;
        $key = '';
        $serie = null;
        $iddocumento = null;
        $idcliente = null;
        $fecha_vencimiento = null;
        $idservicio = null;

        $parametros = DB::table('parametros')->where('tipo_parametro','FACTURACION')->get();   
        $clientes = DB::table('clientes')->where('estado',1)->get();  
        $doc_venta = DB::table('documento_venta')->where('estado',1)->get();  

        foreach ($parametros as $val) {
            if ($val->parametro == 'DIA_FECHA_VENC') {
                $fecha_vencimiento = Carbon::now()->addDays($val->valor_long);
            }
        }

        foreach ($clientes as $datos) {
            $key = null;
            $numero = null;  
            $iddocumento = $datos->doc_venta;
            $idcliente = $datos->idcliente;

            $servicios = DB::table('servicio_internet')->where([['idcliente','=', $idcliente],['estado', '=', 1],['dia_pago', '=', 30]])->get();
            foreach ($servicios as $servicio) {                
            

            $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ012345678";
            //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
            $length = 10;
            $max = strlen($caracteres) - 1;

            for ($i=0;$i<$length;$i++) {
                $key .= substr($caracteres, rand(0, $max), 1);
            }                

            foreach ($doc_venta as $val) {
                if ($val->iddocumento == $iddocumento) {
                    $serie = $val->serie;
                    $numero = $val->correlativo;    
                }
            }

            $notificaciones = DB::table('notificaciones')->where('idservicio',$servicio->idservicio)->get();
            $fecha_pago = null;
            $fecha_aviso = null;
            $fecha_corte = null;
            $fecha_frecuencia = null;
            $fecha_facturacion = null;
            $fecha_inicio = null;
            $fecha_fin = null;
            $descripcion = null;
            $dsc_perfil = null;
            $vsubida = null;
            $vbajada = null;


            foreach ($notificaciones as $val) {
                $fecha_pago = Carbon::parse($val->fecha_pago);
                $fecha_aviso = Carbon::parse($val->fecha_aviso);
                $fecha_corte = Carbon::parse($val->fecha_corte);
                $fecha_frecuencia = Carbon::parse($val->fecha_frecuencia);
                $fecha_facturacion = Carbon::parse($val->fecha_facturacion);
                $fecha_inicio = Carbon::parse($val->fecha_inicio);
                $fecha_fin = Carbon::parse($val->fecha_fin);
            }
            
            $fecha_actual = new \DateTime();
            $dia =(int) date_format($fecha_actual,'d');
            $mes = (int) date_format($fecha_actual,'m');
            $year = (int) date_format($fecha_actual,'Y');

            $diaN = (int) date_format($fecha_facturacion,'d');
            $mesN = (int) date_format($fecha_facturacion,'m');
            $yearN = (int) date_format($fecha_facturacion,'Y');
            $bandera = false;
        //dd($mes);
            if ($mes == $mesN and $year == $yearN) {
                if ($dia >= $diaN) {
                    $bandera = true;
                }
            }else if ($mes > $mesN and $year >= $yearN) {
                if ($dia <= $diaN) {
                    $bandera = true;
                }
            }
            
            $bandera = true;
            if ($bandera) {
                
                $perfil_internet = DB::table('perfiles')->where('idperfil',$servicio->perfil_internet)->get();  
                foreach ($perfil_internet as $perfil) {
                    $dsc_perfil = $perfil->name;
                    $vsubida = $perfil->vsubida;
                    $vbajada = $perfil->vbajada;
                }

                $descripcion = "Servicio de Internet \n Periodo: desde ".date_format($fecha_inicio,'d/m/Y')." hasta ".date_format($fecha_fin,'d/m/Y')." \n Fecha de corte: ".date_format($fecha_corte,'d/m/Y')." \n Plan de Internet: ".$dsc_perfil." \n Descarga: ".$vbajada." \n Subida: ".$vsubida;
                

                DB::table('factura')
                ->insert([  
                    'codigo'            => $key,
                    'idempresa'         => $datos->idempresa,
                    'idestado'          => 'EM',
                    'periodo'           => date('Y-m-d'),
                    'fecha_emision'     => date('Y-m-d'),
                    'fecha_vencimiento' => $fecha_vencimiento,
                    'idcliente'         => $idcliente,
                    'idservicio'        => $servicio->idservicio,
                    'formulario'        => 'ADMINISTRADOR_TAREAS',
                   // 'idusuario'         => (int) Auth::user()->id,
                    'idmoneda'          => $datos->moneda,  
                    'idforma_pago'      => $datos->forma_pago,  
                    'iddocumento'       => $iddocumento,       
                    'serie'             => $serie,  
                    'numero'            => str_pad($numero, 8, "0", STR_PAD_LEFT), 
                    'costo_servicio'    => $servicio->precio, 
                    'subtotal'          => $servicio->precio, 
                    'descuento'         => 0,
                    'subtotal_neto'     => $servicio->precio, 
                    //'impuesto'          => $request->impuesto,   
                    'total'             => $servicio->precio, 
                    'detalle'           => $descripcion,
                    'fecha_inicio'      => date_format($fecha_inicio,'Y-m-d'),
                    'fecha_fin'         => date_format($fecha_fin,'Y-m-d'),
                    'fecha_corte'       => date_format($fecha_corte,'Y-m-d'),
                    'perfil'            => $dsc_perfil,
                    'vbajada'           => $vbajada,
                    'vsubida'           => $vsubida,
                    'fecha_creacion'    => date('Y-m-d h:m:s')
                ]);

                DB::table('dfactura')
                ->insert([     
                    'idfactura'         => $key,  
                    'idservicio'        => $servicio->idservicio,
                    'cantidad'          => 1,
                    'precio'            => $servicio->precio, 
                    'descuento'         => 0,
                    'subtotal'          => $servicio->precio, 
                    //'impuesto'          => $request->impuesto,   
                    'total'             => $servicio->precio, 
                    'descripcion'       => $descripcion
                ]);

                $numero = $numero + 1;
                $numero = str_pad($numero, 8, "0", STR_PAD_LEFT);

                DB::table('documento_venta')
                ->where('iddocumento', $iddocumento)
                ->update(['correlativo' => $numero]);


                //---------------------Actualizar Notificaciones para proxima accion------------------
                
                DB::table('notificaciones')
                ->where('idservicio',$servicio->idservicio)
                ->update([
                    'fecha_pago'        => $fecha_pago->addMonth(),
                    'fecha_aviso'       => $fecha_aviso->addMonth(),
                    'fecha_corte'       => $fecha_corte->addMonth(),
                    'fecha_frecuencia'  => $fecha_frecuencia->addMonth(),
                    'fecha_facturacion' => $fecha_facturacion->addMonth(),
                    'fecha_inicio'      => $fecha_inicio->addMonth(),
                    'fecha_fin'         => $fecha_fin->addMonth()
                ]);   


                //------------------------ENVIAR EMAIL DEL COMPROBANTE------------------------------------
                $idservicio = $servicio->idservicio;      
                $idcliente = $datos->idcliente;
                $factura = DB::table('factura as f')
                    ->select('f.*','d.dsc_corta')
                    ->leftjoin('documento_venta as d','f.iddocumento','=','d.iddocumento')
                    ->where('f.codigo', $key)->get();
            
               
                $cliente = DB::table('clientes')->where('idcliente', $idcliente)->get();
                $servicio = DB::table('servicio_internet')->where('idservicio', $idservicio)->get();
                $notificaciones = DB::table('notificaciones')->where('idservicio', $idservicio)->get();
                $empresa = DB::table('empresa')->get();
                $dfactura = DB::table('dfactura')->where('idfactura',$key)->get();
                

                //Mail::to($datos->correo)->send(new Comprobante($factura,$cliente,$servicio,$notificaciones,$empresa,$dfactura));              

            }

            
        }
        }
        
    }

    public function anular($id)
    {
        $idcliente = null;
        $factura = DB::table('factura')->where('codigo',$id)->get();

        foreach ($factura as $val) {
            $idcliente = $val->idcliente;
        }
        
        DB::table('factura')
        ->where('codigo',$id)
        ->update([
            'idestado'  => 'AN'
        ]);

        return redirect('/cliente/'.$idcliente);
    }

    //--------JMAZUELOS 05-08-2020-------------- AGREGAR CONCEPTO MANUAL----------------------------
    public function conceptoManual( Request $request){
        //dd($request);
        $rules = array(            
            'descripcionManual'         => 'required',
            'cantidadManual'            => 'required',
            'precioManual'              => 'required',
            'descuentoManual'           => 'required',
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        } else{
            $factura =DB::table('factura')->where('codigo',$request->idFactura ) ->get();
            //dd($factura);
            foreach($factura as $fac){
                $subtotal = $fac->subtotal;
                $descuento =$fac->descuento;
                $subtotal_neto= $fac->subtotal_neto;
                $impuesto=$fac->impuesto;
                $total=$fac->total; 
            } 

            $key = new MaestroController();
            $codigo = null;
            $codigo = $key->codigoN(10);
            $subtotalDFac =$request->cantidadManual *($request->precioManual-$request->descuentoManual);
            if($request->impuestoManual==0){
                $impuesto=$request->impuestoManual;
            }else{
                $impuesto=$subtotalDFac*$request->impuestoManual;
            }
            $totalDFac=$subtotalDFac+$impuesto;
            $subtotal += $totalDFac; 
            $total +=$totalDFac;  
            //dd($impuesto);
            //dd($subtotal,$total);
             
             DB::table('dfactura')
            ->insert([     
                'idfactura'         => $request->idFactura,  
                'idconcepto'        => $codigo,
                'descripcion'       => $request->descripcionManual,
                'cantidad'          => $request->cantidadManual,
                'precio'            => $request->precioManual, 
                'descuento'         => $request->descuentoManual,
                'impuesto'          => $request->impuestoManual,
                'subtotal'          => $subtotalDFac, 
                'total'             => $totalDFac                 
            ]);   
            DB::table('factura')
            ->where('codigo', $request->idFactura)
            ->update([
                        'subtotal' => $subtotal,
                        'descuento' =>$fac->descuento,
                        'subtotal_neto'=> $subtotal, 
                       'total'=>$total                   
            ]);
             

            $datos['total'] = $subtotal ;
            $datos['totalDetFactura'] = $totalDFac   ;
            $datos['subTotal'] = $subtotal ;
            $datos['subTotalNeto'] = $subtotal; 
            $datos['descripcion'] = $request->descripcionManual ;
            $datos['facturaId'] = $request->idFactura ;

            return response()->json($datos);

            
           // dd("ok");
        } 
    }

}
