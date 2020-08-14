<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use MaestroController as Maestro;
use Illuminate\Support\Collection as Collection;
use Validator;

class RouterController extends Controller
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

        $router = DB::table('router')->get();
        $tipo = DB::table('tipo_acceso')->get();

        return view('forms.router.lstRouter', [
                    'router'    => $router,
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key = new MaestroController();
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

        $rules = array(      
            'idrouter'      => 'required|min:3',
            'usuario'       => 'required|max:50',
            'ip'            => 'required',
            'alias'         => 'required|max:30',
            //'password'      => 'required|max:50'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          

        DB::table('router')
        ->insert([
            'idempresa'     => "001",
            'activo'        => 1,
            'idrouter'      => $request->idrouter,
            'alias'         => $request->alias,
            'ip'            => $request->ip,
            'usuario'       => $request->usuario,
            'password'      => $request->password,
            'puerto'        => (empty($request->puerto))? 9728 : $request->puerto,
            'fecha_creacion' => date('Y-m-d')
        ]);

        DB::table('tipo_acceso')
        ->insert([
            'idempresa'     => "001",
            'idtipo'        => $key->codigoN(3),            
            'idrouter'      => $request->idrouter,
            'descripcion'   => 'Configuración HotSpot',
            'dsc_corta'     => 'HST',
            'estado'        => 0,
            'fecha_creacion' => date('Y-m-d')
        ]);
        DB::table('tipo_acceso')
        ->insert([
            'idempresa'     => "001",
            'idtipo'        => $key->codigoN(3),            
            'idrouter'      => $request->idrouter,
            'descripcion'   => 'Configuración QUEUES',
            'dsc_corta'     => 'QUE',
            'estado'        => 0,
            'fecha_creacion' => date('Y-m-d')
        ]);
        DB::table('tipo_acceso')
        ->insert([
            'idempresa'     => "001",
            'idtipo'        => $key->codigoN(3),            
            'idrouter'      => $request->idrouter,
            'descripcion'   => 'Configuración PPPoE',
            'dsc_corta'     => 'PPP',
            'estado'        => 0,
            'fecha_creacion' => date('Y-m-d')
        ]);
        DB::table('tipo_acceso')
        ->insert([
            'idempresa'     => "001",
            'idtipo'        => $key->codigoN(3),            
            'idrouter'      => $request->idrouter,
            'descripcion'   => 'Configuración PCQ',
            'dsc_corta'     => 'PCQ',
            'estado'        => 0,
            'fecha_creacion' => date('Y-m-d')
        ]);

        
        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();        
        $data['success'] = $router;

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $router = DB::table('router')
                    ->where('idrouter',$id)->get();

        $tipo = DB::table('tipo_acceso')->where('idrouter',$id)->get();

        return view('forms.router.frmRouter', [
            'router'    => $router,
            'tipo'      => $tipo
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
        $rules = array(  
            'usuario'       => 'required',
            'ip'            => 'required|max:50',
            'alias'         => 'required|max:30',
            //'password'      => 'required|max:50'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          

        DB::table('router')
        ->where('idrouter',strval($request->idrouter))
        ->update([
            'alias'         => $request->alias,
            'ip'            => $request->ip,
            'usuario'       => $request->usuario,
            'password'      => $request->password,
            'puerto'        => (empty($request->puerto))? 9728 : $request->puerto
        ]);

        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();        
        $data['success'] = $router;

        return $data;
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

        DB::table('router')
            ->where('idrouter',$id)->delete();

        DB::table('tipo_acceso')
            ->where('idrouter',$id)->delete();

        return redirect('/router');
    }

    public function prueba(){
        $ipRouteros="172.168.0.1";  // tu RouterOS.
          $Username="leo";
          $Pass="l3o1988";
          $api_puerto=8728;

          $API = new routeros_api();
          $API->debug = false;

          if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {

            $API->write("/ip/dhcp-server/lease/getall", true);
            $READ = $API->read(false);
            $ARRAY = $API->parse_response($READ);

            dd($ARRAY);
        }
   
    }

    public function reiniciar(Request $request)
    {
        //dd($request);
        $router = DB::table('router')->where('idrouter', $request->codigo)->get();
        $API = new routeros_api();
        $API->debug = false;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $API->write("/system/reboot", true);
                $READ = $API->read(false);
                $ARRAY = $API->parse_response($READ);

                dd($ARRAY);
            }else{
                return response()->json(array('errors'=> 'EXISTE'));
            }
        }

        
        $collection = Collection::make($router);
                
        return response()->json($collection->toJson());   
    }

    public function apagar(Request $request)
    {
        //dd($request);
        $router = DB::table('router')->where('idrouter', $request->codigo)->get();
        $API = new routeros_api();
        $API->debug = false;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $API->write("/system/shutdown", true);
                $READ = $API->read(false);
                $ARRAY = $API->parse_response($READ);

                dd($ARRAY);
            }else{
                return response()->json(array('errors'=> 'EXISTE'));
            }
        }

        
        $collection = Collection::make($router);
                
        return response()->json($collection->toJson());   
    }

    public function verificarID(Request $request)
    {
        //dd($request);
        $router = DB::table('router')->where('idrouter', $request->codigo)->get();

        if(count($router) > 0){
            return response()->json(array('errors'=> 'EXISTE'));
        }
        
        $collection = Collection::make($router);
                
        return response()->json($collection->toJson());   
    }
}
