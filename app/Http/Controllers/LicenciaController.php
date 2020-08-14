<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;
use Image;
use Carbon\Carbon;

class LicenciaController extends Controller
{
    public function index()
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

        $licencia = DB::table('licencia')->where('idusuario',Auth::user()->id)->get();
        $tipo = DB::table('tipo_licencia')->get();

        return view('forms.licencia.lstLicencia', [
                    'licencia'   => $licencia,
                    'valida'     => $valida,
                    'tipo'   	 => $tipo
        ]);
    }

    public function create()
    {
        $empresa = DB::table('empresa')->where('estado',1)->get();
        $tipo = DB::table('tipo_licencia')->get();
        
        return view('forms.licencia.addLicencia',[
            'empresa'    => $empresa,
            'tipo'    => $tipo
        ]);
    }

    public function create2()
    {
        $empresa = DB::table('empresa')->where('tipo','CLIE')->get();
            
        return view('forms.licencia.registrar',[
            'empresa'    => $empresa
        ]);
    }

    
    public function store(Request $request)
    {
        //dd($request);
        $key = new MaestroController();
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        DB::table('licencia')
        ->insert([
            'idempresa'         => '001',
            'idlicencia'		=> $key->codigoN(10),
            'estado'            => 1,
            'codigo'            => $request->codigo2,
            'codigo2'           => bcrypt($request->codigo2),
            'idtipo_lic'		=> $request->tipo,  
            'meses'             => $request->meses,
            'descuento'         => $request->descuento,
            'subtotal'          => $request->subtotal,
            'total'             => $request->total,             
            'idusuario'         => Auth::user()->id,
            'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);

        if (count($validacion) === 0) {
            DB::table('validacion')
            ->insert([
                'idusuario' => $idusu,
                'valor'     => 1
            ]);
        }else{
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 1]);
            
        }


        return response()->json(array('valor'=> 'CONFORME'));
    }

    public function store2(Request $request)
    {
        //dd($request);
        $key = new MaestroController();
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        DB::table('licencia')
        ->insert([
            'idempresa'         => $request->empresa,
            'idlicencia'        => $key->codigoN(10),
            'estado'            => 1,
            'codigo'            => $request->codigo2,
            'codigo2'           => bcrypt($request->codigo2),
            'idtipo_lic'        => $request->tipo,               
            'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);

        if (count($validacion) === 0) {
            DB::table('validacion')
            ->insert([
                'idusuario' => $idusu,
                'valor'     => 1
            ]);
        }else{
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 1]);
            
        }


        return response()->json(array('valor'=> 'CONFORME'));
    }

    public function generadorLicencia(Request $request)
    {
    	//dd($request);        
        //$key = 'C'.$request->idempresa.'-';
        $key = null;
        $cont = 0;

        $caracteres = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
        $length = 20;
        $max = strlen($caracteres) - 1;

        for ($i=0;$i<$length;$i++) {
        	$cont++;
        	if ($cont == 4) {
        		$key .= ''.substr($caracteres, rand(0, $max), 1).'-';
        		$cont = 0;
        	}else{
        		$key .= ''.substr($caracteres, rand(0, $max), 1);	
        	}
            
        }

        $key = substr($key,0,strlen($key)-1);

        return response()->json($key);   
    }

    public function generadorLicencia2(/* Request $request */)
    {
    	// dd($request);        
        //$key = 'C'.$request->idempresa.'-';
        $key = null;
        $cont = 0;
        $caracteres = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
        $length = 20;
        $max = strlen($caracteres) - 1;

        for ($i=0;$i<$length;$i++) {
        	$cont++;
        	if ($cont == 4) {
        		$key .= ''.substr($caracteres, rand(0, $max), 1).'-';
        		$cont = 0;        	}else{
        		$key .= ''.substr($caracteres, rand(0, $max), 1);	
        	}
            
        }
        $key = substr($key,0,strlen($key)-1);
        /* DB::table('mensaje')
        ->insert([
            'enviado_por'    => "licencia",
            'email_destino'  => "licencia",
            'asunto'         => "licencia",
            'mensaje'        => "PDF",
            'fecha'          => date('Y-m-d H:m:s')
         ]); */
        return response()->json($key);   
    }


    public function generadorLicencia3(Request $request)
        {   // dd($request);        
            //$key = 'C'.$request->idempresa.'-';
            $generador = new MaestroController();
            $key = null;
            $idlicencia=$generador->codigoN(10);
            $cont = 0;
            $caracteres = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
            $length = 20;
            $max = strlen($caracteres) - 1; 
            for ($i=0;$i<$length;$i++) {
                $cont++;
                if ($cont == 4) {
                    $key .= ''.substr($caracteres, rand(0, $max), 1).'-';
                    $cont = 0;        	}else{
                    $key .= ''.substr($caracteres, rand(0, $max), 1);	
                }            
            }
            //$key = substr($key,0,strlen($key)-1);
            $key = substr($key,0,strlen($key)-1);
            $fecha_inicio = Carbon::now();
            // dd($fecha_inicio);
            $fecha_fin = Carbon::now()->addMonth($request->meses)->subDays(1);

        DB::table('licencia')
        ->insert([
            'idempresa'         => $request->idempresa,
            'idlicencia'		=> $idlicencia,
            'estado'            => 1,
            'codigo'            => $key,
            'codigo2'           => bcrypt($key),
            //'idtipo_lic'		=> $request->tipo,  
            'meses'             => $request->meses,
            'descuento'         => $request->descuento,
            'subtotal'          => $request->subtotal,
            'total'             => $request->total,             
            //'idusuario'         => Auth::user()->id,
            'fecha_inicio'      => $fecha_inicio,
            'fecha_fin'         => $fecha_fin,
            'idproducto'         => $request->plan,
            'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);
           // return response()->json($key);   

            return response()->json([
                'idlicencia' => $key,
                'idempresa'         => $request->idempresa,
                'idlicencia'		=> $idlicencia,
                'estado'            => 1,
                'codigo'            => $key,
                'codigo2'           => bcrypt($key),
                //'idtipo_lic'		=> $request->tipo,  
                'meses'             => $request->meses,
                'descuento'         => $request->descuento,
                'subtotal'          => $request->subtotal,
                'total'             => $request->total,             
                //'idusuario'         => Auth::user()->id,
                'fecha_creacion'    => date('Y-m-d h:m:s'),
                'fecha_inicio'      => $fecha_inicio,
                'idproducto'         => $request->plan,
                'fecha_fin'         => $fecha_fin     
            ]);
        }


    public function validar(Request $request)
    {
        //dd($request);
        $rules = array(            
            'idempresa'     => 'required',
            'ip_server'  => 'required',
            'codigo'     => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }     

        $licencia = DB::table('licencia')->where('codigo',$request->codigo)->get();
        if (count($licencia) == 0) {
            return response()->json('NO_LICENCIA');
        }  

        foreach ($licencia as $val) {
            if($val->estado == 2){
                return response()->json('LICENCIA_ASIGNADA');
            }
        }

        $idempresa = substr($request->codigo,1,3);
        $key = new MaestroController();
        $idcliente = $key->codigoN(10);
        $idempresa = $key->codigoN(3);
        
        DB::table('empresa')
            ->insert([
                'idempresa'         => $idempresa,
                'idcliente'         => $idcliente,
                'nombre'            => $request->razon_social,
                'direccion'         => $request->direccion,
                'RUC'               => $request->RUC,
                'referencia'        => $request->refrencia,
                'DNI1'              => $request->DNI1,
                'representante1'    => $request->representante1,
                'razon_social'      => $request->razon_social,
                'telefono'          => $request->telefono,
                'iddocumento'       => $request->iddocumento,
                'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);

        $meses = 1;        
        $idlicencia = null;
        $datos = array();

        foreach ($licencia as $value) {
            if (!is_null($value->meses) and $value->meses > 0) {
                $meses = $value->meses;
            }            
            $idlicencia = $value->idlicencia;
        }

        $fecha_inicio = Carbon::now();
        $fecha_fin = Carbon::now()->addMonth($meses)->subDays(1);

        $datos['fecha_inicio'] = $fecha_inicio->format('Y-m-d');
        $datos['fecha_fin'] = $fecha_fin->format('Y-m-d');
        $datos['idcliente'] = $idcliente;
        $datos['idlicencia'] = $idlicencia;
        $datos['meses'] = $meses;

        DB::table('licencia')
        ->where('codigo',$request->codigo)
        ->update([
            'fecha_inicio'      => $fecha_inicio,
            'fecha_fin'         => $fecha_fin,
            'idcliente'         => $idcliente,
            'ip_server'         => $request->ip_server,
            'estado'            => 2
        ]);

        if(count(DB::table('licencia_cliente')->where(['idcliente' => $idcliente,'idlicencia' => $idlicencia])->get()) == 0){
            DB::table('licencia_cliente')
            ->insert([
                'idlicencia'        => $idlicencia,
                'idcliente'         => $idcliente,
                'estado'            => 1,    
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);    
        }        


        return response()->json($datos);
    }

    public function setLicencia(Request $request)
    {
        //dd($request);
        $licencia = DB::table('licencia')->where('idlicencia',$request->idlicencia)->get();
        $key = new MaestroController();

        if (count($licencia) == 0) {
            DB::table('licencia')
            ->insert([
                'idempresa'         => $request->idempresa,
                'idlicencia'        => $key->codigoN(10),
                'estado'            => 1,
                'codigo'            => $request->codigo,
                'meses'             => $request->meses,
                'fecha_inicio'      => $request->fecha_inicio,               
                'fecha_fin'         => $request->fecha_fin,               
                'idcliente'         => $request->idcliente,               
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);
        }

        DB::table('empresa')
        ->where('idempresa',$request->idempresa)
        ->update([
            'idcliente'      => $request->idcliente            
        ]);
        

        if(count(DB::table('licencia_cliente')->where(['idcliente' => $request->idcliente,'idlicencia' => $request->idlicencia])->get()) == 0){
            DB::table('licencia_cliente')
            ->insert([
                'idlicencia'        => $request->idlicencia,
                'idcliente'         => $request->idcliente,
                'estado'            => 1,    
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);    
        }        
        

        return response()->json('CORRECTO');
    }
}
