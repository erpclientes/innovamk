<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Auth;
use Carbon\Carbon;

class CorteServicio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corte:servicio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gestión de Corte automatico del Servicio de Internet';

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
      //dd('entro');
        $fecha_actual = new \DateTime();
        $fecha_actual = date_format($fecha_actual,'Y-m-d');
        $fecha_pago = null;
        $fecha_corte = null;
        $tipo_servicio = null;
        $usuario = null;
        $ip = null;
        $nombre = null;
        $idcliente = null;
        $ip_server = null;

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['SISTEMA'])
            ->where('estado',1)->get();

        foreach ($parametros as $val) {
          if($val->parametro == 'ADD_IP_SERVER')
            $ip_server = $val->valor_long;
        }

        $notificaciones = DB::table('notificaciones')->get();
        //$facturas = DB::table('factura')->where('idestado','EM')->get();

        $facturas = DB::table('factura as fac')
        //->select('s.idservicio','s.precio','s.ip','p.name','s.estado','c.razon_social','s.activar_notificacion')
        ->leftjoin('servicio_internet as s','s.idservicio','=','fac.idservicio')
        ->leftjoin('clientes as c','c.idcliente','=','s.idcliente')
        ->leftjoin('perfiles as p','p.idperfil','=','s.perfil_internet')
        //->where('fac.idestado','EM')
        ->where([
          ['s.activar_notificacion','<>',2],
          ['fac.idestado','=','EM'],
          ['c.estado','=',1]
        ])->get();
//dd($facturas);
        foreach ($facturas as $fac) {
          //dd($fac);
          $fecha_corte = $fac->fecha_corte;
          //$servicio = DB::table('servicio_internet')->where(['estado' => 1, 'activar_notificacion' => 0])->get();

          //foreach ($servicio as $val) {
            $fecha_pago = Carbon::now()->addMonth()->day($fac->dia_pago);
            //$fecha_pago = $fecha_pago->format('Y-m-d');
            $tipo_servicio = $fac->tipo_acceso;
            $usuario = $fac->usuario_cliente;
            $ip = $fac->ip;
            $idcliente = $fac->idcliente;            
          //}

          $cliente = DB::table('clientes')->where('idcliente',$idcliente)->get();         

          foreach ($cliente as $clie) {
            $nombre = $clie->nombres.' '.$clie->apaterno.' '.$clie->amaterno;
          }        
            
            $fecha_actual = new \DateTime();
            $dia =(int) date_format($fecha_actual,'d');
            $mes = (int) date_format($fecha_actual,'m');
            $year = (int) date_format($fecha_actual,'Y');
                      

            $fecha_validar = new \DateTime($fac->fecha_corte);
            
            $diaN = (int) date_format($fecha_validar,'d');
            $mesN = (int) date_format($fecha_validar,'m');
            $yearN = (int) date_format($fecha_validar,'Y');
            $bandera = false;

            if ($mes == $mesN and $year == $yearN) {
              if ($dia >= $diaN) {
                $bandera = true;
              }
            }else if ($mes > $mesN and $year >= $yearN) {
              if ($dia >= $diaN) {
                $bandera = true;
              }
            }

          if ($bandera) {
            $router = DB::table('router')->where('idrouter',$fac->idrouter)->get();

            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;
            $lista[] = array($ip);

            foreach ($router as $rou) {
              if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                
                if ($tipo_servicio == 'HST') {                  
                  
                  $ARRAY = $API->comm("/ip/hotspot/user/print");

                  foreach ($ARRAY as $value) {   
                    if ($value['name'] == $usuario) {
                      $ARRAY = $API->comm("/ip/hotspot/user/set", array(
                          "profile"   => 'Corte Morosos',  
                          ".id"       => $value['.id']
                      ));                                                 
                    }
                  }                     
                }else if ($tipo_servicio == 'QUE'){

                  $ARRAY = $API->comm("/queue/simple/print");
                  
                  foreach ($ARRAY as $value) {
                    if ($value['name'] == $nombre) {
                      $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                        "list"      => 'Morosos::InnovaTec',  
                        "address"   => $ip,
                        "comment"   => $nombre
                      ));                                                                               
                    }
                  }   

                  $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/vwCorte"
                  ));

                }else if ($tipo_servicio == 'PCQ'){
                  $ARRAY = $API->comm("/ip/firewall/address-list/print");

                  foreach ($ARRAY as $value) {  
                    if ($value['address'] == $ip) {
                      $ARRAY = $API->comm("/ip/firewall/address-list/set", array(
                          "list"   => 'Morosos::InnovaTec',  
                          ".id"       => $value['.id']
                      ));                                            
                    }else{
                      $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                                "list"      => 'Morosos::InnovaTec',
                                "address"   => $ip,
                                "comment"   => $nombre
                      )); 
                    }
                  }  

                  $ARRAY = $API->comm("/ip/proxy/access/add", array(
                        "src-address" => $ip,  
                        "action"      => "deny",
                        "redirect-to" => $ip_server."/innovamk/public/vwCorte"
                  ));      

                }else if ($tipo_servicio == 'PPP'){
                  $ARRAY = $API->comm("/ppp/secret/print");

                  foreach ($ARRAY as $value) {   
                    if ($value['name'] == $usuario) {
                      $ARRAY = $API->comm("/ip/firewall/address-list/add", array(
                        "list"      => 'Morosos::InnovaTec',  
                        "address"   => $ip,
                        "comment"   => $nombre
                      ));                                            
                    }
                  }  

                           
                }  

                DB::table('servicio_internet')
                  ->where('idservicio',$fac->idservicio)
                  ->update([
                      'activar_notificacion'    => 2
                ]);                                                  
              }       
            } 
          }
          
        }

    }
}
