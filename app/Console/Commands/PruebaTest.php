<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Comprobante;

class PruebaTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $notificaciones = DB::table('notificaciones')->get();
        $fecha_actual = new \DateTime();
        $fecha_actual = date_format($fecha_actual,'d/m/Y');
        $fecha_facturacion = null;
        $idrouter = null;
        $usuario = null;
        $key = '';
        $serie = null;
        $numero = null;    
        $iddocumento = null;
        $idcliente = null;
        $fecha_vencimiento = null;
        $idservicio = null;

        $parametros = DB::table('parametros')->where('tipo_parametro','FACTURACION')->get();   
        $clientes = DB::table('clientes')->where('estado',1)->get();  
        $doc_venta = DB::table('documento_venta')->where('estado',1)->get();  

        foreach ($parametros as $val) {
            if ($val->parametro == 'DIA_FECHA_VENC') {
                $fecha_vencimiento = Carbon::now()->addDays($val->valor_long);
            }
        }

        foreach ($clientes as $datos) {
            $key = null;
            $iddocumento = $datos->doc_venta;
            $idcliente = $datos->idcliente;

            $servicios = DB::table('servicio_internet')->where([['idcliente','=', $idcliente],['estado', '=', 1]])->get();
            foreach ($servicios as $servicio) {                
            

            $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ012345678";
            //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
            $length = 10;
            $max = strlen($caracteres) - 1;

            for ($i=0;$i<$length;$i++) {
                $key .= substr($caracteres, rand(0, $max), 1);
            }                

            foreach ($doc_venta as $val) {
                if ($val->iddocumento == $iddocumento) {
                    $serie = $val->serie;
                    $numero = $val->correlativo;    
                }
            }

            $notificaciones = DB::table('notificaciones')->where('idservicio',$servicio->idservicio)->get();
            $fecha_pago = null;
            $fecha_aviso = null;
            $fecha_corte = null;
            $fecha_frecuencia = null;
            $fecha_facturacion = null;
            $fecha_inicio = null;
            $fecha_fin = null;
            $descripcion = null;
            $dsc_perfil = null;
            $vsubida = null;
            $vbajada = null;


            foreach ($notificaciones as $val) {
                $fecha_pago = Carbon::parse($val->fecha_pago);
                $fecha_aviso = Carbon::parse($val->fecha_aviso);
                $fecha_corte = Carbon::parse($val->fecha_corte);
                $fecha_frecuencia = Carbon::parse($val->fecha_frecuencia);
                $fecha_facturacion = Carbon::parse($val->fecha_facturacion);
                $fecha_inicio = Carbon::parse($val->fecha_inicio);
                $fecha_fin = Carbon::parse($val->fecha_fin);
            }
            
            $fecha_actual = new \DateTime();
            $dia =(int) date_format($fecha_actual,'d');
            $mes = (int) date_format($fecha_actual,'m');
            $year = (int) date_format($fecha_actual,'Y');

            $diaN = (int) date_format($fecha_facturacion,'d');
            $mesN = (int) date_format($fecha_facturacion,'m');
            $yearN = (int) date_format($fecha_facturacion,'Y');
            $bandera = false;
//dd($mes);
            if ($mes == $mesN and $year == $yearN) {
                if ($dia >= $diaN) {
                    $bandera = true;
                }
            }else if ($mes > $mesN and $year >= $yearN) {
                if ($dia <= $diaN) {
                    $bandera = true;
                }
            }
           
//dd($bandera);
            if ($bandera) {
                
                $perfil_internet = DB::table('perfiles')->where('idperfil',$servicio->perfil_internet)->get();  
                foreach ($perfil_internet as $perfil) {
                    $dsc_perfil = $perfil->name;
                    $vsubida = $perfil->vsubida;
                    $vbajada = $perfil->vbajada;
                }

                $descripcion = "Servicio de Internet \n Periodo: desde ".date_format($fecha_inicio,'d/m/Y')." hasta ".date_format($fecha_fin,'d/m/Y')." \n Fecha de corte: ".date_format($fecha_corte,'d/m/Y')." \n Plan de Internet: ".$dsc_perfil." \n Descarga: ".$vbajada." \n Subida: ".$vsubida;
                

                DB::table('factura')
                ->insert([  
                    'codigo'            => $key,
                    'idempresa'         => '001',
                    'idestado'          => 'EM',
                    'periodo'           => date('Y-m-d'),
                    'fecha_emision'     => date('Y-m-d'),
                    'fecha_vencimiento' => $fecha_vencimiento,
                    'idcliente'         => $idcliente,
                    'idservicio'        => $servicio->idservicio,
                    'formulario'        => 'ADMINISTRADOR_TAREAS',
                   // 'idusuario'         => (int) Auth::user()->id,
                    'idmoneda'          => $datos->moneda,  
                    'idforma_pago'      => $datos->forma_pago,  
                    'iddocumento'       => $iddocumento,       
                    'serie'             => $serie,  
                    'numero'            => str_pad($numero, 8, "0", STR_PAD_LEFT), 
                    'costo_servicio'    => $servicio->precio, 
                    'subtotal'          => $servicio->precio, 
                    'descuento'         => 0,
                    'subtotal_neto'     => $servicio->precio, 
                    //'impuesto'          => $request->impuesto,   
                    'total'             => $servicio->precio, 
                    'detalle'           => $descripcion,
                    'fecha_inicio'      => date_format($fecha_inicio,'Y-m-d'),
                    'fecha_fin'         => date_format($fecha_fin,'Y-m-d'),
                    'fecha_corte'       => date_format($fecha_corte,'Y-m-d'),
                    'perfil'            => $dsc_perfil,
                    'vbajada'           => $vbajada,
                    'vsubida'           => $vsubida,
                    'fecha_creacion'    => date('Y-m-d h:m:s')
                ]);

                DB::table('dfactura')
                ->insert([     
                    'idfactura'         => $key,  
                    'idservicio'        => $servicio->idservicio,
                    'cantidad'          => 1,
                    'precio'            => $servicio->precio, 
                    'descuento'         => 0,
                    'subtotal'          => $servicio->precio, 
                    //'impuesto'          => $request->impuesto,   
                    'total'             => $servicio->precio, 
                    'descripcion'       => $descripcion
                ]);

                $numero = $numero + 1;
                $numero = str_pad($numero, 8, "0", STR_PAD_LEFT);

                DB::table('documento_venta')
                ->where('iddocumento', $iddocumento)
                ->update(['correlativo' => $numero]);


                //---------------------Actualizar Notificaciones para proxima accion------------------
                
                DB::table('notificaciones')
                ->where('idservicio',$servicio->idservicio)
                ->update([
                    'fecha_pago'        => $fecha_pago->addMonth(),
                    'fecha_aviso'       => $fecha_aviso->addMonth(),
                    'fecha_corte'       => $fecha_corte->addMonth(),
                    'fecha_frecuencia'  => $fecha_frecuencia->addMonth(),
                    'fecha_facturacion' => $fecha_facturacion->addMonth(),
                    'fecha_inicio'      => $fecha_inicio->addMonth(),
                    'fecha_fin'         => $fecha_fin->addMonth()
                ]);   


                //------------------------ENVIAR EMAIL DEL COMPROBANTE------------------------------------
                $idservicio = $servicio->idservicio;      
                $idcliente = $datos->idcliente;
                $factura = DB::table('factura as f')
                    ->select('f.*','d.dsc_corta')
                    ->leftjoin('documento_venta as d','f.iddocumento','=','d.iddocumento')
                    ->where('f.codigo', $key)->get();
            
               
                $cliente = DB::table('clientes')->where('idcliente', $idcliente)->get();
                $servicio = DB::table('servicio_internet')->where('idservicio', $idservicio)->get();
                $notificaciones = DB::table('notificaciones')->where('idservicio', $idservicio)->get();
                $empresa = DB::table('empresa')->get();
                $dfactura = DB::table('dfactura')->where('idfactura',$key)->get();
                

                //Mail::to($datos->correo)->send(new Comprobante($factura,$cliente,$servicio,$notificaciones,$empresa,$dfactura));              

            }

            
        }
        }
        
    }
}
