<?php

namespace App\Http\Controllers;
use DB;
use Validator;

use Illuminate\Http\Request;

class ZonasController extends Controller
{
    public function index (){

        $zonas  =DB::table('zonas')->get();
        $equipos = DB::table('clientes')
        ->select('equipos.modelo','modo_equipo.descripcion', 'dequipos.idequipo','zonas.nombre','equipos.idZona',DB::raw('equipos.descripcion as modeloE'),DB::raw('equipos.latitud as latitudE'), DB::raw('equipos.longitud as longitudE'))
        ->join('servicio_internet', 'servicio_internet.idcliente','=','clientes.idcliente')
        ->join('dequipos', 'dequipos.idservicio', '=', 'servicio_internet.idservicio')
        ->join('equipos', 'equipos.idequipo', '=', 'dequipos.idequipo')
        ->join('modo_equipo', 'modo_equipo.idmodo', '=', 'equipos.idmodo')
        ->join('zonas', 'zonas.id', '=', 'clientes.idZonas')
        ->join('modelo', 'modelo.idmodelo', '=', 'equipos.idmodelo')
        ->where('modo_equipo.descripcion',  'EMISOR') 
        ->get();

      
        $numeroEquipos = array( ); 
        
        return view ('forms.zonas.lstZonas',[
            'zonas'=>$zonas,
            'equipos'=>$equipos
        ]);
    }
    public function destroy($id)
    {
         
        DB::table('zonas')
            ->where('id',$id)->delete();

        return redirect('/zonas');
    }
    public function habilitar ($id){
        //dd($id);
        DB::table('zonas')
        ->where('id',$id)
        ->update([ 
            'estado'            => '1', 
            //'color'             => 'f4f4f4'  
        ]);
        return redirect('/zonas');

    }
    public function desabilitar ($id){
        //dd($id);
        DB::table('zonas')
        ->where('id',$id)
        ->update([ 
            'estado'            => '0', 
            //'color'             => 'f4f4f4'  
        ]);
        return redirect('/zonas');

    }
    public function create (){ 
        return view ('forms.zonas.mntZona');
    }
    public function store ( Request  $request){
       //dd($request); 
        

       $rules = array(  
        'idzona'            => 'required',  
        'nombre'            => 'required', 
         
        );
        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }

    

        DB::table('zonas')
        ->insert([
       
            'id'                => $request->idzona,
            'nombre'            => $request->nombre,
            'descripcion'       => $request->descripcion, 
            'dsc_corta'         => $request->dsCorta, 
            'fecha_creacion'    => date('Y-m-d h:m:s'), 
            'glosa'             => $request->glosa, 
            'estado'            => '1', 
            'color'             => $request->color 

        ]);
        return response()->json("conforme");
        
    }
    public function show($id){

        $zonas = DB::table('zonas')->where('id', $id)->get(); 
            //dd($zonas);
            return view('forms.zonas.edtZona',[
                'zonas' =>$zonas
            ]);
    }
    public function update(Request $request){

        //dd($request);
       
        DB::table('zonas')
        ->where('id',strval($request->idzona))
        ->update([
            'nombre'            => $request->nombre,
            'descripcion'       => $request->descripcion, 
            'dsc_corta'         => $request->dsCorta, 
            'fecha_creacion'    => date('Y-m-d h:m:s'), 
            'glosa'             => $request->glosa, 
            'estado'            => '1', 
            'color'             => $request->color  
        ]);
        return response()->json("conforme");

    }
























    public function recibir(Request $request)
    {  
            session(['color' => $request->colores]); 
    }
    public function pasar(Request $request)
    { 
            $datos = array(); 
            $colores = session('color'); 
            $datos['color'] = $colores; 
           
        return response()->json($datos);
    }
}
