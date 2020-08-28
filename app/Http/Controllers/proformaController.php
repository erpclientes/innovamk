<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;



class proformaController extends Controller
{
    public function index (){  
        
        
        $proformas     = DB::table('proforma')->where('estado',1)->get(); 
        $dproforma     = DB::table('dproforma')->get(); 
        $clientes = DB::table('clientes')->get();

         
        //dd($clientes);
        return view ('forms.proformas.lstProformas',[
            'proformas'        =>$proformas,
            'dproforma'        =>$dproforma,
            'clientes'        =>$clientes  

        ]);

    }
    public function create (){ 

        $parametros = DB::table('parametros')
        ->whereIn('tipo_parametro',['FACTURACION','CLIENTES'])
        ->where('estado',1)->get();
        $tipo_documento = DB::table('documento')
        ->select('iddocumento', 'descripcion', 'dsc_corta')
        ->where('estado', '1')
        ->get();
        $router     = DB::table('router')->get(); 
        $perfiles=DB::table ('perfiles')->where('estado',1)->get();
        $equipos = DB::table('equipos') ->where('estado',1)->get(); 

        $marca = DB::table('marca')->where('estado',1)->get();
        $modelo = DB::table('modelo')->where('estado',1)->get();
        $modo = DB::table('modo_equipo')->where('estado',1)->get();
        $documento_venta = DB::table('documento_venta') 
            ->where('es_proforma',1)->get();
        foreach ($documento_venta as $doc) {
            $iddocumento =$doc->iddocumento;
            $serie =$doc->serie;
            $correlativo =str_pad($doc->correlativo+1, 8, "0", STR_PAD_LEFT);
        } 

        return view ('forms.proformas.addProforma',[
            'parametros'        =>$parametros,
            'perfiles'          =>$perfiles,
            'router'            => $router,
            'equipos'           => $equipos, 
            'marca'             => $marca,
            'modelo'            => $modelo,
            'modo'              => $modo,
            'correlativo'       => $correlativo,
            'serie'            =>$serie,
            'tipo_documento'    => $tipo_documento,
        ]);

    } 
    public function generarProforma ( Request $request ){
        $id='001';
        $idcliente='9A6lP9Z1iw';
        $cliente = DB::table('clientes')->where('idcliente', $idcliente)->get(); 
        $empresa = DB::table('empresa as e')
            ->leftjoin('clientes as c','c.idempresa','=','e.idempresa')
            ->where('c.idcliente',$idcliente)
            ->get();
        $idf="001";

        $pdf = PDF::loadView('forms.comprobante.proforma.proforma', compact( 
              'cliente', 'empresa'))
        ->save(storage_path('app/public/') .'proforma'. $idf.'.pdf');

        //$comprobante = $value->dsc_corta.$value->serie.$value->numero.'.pdf';
    
       
        return $pdf->stream(storage_path('app/public/') .'proforma'. $idf.'.pdf');
            
    }
    public function store(Request $request)
    { 
        
        $request->session()->flash('latitud' );
        $request->session()->flash('longitud' );
        $request->session()->flash('direccion' );
        //dd($request);

        $idusu      = Auth::user()->id;
        $key = new MaestroController();
        $codigo = null;
        $codigo = $key->codigoN(10);  
        $prodormaId = $key->codigoN(10);  
        $dias=15;
        $fecha_inicio = Carbon::now();
        $fecha_fin = Carbon::now()->addDays($dias)->subDays(0);

        $documento_venta = DB::table('documento_venta') 
            ->where('es_proforma',1)->get();
        foreach ($documento_venta as $doc) {
            $iddocumento =$doc->iddocumento;
            $serie =$doc->serie;
            $correlativo =$doc->correlativo+1 ;
        } 
        //dd(str_pad($correlativo, 8, "0", STR_PAD_LEFT));
        //dd($fecha_fin); 
        //dd($request);  
            $rules = array( 
            'iddocumentoPro' => 'required', 
            'nro_documentoPro' => 'required|max:50', 
            'apaternoPro'      => 'required|max:50',
            'amaternoPro'      => 'required|max:50',
            'nombresPro'       => 'required|string|max:50' 
            );
            $validator = Validator::make ( $request->all(), $rules );
    
            if ($validator->fails()){
                $var = $validator->getMessageBag()->toarray();
                array_push($var, 'error');
                //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
                return response()->json($var);
            } 

            $usuario = DB::table('users')
            ->where('id',$idusu)->get();
            foreach ($usuario as $val) {
                $idempresa = $val->idempresa;
            }
           // dd($idempresa); 
            DB::table('clientes') 
            ->insert([
                'idempresa'      => $idempresa, 
                'idcliente'      => $codigo,
                'estado'         => 5, 
                'apaterno'       => $request->apaternoPro,
                'amaterno'       => $request->amaternoPro,
                'nombres'        => $request->nombresPro,
                'iddocumento'    => $request->iddocumentoPro,
                'nro_documento'  => $request->nro_documentoPro,
                'direccion'      => $request->direccionPro,  
                'correo'         => $request->correoPro, 
                'telefono1'      => $request->contactoPro, 
               // 'forma_pago'     => (empty($request->forma_pago)) ? null : $request->forma_pago, 
                'razon_social'   => $request->apaternoPro . ' ' . $request->amaternoPro . ' ' . $request->nombresPro,
                //'glosa'          => (empty($request->glosa)) ? null : $request->glosa,
                'fecha_creacion' => date('Y-m-d h:m:s'), 
                'latitud'     => $request->latituPro,
                'longitud'     => $request->longituPro, 
            ]); 
            DB::table('proforma') 
            ->insert([

                'idempresa'             => $idempresa,
                 'codigo'               => $prodormaId ,
                 'fecha_emision'        => $fecha_inicio,
                 'fecha_vencimiento'    => $fecha_fin,
                 'idcliente'            => $codigo,
                 'iddocumento'          => $request->iddocumentoPro,
                 'nro_documento'        => $request->nro_documentoPro,
                 'formulario'           => 'PROFORMA NUEVO',
                 'idusuario'            => $idusu, 
                 'fecha_creacion'       => date('Y-m-d h:m:s'),
                 'estado'               => 1, 
                 'datos_Utilizado'      =>'NO',//  -> no se utiliza 
                 'descripcion'          => $request->descripcionPro, 
                 'serie'                => $serie, 
                 'numero'               => str_pad($correlativo, 8, "0", STR_PAD_LEFT),  


                 
            ]); 
            DB::table('documento_venta')
                ->where('iddocumento', $iddocumento)
                ->update(['correlativo' =>str_pad($correlativo, 8, "0", STR_PAD_LEFT)]);

            $datos['clienteId'] = $codigo;
            $datos['prodormaId'] = $prodormaId;
            $datos['empresaId'] = $idempresa; 
            return response()->json($datos);
            //return response()->json("conforme"); 

       // return redirect('/clientes');
    }
    public function StoreDetallePlan ( Request $request ){ 
        //dd( $request);
        $key = new MaestroController();
        $item = null;
        $item = $key->codigoNnumeros(11); 
        //dd( $request->conceptoId);
         DB::table('dproforma') 
            ->insert([
                 'item'         =>$item,
                 'idproforma'   =>$request->prodormaId,
                 'idplan'       =>$request->conceptoId, 
                 'descripcion'  =>$request->descripcion,
                 'nombre'  =>$request->Concepto, 
                 'cantidad'     =>1,
                 'precio'       =>$request->precio,
                 'descuento'    =>$request->descuento,
                 'subtotal'     =>$request->subtotal, 
            ]);
       // return response()->json("conforme");  
    }
    public function StoreDetalleEquipo ( Request $request ){ 
        //dd( $request);
        $key = new MaestroController();
        $item = null;
        $item = $key->codigoNnumeros(11); 
        //dd( $request->conceptoId);
         DB::table('dproforma') 
            ->insert([
                 'item'         =>$item  ,
                 'idproforma'   =>$request->prodormaId,
                 //'idplan'       =>$request->planId,
                 'idequipo'     =>$request->conceptoId,
                // 'idconcepto'   =>$request->,
                'nombre'  =>$request->Concepto,
                 'descripcion'  =>$request->descripcion,
                 'cantidad'     =>1,
                 'precio'       =>$request->precio,
                 'descuento'    =>$request->descuento,
                 'subtotal'     =>$request->subtotal, 
            ]);
        //return response()->json("conforme");  
    }
    public function StoreDetalleConceptoManual ( Request $request ){ 
       // dd( $request);
        $key = new MaestroController();
        $item = null;
        $item = $key->codigoNnumeros(11); 
        //dd( $request->conceptoId);
         DB::table('dproforma') 
            ->insert([
                 'item'         =>$item  ,
                 'idproforma'   =>$request->prodormaId,
                 //'idplan'       =>$request->planId,
                 //'idequipo'     =>$request->,
                 'idconcepto'   =>$request->conceptoId,
                 'nombre'  =>$request->Concepto,
                 'descripcion'  =>$request->descripcion,
                 'cantidad'     =>1,
                 'precio'       =>$request->precio,
                 'descuento'    =>$request->descuento,
                 'subtotal'     =>$request->subtotal, 
            ]);
        //return response()->json("conforme");  
    } 
    public function show($id){  
        $proformas = DB::table('proforma')->where('codigo', $id )->get();
        $dproforma = DB::table('dproforma')->where('idproforma', $id )->get();
        foreach($proformas as $pro ){
            $idcliente = $pro->idcliente;
            $idusu = $pro->idusuario; 
        }
        //dd($dproforma);
        $cliente = DB::table('clientes')->where('idcliente', $idcliente)->get();   
        $usuario = DB::table('users')
            ->where('id',$idusu)->get();
            foreach ($usuario as $val) {
                $idempresa = $val->idempresa;
            }
        $empresa = DB::table('empresa')->where('idempresa', $idempresa)->get(); 

        $comprobante = null;

        foreach ($proformas as $value) {
            //$comprobante = $value->dsc_corta.$value->serie.$value->numero.'.pdf';
            $comprobante = 'proforma'.$value->codigo.'.pdf';
        }
        $planes = DB::table('perfiles')->get();
        $equipos = DB::table('equipos')->get();  

        //dd($proformas,$cliente,$empresa,$planes,$equipos);

        $pdf = PDF::loadView('forms.comprobante.proforma.proforma', compact('proformas','cliente', 'empresa','dproforma','usuario','planes','equipos'));

        //return $pdf->download(''.$comprobante.'');
        return $pdf->stream(''.$comprobante.'');






 
         

         
    }
    public function destroy($id){ 
        

        DB::table('proforma')
        ->where('codigo',$id)
        ->update([  'estado'  => 2 ]);

        return redirect('/proformas');
       
    }
    public function disabled($id){ 
 
    }
    public function habilitar($id){ 
    
    }
    public function update ( Request $request ){ 

    }
}
