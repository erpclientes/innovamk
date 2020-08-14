<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;


class IncidenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = DB::table('incidencias')->where('estado',1)->get();

        //dd($test);

        return view('forms.pruebas.incidencias',[
            'test'      => $test
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $key = new MaestroController();
        $idusu = Auth::user()->id;
        $validacion = DB::table('incidencias')->where('idusuario',$idusu)->get();

        DB::table('licencia')
        ->insert([
            'idempresa'         => $request->empresa,
            'idlicencia'        => $key->codigoN(10),
            'titulo'            => $request->titulo,
            'prioridad'         => 1,
            'descripcion'       => $request->descripcion,
            'prioridad'         => $request->prioridad,
            'Imagen'            => $request->imagen,
            'estado'            => 1,
            'fecha_creacion'    => date('Y-m-d h:m:s'),
            'glosa'             => $request->glosa,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
