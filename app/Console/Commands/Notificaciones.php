<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Auth;
use Carbon\Carbon;

class Notificaciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificaciones:automaticas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatización de Avisos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fecha_actual = new \DateTime();
        $fecha_actual = date_format($fecha_actual,'Y-m-d');
        $fecha_aviso = null;
        $ip = null;
        $nombre = null;
        $idcliente = null;
        $aviso = 0;
        $corte = 0;
        $dia_pago = 0;
        $ip_server = null;

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['SISTEMA'])
            ->where('estado',1)->get();

        foreach ($parametros as $val) {
          if($val->parametro == 'ADD_IP_SERVER')
            $ip_server = $val->valor_long;
        }

        $notificaciones = DB::table('notificaciones')->get();
        $servicio = DB::table('servicio_internet as s')
          //->leftjoin('factura as f','f.idservicio','s.idservicio')
          //->leftjoin('notificaciones as n','n.idservicio','s.idservicio')
          ->where([
            's.estado' => 1, 
            's.activar_notificacion' => 0,
            //'f.idestado' => 'EM',
            //'n.aviso' => 2
          ])
          ->get();
//dd($servicio);
        foreach ($servicio as $serv) {
          foreach ($notificaciones as $not) {
            if ($not->idservicio == $serv->idservicio) {
              $dia_pago = $serv->dia_pago;
              $aviso = $not->aviso;
              $corte = (int) $not->corte;
            }
          }

          //$fecha_aviso = Carbon::now()->day($aviso);
          //$fecha_aviso = $fecha_aviso->format('Y-m-d');
          $ip = $serv->ip;
          $idcliente = $serv->idcliente;

          $fecha_actual = new \DateTime();
          $dia =(int) date_format($fecha_actual,'d');
          $mes = (int) date_format($fecha_actual,'m');
          $year = (int) date_format($fecha_actual,'Y');

          $fecha_aviso = Carbon::now()->day($dia_pago)->subDay($aviso);
          //dd($fecha_validar);
          $diaN = (int) date_format($fecha_aviso,'d');
          $mesN = (int) date_format($fecha_aviso,'m');
          $yearN = (int) date_format($fecha_aviso,'Y');

          $fecha_corte = Carbon::now()->day($dia_pago)->addDay($corte);
          //$fecha_corte = $fecha_corte->addDay($corte);
          //dd($fecha_validar);
          $diaC = (int) date_format($fecha_corte,'d');
          $mesC = (int) date_format($fecha_corte,'m');
          $yearC = (int) date_format($fecha_corte,'Y');
          $bandera = false;

          if ($mes == $mesN and $mes == $mesC) {
            //dd('entro');
                if ($dia >= $diaN and $dia < $diaC ) {
                    $bandera = true;
                }
          }elseif ($mes > $mesN and $mes == $mesC){
              if ($dia < $diaC ) {
                  $bandera = true;
              }
          }elseif ($mes == $mesN and $mes > $mesC){
              if ($dia >= $diaN ) {
                  $bandera = true;
              }
          }
          
          if ($bandera) {
            $idrouter = $serv->idrouter;
            $idperfil = $serv->perfil_internet; 
            $usuario = $serv->usuario_cliente;
            $ip = $serv->ip;

            $router = DB::table('router')->where('idrouter',$idrouter)->get();

            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $cliente = DB::table('clientes')->where(['idcliente' => $serv->idcliente, 'estado' => 1])->get();
                    $nombre = null;

                    foreach ($cliente as $val) {
                        $nombre = $val->nombres.' '.$val->apaterno.' '.$val->amaterno;
                    }

                    $perfil = DB::table('perfiles')->where('idperfil',$idperfil)->get();

                    foreach ($perfil as $val) {                    

                        if( trim($val->idtipo) == "HST" ){ 
                            //Logica por desarrollar
                                
                        }else if(trim($val->idtipo) == "QUE"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $ip,
                                "comment"   => $nombre
                            ));    

                            $ARRAY = $API->comm("/ip/proxy/access/add", array(
                              "src-address" => $ip,  
                              "action"      => "deny",
                              "redirect-to" => $ip_server."/innovamk/public/aviso"
                            ));   
                        }else if(trim($val->idtipo) == "PCQ"){  
                        //dd('entro');                                                      
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $ip,
                                "comment"   => $nombre
                            )); 

                            $ARRAY = $API->comm("/ip/proxy/access/add", array(
                              "src-address" => $ip,  
                              "action"      => "deny",
                              "redirect-to" => $ip_server."/innovamk/public/aviso"
                            ));                                       
                        }else if(trim($val->idtipo) == "PPP"){
                            $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Notificacion::InnovaTec',  
                                "address"   => $ip,
                                "comment"   => $nombre
                            ));   

                            $ARRAY = $API->comm("/ip/proxy/access/add", array(
                              "src-address" => $ip,  
                              "action"      => "deny",
                              "redirect-to" => $ip_server."/innovamk/public/aviso"
                            ));    
                                                        
                        }

                        DB::table('servicio_internet')
                        ->where('idservicio',$serv->idservicio)
                        ->update([
                            'activar_notificacion'    => 1
                        ]); 
                    }                
                }       
            }

            
          }

        }

    }
}
