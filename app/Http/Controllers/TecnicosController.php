<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Validator; 

use Carbon\Carbon;

class TecnicosController extends Controller
{
    //
    public function index (){ 
        
        $tecnicos  =DB::table('tecnicos')->get();
       
        $zonas = DB::table('zonas')->get();

        return view ('forms.tecnicos.lstTecnicos',[
            'Tecnicos' =>$tecnicos,
            'zonas'     =>$zonas

        ]);

    }
    public function create (){ 
        
        $tecnicos  =DB::table('tecnicos')->get();
        $zonas = DB::table('zonas')->get();
        $parametros = DB::table('parametros')->where('tipo_parametro','CLIENTES')->get();
        $tipo_documento = DB::table('documento')
            ->select('iddocumento', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $empresa = DB::table('empresa')->where('estado',1)->get(); 


        return view ('forms.tecnicos.mntTecnicos',[
            'tipo_documento'            => $tipo_documento,
            'parametros'                => $parametros,
            'empresa'                   => $empresa,
            'Tecnicos'                  =>$tecnicos,
            'zonas'                     =>$zonas

        ]);

    } 
    public function Store ( Request $request ){
       // dd($request);
       
       $key = new MaestroController();
       $idTecnico = $key->codigoN(3);
        $rules = array(  
                        'nombres'         => 'required',
                        'zonas'         => 'required',
                        'nro_documento'         => 'required',
                        'idempresa'         => 'required', 
                        'sexo'         => 'required',

                      );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        } else {  
           // dd($idTecnico);
            // dd($request);   
            DB::table('tecnicos')->insert([
                'idtecnico'           => $idTecnico, 
                'idempresa'           => $request->idempresa,
                'nombre'              => strtoupper ($request->nombres ),
                'apaterno'            => strtoupper ($request->apaterno),
                'amaterno'            => strtoupper ($request->amaterno),
                //'apellidos'           => $request->amaterno+$request->apaterno,
                'fecha_nacimiento'    => $request->fNacimiento,
                'sexo'                => $request->sexo,
                'direccion'           => $request->direccion,
                'correo'              => $request->correo,
                'telefono'            => $request->telefono1,
                'telefono2'           => $request->telefono2, 
                'iddocumento'         => $request->iddocumento,
                'nro_documento'       => $request->nro_documento,
                'estado'              => "1",
                'glosa'               => $request->glosa,
                'descripcion'         => $request->glosa,
                'fecha_Creacion'      => date('Y-m-d h:m:s'),
                'idZona'              => $request->zonas, 
                ]);

            return response()->json("conforme");
        }

    }
    public function show($id){

        $tecnicos  =DB::table('tecnicos')
        ->where('idtecnico', strval($id))
        ->get();
        $zonas = DB::table('zonas')->get();
        $parametros = DB::table('parametros')->where('tipo_parametro','CLIENTES')->get();
        $tipo_documento = DB::table('documento')
            ->select('iddocumento', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();
        $empresa = DB::table('empresa')->where('estado',1)->get();  
        


        return view ('forms.tecnicos.mntTecnico',[
            'tipo_documento'            => $tipo_documento,
            'Tecnicos'                  =>$tecnicos,
            'parametros'                => $parametros,
            'empresa'                   => $empresa, 
            'zonas'                     =>$zonas

        ]);
        


    }
    public function destroy($id){ 

        DB::table('tecnicos')
        ->where('idtecnico', strval($id))
        ->delete(); 
        return redirect('/tecnicos'); 
    }
    public function disabled($id){ 
        //dd($id);
        DB::table('tecnicos')
        ->where('idtecnico', strval($id))
        ->update(['estado' => 2]); 
        return redirect('/tecnicos'); 
    }
    public function habilitar($id){ 
        //dd($id);
        DB::table('tecnicos')
        ->where('idtecnico', strval($id))
        ->update(['estado' => 1]); 
        return redirect('/tecnicos'); 
    }
    public function update ( Request $request ){
          
        
         $rules = array(  
                         'nombres'         => 'required',
                         'zonas'         => 'required',
                         'nro_documento'         => 'required',
                         'idempresa'         => 'required', 
                         'sexo'         => 'required',
 
                       );
 
         $validator = Validator::make($request->all(), $rules);
 
         if ($validator->fails()) {
             $var = $validator->getMessageBag()->toarray();
             array_push($var, 'error');
             //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
             return response()->json($var);
         } else {  
            // dd($idTecnico);
             // dd($request);   
             DB::table('tecnicos')
             ->where('idtecnico', strval($request->idtecnico))
            ->update ([
                 
                 'idempresa'           => $request->idempresa,
                 'nombre'              => $request->nombres,
                 'apaterno'            => $request->apaterno,
                 'amaterno'            => $request->amaterno,
                 //'apellidos'           => $request->amaterno+$request->apaterno,
                 'fecha_nacimiento'    => $request->fNacimiento,
                 'sexo'                => $request->sexo,
                 'direccion'           => $request->direccion,
                 'correo'              => $request->correo,
                 'telefono'            => $request->telefono1,
                 'telefono2'           => $request->telefono2, 
                 'iddocumento'         => $request->iddocumento,
                 'nro_documento'       => $request->nro_documento,
                 'estado'              => "1",
                 'glosa'               => $request->glosa,
                 'descripcion'         => $request->glosa,
                 'fecha_Creacion'      => date('Y-m-d h:m:s'),
                 'idZona'              => $request->zonas, 
                 ]);
 
             return response()->json("conforme");
         }
 
    }
}
