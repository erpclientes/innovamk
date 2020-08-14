<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use Illuminate\Support\Collection as Collection;
use Barryvdh\DomPDF\Facade as PDF;

class FichasController extends Controller
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

        $fichas = DB::table('fichas')->get();
        $router = DB::table('router')->get();
        $perfiles = DB::table('perfiles')->get();
        $plantillas = DB::table('fichas_plantilla')->get();

        return view('forms.fichas.lstFichas', [
                    'fichas'        => $fichas,
                    'router'        => $router,
                    'perfiles'      => $perfiles,
                    'plantillas'    => $plantillas,
                    'valida'        => $valida
                ]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $rules = array(            
            'idrouter'   		=> 'required',
            'usuarios'   		=> 'required',
            'descripcion'       => 'required',
            'prefijo'           => 'required',
            'long_usuario'      => 'required',
            'long_contra'       => 'required',
            'idperfil'          => 'required'
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
            
            DB::table('fichas')
            ->insert([
                'idempresa'         => '001',
                'estado'            => 1,
                'idfichas'          => $idfichas,
                'idrouter'          => $request->idrouter,
                'idperfil'			=> $request->idperfil,
                'usuarios'			=> $request->usuarios,
                'descripcion'		=> $request->descripcion,
                'prefijo'			=> $request->prefijo,
                'long_usuario'		=> $request->long_usuario,
                'long_contra'		=> $request->long_contra,
                'glosa'             => $request->glosa, 
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            foreach ($perfiles as $val) {
            	if ($val->idperfil == $request->idperfil) {
            		$perfil = $val->name;
            	}
            }

            for ($i=0; $i < $request->usuarios; $i++) { 
            	$key = new MaestroController();
        		$codigo = $request->prefijo.$key->codigoN($request->long_usuario);	
        		$contra = $key->codigoN($request->long_contra);	

        		DB::table('fichas_det')
	            ->insert([
	                'idfichas'          => $idfichas,
	                'usuario'           => $codigo,
	                'contra'			=> $contra,
	                'idestado'			=> 'DE'
	            ]);

	            $API = new routeros_api();
                $API->debug = false;
                $ARRAY = null;

                $router = DB::table('router')->where('idrouter',$request->idrouter)->get();

                foreach ($router as $rou) {
	                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {                   
	                    $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                "name"      => $codigo,
                                "password"  => $contra,  
                                "profile"   => $perfil,  
                                "server"    => 'hotspot1',
                                "comment"   => (is_null($request->glosa)? $codigo : $request->glosa)
                        ));  	                    
	                }       
                }
            }
           
            
            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
            
            return response()->json($collection->toJson());        
        }         
            
    }

    public function plantilla($id,$idplantilla)
    {
        $idperfil = null;
        $fichas = DB::table('fichas')->where('idfichas',$id)->get();
        $dfichas = DB::table('fichas_det')->where('idfichas',$id)->get();
        $plantilla = DB::table('fichas_plantilla')->where('codigo',$idplantilla)->get();

        foreach ($fichas as $val) {
            $idperfil = $val->idperfil;
        }

        $perfiles = DB::table('perfiles')->where('idperfil',$idperfil)->get();

        return view('forms.fichas.pdf.plantilla', [
                    'fichas'     => $fichas,
                    'dfichas'    => $dfichas,
                    'perfiles'   => $perfiles,
                    'plantilla'  => $plantilla
                ]);
    }

    public function pdf($id,$idplantilla)
    {  
        $idperfil = null;
        $fichas = DB::table('fichas')->where('idfichas',$id)->get();
        $dfichas = DB::table('fichas_det')->where('idfichas',$id)->get();
        $plantilla = DB::table('fichas_plantilla')->where('codigo',$idplantilla)->get();

        foreach ($fichas as $val) {
            $idperfil = $val->idperfil;
        }

        $perfiles = DB::table('perfiles')->where('idperfil',$idperfil)->get();


        $pdf = PDF::loadView('forms.fichas.pdf.plantilla', compact('fichas','dfichas','perfiles','plantilla'));

        return $pdf->stream('prueba.pdf');
    }

    //-----------------------------------------------GESTION DE PLANTILLAS-------------------------------------------------------
    public function plantillas()
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

        $plantillas = DB::table('fichas_plantilla')->get();

        return view('forms.fichas.lstPlantillas', [
            'plantillas' => $plantillas,
            'valida'     => $valida
        ]);
    }

    public function createPlantilla()
    {
        return view('forms.fichas.addPlantilla');
    }

    public function storePlantilla(Request $request)
    {
        //dd($request);
        $rules = array(            
            'iddiseno'          => 'required',
            'cfondo_cabecera'   => 'required',
            'descripcion'       => 'required',
            'cfondo_footer'     => 'required',
            'cfondo_cuerpo'     => 'required',
            'texto1'            => 'required',
            'texto2'            => 'required'
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

        
        DB::table('fichas_plantilla')
        ->insert([
                'estado'            => 1,
                'iddiseno'          => $request->iddiseno,
                'descripcion'       => $request->descripcion,
                'cfondo_cabecera'   => $request->cfondo_cabecera,
                'cfondo_footer'     => $request->cfondo_footer,
                'cfondo_cuerpo'     => $request->cfondo_cuerpo,
                'texto1'            => $request->texto1,
                'texto2'            => $request->texto2,
                'size_texto2'       => $request->size_texto2,
                'size_precio'       => $request->size_precio,
                'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);            
            
        $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
        $collection = Collection::make($perfiles);
            
        return response()->json($collection->toJson());         
            
    }

    public function update(Request $request)
    {
         $rules = array(      
            'idrouter'          => 'required',
            'name'              => 'required',
            'precio'            => 'required',
            'vsubida'           => 'required',
            'vbajada'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('perfiles')
            ->where('idperfil',$request->idperfil)
            ->update([
                'idrouter'          => $request->idrouter,
                'name'              => $request->name,
                'precio'            => $request->precio,
                'vsubida'           => $request->vsubida,
                'vbajada'           => $request->vbajada,
                'target'            => $request->vsubida.'/'.$request->vbajada,
                'glosa'             => (empty($request->glosa))? null : $request->glosa     
            ]);

            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
                
            return response()->json($collection->toJson());   
        }
    }

    public function show($id)
    {
        $plantillas = DB::table('fichas_plantilla')->where('codigo',$id)->get();

        return view('forms.fichas.updPlantilla', [
            'plantillas' => $plantillas
        ]);
    }

    public function detalleFichas($idficha)
    {  
        $router = DB::table('router')->get();
        $perfiles = DB::table('perfiles as p')
            ->select('f.idrouter')
            ->leftjoin('fichas as f','f.idperfil','=','p.idperfil')
            ->leftjoin('router as r','r.idrouter','=','p.idrouter')
            ->where('f.idfichas', $idficha)
            ->get();

        $fichas = DB::table('fichas_det')->where('idfichas',$idficha)->get();
        dd($perfiles);

        return view('forms.fichas.lstFichas', [
                    'fichas'        => $fichas,
                    'router'        => $router,
                    'perfiles'      => $perfiles,
                    'plantillas'    => $plantillas,
                    'valida'        => $valida
                ]);
    }
}
