<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Collection as Collection;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $equipos = DB::table('equipos')->get();
        $marca = DB::table('marca')->where('estado',1)->get();
        $modelo = DB::table('modelo')->where('estado',1)->get();
        $modo = DB::table('modo_equipo')->where('estado',1)->get();

        return view('forms.equipos.lstEquipos', [
                    'equipos'    => $equipos,
                    'marca'     => $marca,
                    'modelo'    => $modelo,
                    'modo'      => $modo,
                    'valida'     => $valida
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marca = DB::table('marca')->where('estado',1)->get();
        $modelo = DB::table('modelo')->where('estado',1)->get();
        $grupo = DB::table('grupo')->where('estado',1)->get();
        $documento = DB::table('documento_venta')->where('estado',1)->get();
        $modo = DB::table('modo_equipo')->where('estado',1)->get();
        $zonas = DB::table('zonas')->select('id', 'nombre', 'dsc_corta')->where('estado', '1')->get();

        return view('forms.equipos.mntEquipos',[
            'marca'     => $marca,
            'modelo'    => $modelo,
            'grupo'     => $grupo,
            'documento' => $documento,
            'modo'      => $modo,
            'zonas'     =>$zonas
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
        $rules = array(            
            'idgrupo'       => 'required',
            'idmarca'       => 'required',
            'idmodelo'      => 'required',
            'descripcion'   => 'required',
           // 'fecha_ingreso' => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
             DB::table('equipos')
            ->insert([
                'idempresa'     => "001",
                'estado'        => 1,
                'idgrupo'       => $request->idgrupo,
                'idmarca'       => $request->idmarca,
                'idmodelo'      => $request->idmodelo,
                'descripcion'   => $request->descripcion,
                'serie_equipo'  => $request->serie_equipo,
                'iddocumento'   => $request->iddocumento,
                'numero_serie'  => $request->numero_serie,
                'fecha_ingreso' => Carbon::createFromFormat('d/m/Y', $request->fecha_ingreso),
                'precio'        => $request->precio,
                'idmodo'        => $request->idmodo,
                'ip'            => $request->ip,
                'mac'           => $request->mac,
                'usuario'       => $request->usuario,
                'contrasena'    => $request->contrasena,
                'SSID'          => $request->SSID,
                'idestado'      => 'SN',
                'idusuario'     => Auth::user()->id,
                //'idZona'        =>$request->zonas,
                'fecha_creacion' => date('Y-m-d h:m:s')
            ]);

            $idusu = Auth::user()->id;
            $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

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

            
            return response()->json(['estado' => 'correcto']);          
        }
    }

    public function storeEmisor(Request $request)
    {
        //dd($request);
        $rules = array(            
            'idgrupo'       => 'required',
            'idmarca'       => 'required',
            'idmodelo'      => 'required',
            'descripcionE'   => 'required', 
            'zonas'         => 'required',   
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
             DB::table('equipos')
            ->insert([
                'idempresa'     => "001",
                'estado'        => 1,
                'idgrupo'       => $request->idgrupo,
                'idmarca'       => $request->idmarca,
                'idmodelo'      => $request->idmodelo,
                'descripcion'   => $request->descripcionE,
                'serie_equipo'  => $request->serie_equipo,
                'iddocumento'   => $request->iddocumento,
                'numero_serie'  => $request->numero_serie, 
                'precio'        => $request->precio,
                'idmodo'        => $request->idmodo,
                'ip'            => $request->ip,
                'mac'           => $request->mac,
                'usuario'       => $request->usuario,
                'contrasena'    => $request->contrasena,
                'SSID'          => $request->SSID,
                'idestado'      => 'SN',
                'idusuario'     => Auth::user()->id,
                'idZona'        =>$request->zonas,
                'fecha_creacion' => date('Y-m-d h:m:s')
            ]);

            $idusu = Auth::user()->id;
            $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

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

            $contador = $price = DB::table('equipos')->max('idequipo');
            
            //dd($contador);
            
           // $equipo = DB::table('equipos')->where('descripcion',$request->descripcion)->get();
           $equipos = DB::table('equipos as e')
           ->select('e.idequipo','e.idestado','e.estado','e.descripcion','e.ip','m.descripcion as marca','mo.descripcion as modelo','md.descripcion as modo')
           ->leftjoin('marca as m', 'm.idmarca', '=', 'e.idmarca')            
           ->leftjoin('modelo as mo', [['m.idmarca', '=', 'mo.idmarca'],['mo.idmodelo','e.idmodelo']]) 
           ->leftjoin('modo_equipo as md', 'md.idmodo', '=', 'e.idmodo') 
           ->where('e.idequipo',$contador) 
           ->get(); 
          // dd($equipos);
          // DB::raw('count(*) as e.idestado') 
            $collection = Collection::make($equipos);
           return response()->json($collection->toJson());   
            //return response()->json(['estado' => 'correcto']);          
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
        $equipos = DB::table('equipos')
                    ->where('idequipo',$id)->get();
        $marca = DB::table('marca')->where('estado',1)->get();
        $modelo = DB::table('modelo')->where('estado',1)->get();
        $grupo = DB::table('grupo')->where('estado',1)->get();
        $documento = DB::table('documento_venta')->where('estado',1)->get();
        $modo = DB::table('modo_equipo')->where('estado',1)->get();
        $zonas = DB::table('zonas')
            ->select('id', 'nombre', 'dsc_corta')
            ->where('estado', '1')
            ->get();

        return view('forms.equipos.edtEquipos',[
            'equipos'   => $equipos,
            'marca'     => $marca,
            'modelo'    => $modelo,
            'grupo'     => $grupo,
            'documento' => $documento,
            'modo'      => $modo,
            'zonas'     =>$zonas
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
         $rules = array(            
            'idgrupo'       => 'required',
            'idmarca'       => 'required',
            'idmodelo'      => 'required',
            'descripcion'   => 'required',
            'fecha_ingreso' => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {  
            DB::table('equipos')
            ->where('idequipo',strval($request->idequipo))
            ->update([
                'idgrupo'       => $request->idgrupo,
                'idmarca'       => $request->idmarca,
                'idmodelo'      => $request->idmodelo,
                'descripcion'   => $request->descripcion,
                'serie_equipo'  => $request->serie_equipo,
                'iddocumento'   => $request->iddocumento,
                'numero_serie'  => $request->numero_serie,
                'fecha_ingreso' => Carbon::createFromFormat('d/m/Y', $request->fecha_ingreso),
                'precio'        => $request->precio,
                'idmodo'        => $request->idmodo,
                'ip'            => $request->ip,
                'mac'           => $request->mac,
                'usuario'       => $request->usuario,
                'contrasena'    => $request->contrasena,
                'idZona'        => $request->zonas,
                'direccion'    => $request->direccion,
                'latitud'    => $request->latitud,
                'longitud'    => $request->longitud,

                'SSID'          => $request->SSID
            ]);

            $idusu = Auth::user()->id;
            $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

            if (count($validacion) > 0) {           
                DB::table('validacion')
                ->where('idusuario',strval($idusu))
                ->update(['valor' => 2]);  
            }

            return response()->json(['estado' => 'correcto']);         
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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

        DB::table('equipos')
            ->where('idequipo',$id)->delete();

        return redirect('/equipos');
    }
}
