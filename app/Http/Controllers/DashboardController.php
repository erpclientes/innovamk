<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Collection as Collection;
use Validator;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function finanzas()
    {
        $fecha_actual = new Carbon();
        $fecha_actual = $fecha_actual->format('Y-m-d');
        $lunes_semana_actual = new Carbon('last monday');
        $lunes_semana_actual = $lunes_semana_actual->format('Y-m-d');
        $fecha_inicio_mes =  Carbon::now()->day(1);
        $fecha_inicio_mes = $fecha_inicio_mes->subDay();
        $fecha_fin = Carbon::now()->endOfMonth();

        $ingreso_total_hoy = 0;
        $ingreso_total_mes = 0;
        $ingresos_por_cobrar = 0;

        
                
        //Total de ingresos por dia
        $facturas = DB::table('factura')->where('idestado','PA')->whereDate('fecha_pago',$fecha_actual)->get();
        foreach ($facturas as $fac) {
            $ingreso_total_hoy = $ingreso_total_hoy + $fac->total;
        }

        //Total de ingresos mensual
        //$facturas = DB::table('factura')->where('idestado','PA')->whereBetween('fecha_pago',array($fecha_inicio_mes,$fecha_actual))->get();
        $facturas = DB::table('factura')->where('idestado','PA')
            ->where([
                ['fecha_pago','>=',$fecha_inicio_mes],
                ['fecha_pago','<=',$fecha_fin],
                ['idestado','=','PA']
            ])->get();
        foreach ($facturas as $fac) {
            $ingreso_total_mes = $ingreso_total_mes + $fac->total;
        }

        //Total de ingresos por cobrar
        //$facturas = DB::table('factura')->where('idestado','EM')->whereBetween('fecha_corte',array($fecha_inicio_mes,$fecha_actual))->get();
        $facturas = DB::table('factura')->where('idestado','EM')->get();
        foreach ($facturas as $fac) {
            $ingresos_por_cobrar = $ingresos_por_cobrar + $fac->total;
        }


        $comprobantes = DB::table('factura as f')
                ->select('f.*')
                ->leftjoin('clientes as c', 'c.nro_documento', '=', 'f.idcliente')    
                ->where(['f.idestado' => 'EM'])->limit(7)->get();
        $forma_pagos = DB::table('forma_pagos')
                ->select('idforma_pago', 'descripcion', 'dsc_corta')
                ->where('estado', '1')
                ->get();
        $tipo_documento_venta = DB::table('documento_venta')
                ->where('estado', '1')
                ->get();

        //Total de ingresos por dia
        $pagados = DB::table('factura as fac')
            ->select('c.razon_social','fac.fecha_pago')
            ->leftjoin('clientes as c','c.idcliente','fac.idcliente')           
            ->where([
                ['fac.idestado','=','PA'],
                ['fac.fecha_pago','>=',$fecha_inicio_mes]
            ]) 
            ->limit(5)          
            ->get();
        
//dd($pagados,$fecha_actual);

        return view('forms.dashboard.finanzas.ini',[
            'comprobantes'          => $comprobantes,
            'forma_pagos'           => $forma_pagos,
            'tipo_documento_venta'  => $tipo_documento_venta,
            'ingreso_total_hoy'     => $ingreso_total_hoy,
            'ingreso_total_mes'     => $ingreso_total_mes,
            'ingresos_por_cobrar'   => $ingresos_por_cobrar,
            'pagados'               => $pagados
        ]);
    } 
}
