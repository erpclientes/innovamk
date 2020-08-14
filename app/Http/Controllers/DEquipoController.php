<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Carbon\Carbon;

class DEquipoController extends Controller
{
    public function guardarDEquipo(Request $request)
    {
        //dd($request);
        $cont = $request->cont;
        $cont =$cont +7;
        $idmarca = null;
        $idmodelo = null;
        $dsc_marca = null;
        $dsc_modelo = null;
        $equipo = null;
        $contador = 0;
        $Equipos=[];
        
        $rules = array(
            'idservicio'      => 'required',
            'idaccion'        => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');            
            return response()->json($var);
        }        
        for ($i=0; $i <= $cont; $i++) {
            if (!is_null($request['check'.$i])) { 
                $contador = $contador + 1;
            }
        }
        if($contador == 0){
            return response()->json(array('valor' => 'SIN_SELECCION'));        
        }
        //dd("ingreso");


        for ($i=0; $i <= $cont; $i++) {
            if (!is_null($request['check'.$i])) {
               // $idEquipo=$request['idequipo'.$i];
                //dd( $request['idequipo'.$i]);
                //-------------------Creacion del detalle de EQUIPOS_SERVICIO------------------
                DB::table('dequipos')
                ->insert([
                    'idequipo'       => $request['idequipo'.$i],
                    'idservicio'     => $request->idservicio,
                    'idcliente'      => $request->idcliente,
                    'costo'          => $request['precio'.$i],
                    'formulario'     => 'FORM_SERVICIO_CLIENTE',
                    'glosa'          => (empty($request->p_glosa)) ? null : $p_request->glosa,
                    'fecha_creacion' => date('Y-m-d h:m:s'),
                    'idusuario'      => Auth::user()->id,
                    'relacion_servicio' => 'SE',
                    'facturado'      => 'NO',
                    'idestado'       => 'AS'
                ]);
                
                $equipo = DB::table('equipos') 
                -> where('idequipo',$request['idequipo'.$i])->get(); 
                foreach( $equipo as $equi){
                    $modo = $equi->idmodo;

                }
               // dd($modo);
                

                if($modo=='2'){
                    //dd("ingreso");
                    DB::table('equipos')
                    ->where('idequipo', $request['idequipo'.$i])
                    ->update([
                        'idestado'      => 'SN',
                        'idcliente'     => $request->idcliente                    
                    ]);
                    DB::table('servicio_internet')
                    ->where('idservicio',$request->idservicio)
                    ->update([

                        'emisor_conectado'      => $request['idequipo'.$i]   

                    ]);  

                }else {
                    DB::table('equipos')
                    ->where('idequipo', $request['idequipo'.$i])
                    ->update([
                        'idestado'      => 'AS',
                        'idcliente'     => $request->idcliente                    
                    ]);
                }
                 
            
       
       // dd($request->idaccion);

        if ($request->idaccion == "NO_COMP") {

            return response()->json(array('valor' => 'CONFORME'));   

        }else{
            $factura = DB::table('factura')->where(['codigo' => $request->idaccion, 'idestado' => 'EM'])->get();
            //dd($factura);

                $subtotal = 0;
                $total = 0;
                $subtotal_neto = 0;

                foreach ($factura as $val) {
                    $subtotal = $val->subtotal + $request['precio'.$i];
                    $total = $val->total + $request['precio'.$i];  
                    $subtotal_neto = $val->subtotal_neto + $request['precio'.$i];
                }
                //dd($subtotal,$total,$subtotal_neto);

                DB::table('factura')
                ->where('codigo', $request->idaccion)
                ->update([
                    'subtotal'          => $subtotal,  
                    'subtotal_neto'     => $subtotal_neto,
                    'total'             => $total                    
                ]);

                  //  dd($request,$request['idequipo'.$i]);
                    
                $equipo = DB::table('equipos')->where('idequipo',$request['idequipo'.$i])->get();
                //dd($equipo);
                foreach ($equipo as $val) {
                    $idmarca = $val->idmarca;
                    $idmodelo = $val->idmodelo;
                    $equipo = $val->descripcion;
                }
               // dd($idmarca,$idmodelo,$equipo);

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
                    'idfactura'         => $request->idaccion,  
                    'idproducto'        => $request['idequipo'.$i],
                    'descripcion'       => $equipo.' Marca: '.$dsc_marca.' Modelo: '.$dsc_modelo,
                    'cantidad'          => 1,
                    'precio'            => $request['precio'.$i],
                    'subtotal'          => $request['precio'.$i], 
                    'total'             => $request['precio'.$i]
                ]);

                for ($i=0; $i <= $cont; $i++) {
                    if (!is_null($request['check'.$i])) { 
                        DB::table('dequipos')
                        ->where([['idequipo', $request['idequipo'.$i]],['idservicio',$request->idservicio],['facturado','NO']])
                        ->update([
                            'facturado'   => "SI"             
                        ]);
                    }
                }
                
        }
      }
    } 
        

        return response()->json(array('valor' => 'CONFORME'));        
    }

    public function guardarEquipoComprobante(Request $request)
    {
        //dd($request);
        $rules = array(
            'idcomprobante' => 'required',
            'precio'        => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');            
            return response()->json($var);
        }        

        $factura = DB::table('factura')->where(['codigo' => $request->idcomprobante, 'idestado' => 'EM'])->get();
        //dd($factura);
        $subtotal = 0;
        $total = 0;
        $subtotal_neto = 0;

                foreach ($factura as $val) {
                    $subtotal = $val->subtotal + $request->precio;
                    $total = $val->total + $request->precio;  
                    $subtotal_neto = $val->subtotal_neto + $request->precio;
                }

                DB::table('factura')
                ->where('codigo', $request->idcomprobante)
                ->update([
                    'subtotal'          => $subtotal,  
                    'subtotal_neto'     => $subtotal_neto,
                    'total'             => $total                    
                ]);


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
                    'idfactura'         => $request->idcomprobante,  
                    'idproducto'        => $request->idequipo,
                    'descripcion'       => $equipo.' Marca : '.$dsc_marca.' Modelo: '.$dsc_modelo,
                    'cantidad'          => 1,
                    'precio'            => $request->precio,
                    'subtotal'          => $request->precio, 
                    'total'             => $request->precio
                ]);

                DB::table('dequipos')
                ->where([['idequipo', $request->idequipo],['idservicio',$request->idservicio],['facturado','NO']])
                ->update([
                    'facturado'   => "SI"             
                ]);

            return response()->json(array('valor' => 'CONFORME'));     
            
    }
}
