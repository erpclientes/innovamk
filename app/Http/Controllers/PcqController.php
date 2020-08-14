<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class PcqController extends Controller
{
    public function getParent(Request $request)
    {
        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/interface/print");
                $ARRAY2 = $API->comm("/queue/tree/print");
                $collection = Collection::make($ARRAY);
            
            }       
        }

        $cont = count($ARRAY);

        for ($i=0; $i < count($ARRAY2); $i++) { 
        	$cont = $cont + 1;
        	array_push($ARRAY, array('name' => $ARRAY2[$i]['name'])); 
        }

        //dd($ARRAY,$ARRAY2);
                
        return response()->json($ARRAY);   
    }

    public function store(Request $request)
    {
    	//dd($request);
         $rules = array(            
            'pcq_idrouter'          => 'required',
            'pcq_name'              => 'required',
            'pcq_parent1'           => 'required',
            'pcq_parent2'           => 'required',
            //'pcq_limite'            => 'required',
            'pcq_prioridad'			=> 'required',
            'pcq_precio'            => 'required',
            'pcq_vsubida'           => 'required',
            'pcq_vbajada'           => 'required'
            
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
        	$address_list = $request->pcq_name.'::InnovaTec';
        	$pcq_up_name = $request->pcq_vsubida.' up';
        	$pcq_down_name = $request->pcq_vbajada.' down';

            DB::table('perfiles')
            ->insert([
                'idempresa'         => Auth::user()->idempresa,
                'idusuario'         => Auth::user()->id,
                'estado'            => 1,
                'idrouter'          => $request->pcq_idrouter,
                'name'              => $request->pcq_name,
                'precio'            => $request->pcq_precio,
                'vsubida'           => $request->pcq_vsubida,
                'vbajada'           => $request->pcq_vbajada,
                'rate_limit'        => $request->pcq_vsubida.'/'.$request->pcq_vbajada,
                'name_tree'         => $pcq_up_name,
                'name_tree2'        => $pcq_down_name,
                'parent1'           => $request->pcq_parent1,  
                'parent2'           => $request->pcq_parent2,  
                'limite_usu'        => $request->pcq_limite,  
                'prioridad'         => $request->pcq_prioridad,  
                'address_list'      => $address_list,
                'packet_mark'       => $request->pcq_name,
                'pcq_up_name'       => $pcq_up_name,
                'pcq_down_name'     => $pcq_down_name,
                'glosa'             => $request->glosa,  
                'idtipo'            => 'PCQ',        
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            $router = DB::table('router')->where('idrouter',$request->pcq_idrouter)->get();

            foreach ($router as $rou) {
	            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

	            	//----------------Agregar al QUEUE TYPE----------------------
	            	$ARRAY = $API->comm("/queue/type/add", array(
	                    "kind" => 'pcq',                                
	                    "name" => $pcq_down_name,                                
	                    "pcq-classifier" => "dst-address",
	                    "pcq-rate" => $request->pcq_vbajada,	
						"pcq-dst-address6-mask" => 64,
	                    "pcq-src-address6-mask"=> 64
	                )); 

	                $ARRAY = $API->comm("/queue/type/add", array(
	                    "kind" => 'pcq',                                
	                    "name" => $pcq_up_name,                                
	                    "pcq-classifier" => "src-address",
	                    "pcq-rate" => $request->pcq_vsubida,	
						"pcq-dst-address6-mask" => 64,
	                    "pcq-src-address6-mask"=> 64
	                ));   

	                //----------------Agregar al QUEUE TREE----------------------
	                $ARRAY = $API->comm("/queue/tree/add", array(    
	                    "name" => $pcq_down_name,
	                    "packet-mark" => $request->pcq_name,
	                    "parent" => $request->pcq_parent2,	
						"priority" => $request->pcq_prioridad,
	                    "queue"=> $request->pcq_vbajada.' down'
	                )); 
	                $ARRAY = $API->comm("/queue/tree/add", array(
	                    "name" => $pcq_up_name,
	                    "packet-mark" => $request->pcq_name,
	                    "parent" => $request->pcq_parent1,	
						"priority" => $request->pcq_prioridad,
	                    "queue"=> $request->pcq_vsubida.' up'
	                ));   

	                //----------------Agregar al FIREWALL MANGLE----------------------
	                $ARRAY = $API->comm("/ip/firewall/mangle/add", array(   
	                	"action" => "mark-connection", 
	                	"chain" => "prerouting",                             
	                    "new-connection-mark" => $request->pcq_name,
	                    "passthrough" => "yes",	
						"src-address-list" => $address_list
	                )); 
	                $ARRAY = $API->comm("/ip/firewall/mangle/add", array(
	                    "action" => "mark-packet", 
	                	"chain" => "prerouting",                             
	                    "connection-mark" => $request->pcq_name,
	                    "new-packet-mark" => $request->pcq_name,
	                    "passthrough" => "no"
	                ));   
	                    
	            }       
            }
            
            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
            
            return response()->json($collection->toJson());        
        }         
            
    }

    public function store2(Request $request)
    {
    	//dd($request);
         $rules = array(            
            'pcq_idrouter'          => 'required',
            'pcq_name'              => 'required',
            'pcq_parent1'           => 'required',
            'pcq_parent2'           => 'required',
            //'pcq_limite'            => 'required',
            'pcq_prioridad'			=> 'required',
            'pcq_precio'            => 'required',
            'pcq_vsubida'           => 'required',
            'pcq_vbajada'           => 'required'
            
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
        	$address_list = $request->pcq_name.'::InnovaTec';
        	$pcq_up_name = $request->pcq_vsubida.' up';
        	$pcq_down_name = $request->pcq_vbajada.' down';

            DB::table('perfiles')
            ->insert([
                'idempresa'         => '001',
                'estado'            => 1,
                'idrouter'          => $request->pcq_idrouter,
                'name'              => $request->pcq_name,
                'precio'            => $request->pcq_precio,
                'vsubida'           => $request->pcq_vsubida,
                'vbajada'           => $request->pcq_vbajada,
                'rate_limit'        => $request->pcq_vsubida.'/'.$request->pcq_vbajada,
                'name_tree'         => $pcq_up_name,
                'name_tree2'        => $pcq_down_name,
                'parent1'           => $request->pcq_parent1,  
                'parent2'           => $request->pcq_parent2,  
                'limite_usu'        => $request->pcq_limite,  
                'prioridad'         => $request->pcq_prioridad,  
                'address_list'      => $address_list,
                'packet_mark'       => $request->pcq_name,
                'pcq_up_name'       => $pcq_up_name,
                'pcq_down_name'     => $pcq_down_name,
                'glosa'             => $request->glosa,  
                'idtipo'            => 'PCQ',        
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            $router = DB::table('router')->where('idrouter',$request->pcq_idrouter)->get();

            foreach ($router as $rou) {
	            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

	            	//----------------Agregar al QUEUE TYPE----------------------
	            	$ARRAY = $API->comm("/queue/type/add", array(
	                    "kind" => 'pcq',                                
	                    "name" => $pcq_down_name,                                
	                    "pcq-classifier" => "dst-address",
	                    "pcq-rate" => $request->pcq_vbajada,	
						"pcq-dst-address6-mask" => 64,
	                    "pcq-src-address6-mask"=> 64
	                )); 

	                $ARRAY = $API->comm("/queue/type/add", array(
	                    "kind" => 'pcq',                                
	                    "name" => $pcq_up_name,                                
	                    "pcq-classifier" => "src-address",
	                    "pcq-rate" => $request->pcq_vsubida,	
						"pcq-dst-address6-mask" => 64,
	                    "pcq-src-address6-mask"=> 64
	                ));   

	                //----------------Agregar al QUEUE TREE----------------------
	                $ARRAY = $API->comm("/queue/tree/add", array(    
	                    "name" => $pcq_down_name,
	                    "packet-mark" => $request->pcq_name,
	                    "parent" => $request->pcq_parent2,	
						"priority" => $request->pcq_prioridad,
	                    "queue"=> $request->pcq_vbajada.' down'
	                )); 
	                $ARRAY = $API->comm("/queue/tree/add", array(
	                    "name" => $pcq_up_name,
	                    "packet-mark" => $request->pcq_name,
	                    "parent" => $request->pcq_parent1,	
						"priority" => $request->pcq_prioridad,
	                    "queue"=> $request->pcq_vsubida.' up'
	                ));   

	                //----------------Agregar al FIREWALL MANGLE----------------------
	                $ARRAY = $API->comm("/ip/firewall/mangle/add", array(   
	                	"action" => "mark-connection", 
	                	"chain" => "prerouting",                             
	                    "new-connection-mark" => $request->pcq_name,
	                    "passthrough" => "yes",	
						"src-address-list" => $address_list
	                )); 
	                $ARRAY = $API->comm("/ip/firewall/mangle/add", array(
	                    "action" => "mark-packet", 
	                	"chain" => "prerouting",                             
	                    "connection-mark" => $request->pcq_name,
	                    "new-packet-mark" => $request->pcq_name,
	                    "passthrough" => "no"
	                ));   
	                    
	            }       
            }
            
            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
            
            return response()->json($collection->toJson());        
        }         
            
    }

    public function guardarImportPCQ(Request $request)
    {
        //dd($request);
        $cont = $request->pcq_cont;

        for ($i=0; $i <= $cont; $i++) { 
            $perfil = DB::table('perfiles')->where('name', $request['plan'.$i])->get();

            if ( count($perfil) == 0 and !is_null($request['check'.$i])) { 

            	$plan = $request['plan'.$i];
            	$precio = $request['precio'.$i];                
            	$subida = null;
            	$bajada = null;
            	$pcq_up_name = null;
            	$pcq_down_name = null;
                $parent1 = null;
                $parent2 = null;

            	if ($request['pcq_classifier'.$i] == 'dst-address') {            		
            		$bajada = $request['pcq_rate'.$i];
            		$pcq_down_name = $request['name'.$i];                    
            	}else{
            		$subida = $request['pcq_rate'.$i];
            		$pcq_up_name = $request['name'.$i];
            	}


            	for ($a=0; $a < $cont; $a++) { 
            		if (!is_null($request['check'.$a]) and $request['grupo'.$a] == $request['grupo'.$i]) { 
            			$precio = (is_null($precio))? $request['precio'.$a] : $precio;
            			$plan = (is_null($plan))? $request['plan'.$a] : $plan;

            			if ($request['pcq_classifier'.$a] == 'dst-address') {
		            		$bajada = $request['pcq_rate'.$a];
		            		$pcq_down_name = $request['name'.$a];
                            $parent1 = $request['parent'.$a];
                            $name_tree2 = $request['name_tree'.$a];
		            	}else{
		            		$subida = $request['pcq_rate'.$a];
		            		$pcq_up_name = $request['name'.$a];
                            $parent2 = $request['parent'.$a];                            
                            $name_tree = $request['name_tree'.$a];
		            	}
            		}            		
            	}

            	$perfil = DB::table('perfiles')->where('name', $plan)->get();

            	if (count($perfil) == 0) {
            		DB::table('perfiles')
	                ->insert([
	                    'idempresa'         => '001',
		                'estado'            => 1,
		                'idrouter'          => $request->pcq_id_router,
		                'name'              => $plan,
		                'precio'            => $precio,
		                'vsubida'           => $subida,
		                'vbajada'           => $bajada,
		                'rate_limit'        => $subida.'/'.$bajada,
                        'name_tree'         => $name_tree,
                        'name_tree2'        => $name_tree2,
                        'parent1'           => $parent1,  
                        'parent2'           => $parent2,  
		                'pcq_up_name'       => $pcq_up_name,
		                'pcq_down_name'     => $pcq_down_name,
		                'glosa'             => $request->glosa,  
                        'address_list'      => $request["address_list".$i],
                        'packet_mark'       => $request["packet_mark".$i],
		                'idtipo'            => 'PCQ',        
		                'fecha_creacion'    => date('Y-m-d h:m:s')
	            	]);
            	}

            }
            
        }

        $perfil = DB::table('perfiles')->where('name', $request['name'.$i])->get();
        
        return response()->json($perfil);   
    }  

    public function update(Request $request)
    {
        //dd($request);
        $rules = array(            
            'u_pcq_idrouter'          => 'required',
            'u_pcq_name'              => 'required',
            'u_pcq_parent1'           => 'required',
            'u_pcq_parent2'           => 'required',
            //'u_pcq_limite'            => 'required',
            'u_pcq_prioridad'         => 'required',
            'u_pcq_precio'            => 'required',
            'u_pcq_vsubida'           => 'required',
            'u_pcq_vbajada'           => 'required'
            
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            $address_list = null;
            $pcq_up_name = null;
            $pcq_down_name = null;
            
            $router = DB::table('router')->where('idrouter',$request->u_pcq_idrouter)->get();
            
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                    $perfil = DB::table('perfiles')->where('idperfil',$request->u_pcq_idperfil)->get();

                    foreach ($perfil as $val) {  
                        $address_list = $val->address_list;  
                        $pcq_up_name = $val->pcq_up_name;  
                        $pcq_down_name = $val->pcq_down_name;  

                        $ARRAY = $API->comm("/queue/type/print");                              
                        foreach ($ARRAY as $value) {
                            if ($value['name'] == trim($pcq_up_name)) {
                                $ARRAY = $API->comm("/queue/type/remove", array(
                                    ".id"       => $value['.id']  
                                ));                                                                         
                            }
                            if ($value['name'] == trim($pcq_down_name)) {
                                $ARRAY = $API->comm("/queue/type/remove", array(
                                    ".id"       => $value['.id']  
                                ));                                                                         
                            }
                        }  

                        //----------------Eliminar del QUEUE TREE----------------------
                        $ARRAY = $API->comm("/queue/tree/print");                              
                        foreach ($ARRAY as $value) {
                            if ($value['name'] == trim($pcq_up_name)) {
                                $ARRAY = $API->comm("/queue/tree/remove", array(
                                    ".id"       => $value['.id']  
                                ));                                                                         
                            }
                            if ($value['name'] == trim($pcq_down_name)) {
                                $ARRAY = $API->comm("/queue/tree/remove", array(
                                    ".id"       => $value['.id']  
                                ));                                                                         
                            }
                        }  

                        //----------------Eliminar del FIREWALL MANGLE----------------------
                        $ARRAY = $API->comm("/ip/firewall/mangle/print");                                                  
                        foreach ($ARRAY as $value) {
                            //dd($ARRAY,$val->address_list);
                            if (isset($value['new-connection-mark']) and $value['new-connection-mark'] == trim($val->name)) {
                                $ARRAY = $API->comm("/ip/firewall/mangle/remove", array(
                                    ".id"       => $value['.id']  
                                ));                                                                         
                            }
                            if (isset($value['connection-mark']) and $value['connection-mark'] == trim($val->name)) {
                                $ARRAY = $API->comm("/ip/firewall/mangle/remove", array(
                                    ".id"       => $value['.id']  
                                ));                                                                         
                            }
                        }  
                          
                    }                
                }       
            }  
   
            $address_list2 = $address_list;
            $address_list = $request->u_pcq_name.'::InnovaTec';
            $pcq_up_name = $request->u_pcq_vsubida.' up';
            $pcq_down_name = $request->u_pcq_vbajada.' down'; 

            DB::table('perfiles')
            ->where('idperfil',$request->u_pcq_idperfil)
            ->update([
                'idrouter'          => $request->u_pcq_idrouter,
                'name'              => $request->u_pcq_name,
                'precio'            => $request->u_pcq_precio,
                'vsubida'           => $request->u_pcq_vsubida,
                'vbajada'           => $request->u_pcq_vbajada,
                'rate_limit'        => $request->u_pcq_vsubida.'/'.$request->u_pcq_vbajada,
                'name_tree'         => $pcq_up_name,
                'name_tree2'        => $pcq_down_name,
                'parent1'           => $request->u_pcq_parent1,  
                'parent2'           => $request->u_pcq_parent2,  
                'limite_usu'        => $request->u_pcq_limite,  
                'prioridad'         => $request->u_pcq_prioridad,  
                'address_list'      => $address_list,
                'packet_mark'       => $request->u_pcq_name,
                'pcq_up_name'       => $pcq_up_name,
                'pcq_down_name'     => $pcq_down_name,
                'glosa'             => $request->glosa, 
            ]);



            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                    
                    //----------------Modificar ADDRESS LIST---------------------
                    $ARRAY = $API->comm("/ip/firewall/address-list/print");                              
                    foreach ($ARRAY as $value) {
                        if ($value['list'] == trim($address_list2)) {
                            $ARRAY = $API->comm("/ip/firewall/address-list/set", array(
                                ".id"       => $value['.id'],
                                "list"   => $address_list
                            ));                                                                         
                        }
                    }              

                    //----------------Agregar al QUEUE TYPE----------------------
                    $ARRAY = $API->comm("/queue/type/add", array(
                        "kind" => 'pcq',                                
                        "name" => $pcq_down_name,                                
                        "pcq-classifier" => "dst-address",
                        "pcq-rate" => $request->u_pcq_vbajada,    
                        "pcq-dst-address6-mask" => 64,
                        "pcq-src-address6-mask"=> 64
                    )); 

                    $ARRAY = $API->comm("/queue/type/add", array(
                        "kind" => 'pcq',                                
                        "name" => $pcq_up_name,                                
                        "pcq-classifier" => "src-address",
                        "pcq-rate" => $request->u_pcq_vsubida,    
                        "pcq-dst-address6-mask" => 64,
                        "pcq-src-address6-mask"=> 64
                    ));   

                    //----------------Agregar al QUEUE TREE----------------------
                    $ARRAY = $API->comm("/queue/tree/add", array(    
                        "name" => $pcq_down_name,
                        "packet-mark" => $request->u_pcq_name,
                        "parent" => $request->u_pcq_parent2,  
                        "priority" => $request->u_pcq_prioridad,
                        "queue"=> $request->u_pcq_vbajada.' down'
                    )); 
                    $ARRAY = $API->comm("/queue/tree/add", array(
                        "name" => $pcq_up_name,
                        "packet-mark" => $request->u_pcq_name,
                        "parent" => $request->u_pcq_parent1,  
                        "priority" => $request->u_pcq_prioridad,
                        "queue"=> $request->u_pcq_vsubida.' up'
                    ));   

                    //----------------Agregar al FIREWALL MANGLE----------------------
                    $ARRAY = $API->comm("/ip/firewall/mangle/add", array(   
                        "action" => "mark-connection", 
                        "chain" => "prerouting",                             
                        "new-connection-mark" => $request->u_pcq_name,
                        "passthrough" => "yes", 
                        "src-address-list" => $address_list
                    )); 
                    $ARRAY = $API->comm("/ip/firewall/mangle/add", array(
                        "action" => "mark-packet", 
                        "chain" => "prerouting",                             
                        "connection-mark" => $request->u_pcq_name,
                        "new-packet-mark" => $request->u_pcq_name,
                        "passthrough" => "no"
                    ));                  
                }       
            }  

            $perfiles = DB::table('perfiles')->where('idperfil',$request->idperfil)->get();
            $collection = Collection::make($perfiles);
                
            return response()->json($collection->toJson());   
        }
    }
}
