<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Auth;
use Validator;
use Barryvdh\DomPDF\Facade as PDF;


class CarritoController extends Controller
{

    public function FacturaElectronicaSerieCorrelativo()
    {
            $key = new MaestroController();
            $idempresa= $key->codigoN(3);
            $idcliente= $key->codigoN(20);
            $codigoFac= $key->codigoN(10);

        $dsc_corta="FACE";
        $serie=null;
        $correlativo=null;
        $documento = DB::table('documento_venta')
        ->where(['estado'=>1, 'dsc_corta'=>$dsc_corta])->get();
        foreach ($documento as $val) {
            $serie = $val->serie;
            $correlativo = $val->correlativo;            
        }
        $correlativon =$correlativo +1;
        

        DB::table('documento_venta')
        ->where(['estado'=>1, 'dsc_corta'=>$dsc_corta])
        ->update([
            'correlativo' => "000000".$correlativon
        ]);


        return response()->json([
            'serie' => $serie,
            'correlativo' => "000000".$correlativon,
            'idempresa' => $idempresa,
            'idcliente' =>$idcliente,
            'codigoFac' =>$codigoFac,
        ]);
    }

    
    public function store(Request $request)
    {
            
            $idempresa= $request->idempresa;
            $idcliente= $request->idcliente;
            $codigo= $request->codigoFac;
        
            $precio = null;
            $paquete = null;
            $alcance = null;
            $valor = 1;
            $descuento = null;
            $periodo = null;

            // dd($request);
        
    
            $rules = array(      
                'nombre'            => 'required|string|',
                'apellidos'         => 'required|string|',
                'correo'            => 'required',
                'usuario'           => 'required',
                'password'        => 'required|string|min:6|confirmed',
                'psecreta'          => 'required',            
                'respuesta_secret'  => 'required',
                'pago'              => 'required',   
                'condicion'         => 'required'
            );
            $validator = Validator::make ( $request->all(), $rules );

            if ($validator->fails()){
                $var = $validator->getMessageBag()->toarray();
                array_push($var, 'error');
                //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
                return response()->json($var);
            }

            $metodopago =null;
            if ($request->pago==1){
                $metodopago ="PayPal";
            }else
            {
                $metodopago ="Mercado Pago";

            }


                DB::table('clientes')
                ->insert([
                'idempresa'      => $idempresa,
                'idcliente'      => $idcliente,
                'iddocumento'    => $request->iddocumento,
                'apellidos'       =>  $request->apellidos,
                'nombres'        => $request->nombre,
            //   'apaterno'       => $request->apaterno,
                'correo'         => $request->correo,
                'telefono1'      => $request->telefono,
                'razon_social'   => $request->compania ,
                'direccion'      => $request->direccion,
                'direccion2'    => $request->direccion2,
                'pais'    => $request->pais,
                'region'    => $request->departamente,
                'ciudad'    => $request->ciudad,
                'cod_postal'    => $request->postal,
                'usuario_cpanel'=>$request-> usuario,
                'contra_cpanel'=>$request->password,
                'pregunta'=>$request->psecreta,
                'respuesta'=>$request->respuesta_secret,
                'forma_pago'    => $request->pago,
                'fecha_creacion'    => date('Y-m-d'),
                'condicion_venta'    => $request->condicion ,
                ]);
                DB::table('users')
                ->insert([
                    'idempresa'         => $idempresa,
                    'nombre'            => $request->nombre,
                    'apellidos'         => $request->apellidos,
                    'idtipo'            => "CLE",
                    'estado'            => 1,
                    'email'             => $request->correo,
                    'password'          => Hash::make($request->password),
                    'usuario'           => $request->usuario,
                    'avatar'            => null,
                    'telefono'          => $request->telefono,
                    'glosa'             => $request->glosa,
                    'created_at'        => date('Y-m-d h:m:s')
                ]);

                $descuento = number_format($precio * ($descuento)/100,2);
                //-------------------------------
                $planes = DB::table('planes')->where(['idproducto' => 'I01', 'estado' => 1, 'idplan' => $request->idplan])->get();
                $periodos = DB::table('periodo')->where(['estado' => 1, 'idperiodo' => $request->idperiodo])->get();
                //---------------------------------
                foreach ($periodos as $val) {
                    $valor = $val->valor;
                    $descuento = $val->descuento;
                    $periodo = $val->nombre;
                }
                foreach ($planes as $val) {
                    $precio = number_format($val->precio * $valor,2);
                    $paquete = $val->nombre;
                    $alcance = $val->limite_clientes;            
                }


                DB::table('factura')
                ->insert([
                    'idempresa'    =>$idempresa, 
                    'codigo'    =>$codigo , 
                    'periodo_nombre'    => $periodo, 
                'fecha_emision'    =>date('Y-m-d h:m:s'), 
                'idcliente'      => $idcliente,
                    'idmoneda'    =>"$" , 
                    'subtotal'    => $precio ,
                    'descuento'    => $descuento, 
                    'total'    =>$precio-$descuento ,
                    'idestado'    => "EM" ,
                    'detalle'    => $request-> glosa,
                    'idproducto'    => $request-> idproducto,
                    'idplan'    =>$request-> idplan,
                    'empresa'    =>$request-> compania,
                    'serie'    => $request->serie,
                    'numero'    => $request->correlativo,
                // 'serie'    => , 
                //  'descripcion'    => , 
                //  'iddocumento'    => , 
                //  'numero'    => ,
                //  'subtotal_neto'    => , 
                //  'impuesto'    => ,
                //  'idestado'    =>, 
                //  'estado'    => , 
                //  'idestado'    => , 
                    
                ]);
                
            //Session::flush();
            //return view('pagina3.carrito.factura');
            return response()->json(array('idfac'=>$codigo));
        
        
    }
  
}
