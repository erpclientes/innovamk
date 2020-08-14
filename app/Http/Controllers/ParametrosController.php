<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class ParametrosController extends Controller
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

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['PPPOE','DASHBOARD','SISTEMA'])
            ->where('estado',1)->get();

        return view('forms.parametros.frmParametros', [
            'parametros'	=> $parametros,
        	'valida'     	=> $valida
		]);
    }

    public function clientes()
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

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['CLIENTES'])
            ->where('estado',1)->get();

        return view('forms.parametros.frmCliente', [
            'parametros'    => $parametros,
            'valida'        => $valida
        ]);
    }

    public function facturacion()
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

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['FACTURACION'])
            ->where('estado',1)->get();

        return view('forms.parametros.frmFacturacion', [
            'parametros'    => $parametros,
            'valida'        => $valida
        ]);
    }

    public function update(Request $request)
    {
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['PPPOE','DASHBOARD','SISTEMA'])
            ->where('estado',1)->get();

        foreach ($parametros as $value) {
            if ($value->campo_texto == 0) {
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor'     => $request[''.$value->parametro]
                ]);
            }else if($value->campo_texto == 1){
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor_long' => $request[''.$value->parametro]
                ]);
            }
        }
                
        return response()->json(['estado' => 'correcto']);          
    }

    public function updCliente(Request $request)
    {
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['CLIENTES'])
            ->where('estado',1)->get();

        foreach ($parametros as $value) {
            if ($value->campo_texto == 0) {
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor'     => $request[''.$value->parametro]
                ]);
            }else if($value->campo_texto == 1 or $value->campo_texto == 2){
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor_long' => $request[''.$value->parametro]
                ]);
            }
        }
                
        return response()->json(['estado' => 'correcto']);          
    }

    public function updFacturacion(Request $request)
    {
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['FACTURACION'])
            ->where('estado',1)->get();

        foreach ($parametros as $value) {
            if ($value->campo_texto == 0) {
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor'     => $request[''.$value->parametro]
                ]);
            }else if($value->campo_texto == 1){
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor_long' => $request[''.$value->parametro]
                ]);
            }
        }
                
        return response()->json(['estado' => 'correcto']);          
    }
}
