<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ModoEquipoController extends Controller
{
    public function index()
    {
        return view('forms.modos.index');
    }

    function list() {
        $modos = DB::table('modo_equipo')
            ->select('idmodo', 'descripcion', 'dsc_corta', 'fecha_creacion', 'estado', 'es_emisor', 'es_cliente', 'es_router')
            ->whereIn('estado', [1, 2])
            ->orderBy('idmodo', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $modos->total(),
            'current_page' => $modos->currentPage(),
            'per_page'     => $modos->perPage(),
            'last_page'    => $modos->lastPage(),
            'from'         => $modos->firstItem(),
            'to'           => $modos->lastPage(),
        ],
            'modos'             => $modos,
        ];
    }

    public function buscar($descripcion)
    {
        $modos = DB::table('modo_equipo')
            ->select('idmodo', 'descripcion', 'dsc_corta', 'fecha_creacion', 'estado', 'es_emisor', 'es_cliente', 'es_router')
            ->whereIn('estado', [1, 2])
            ->where('descripcion', 'like', '%'.$descripcion.'%')
            ->orderBy('idmodo', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $modos->total(),
            'current_page' => $modos->currentPage(),
            'per_page'     => $modos->perPage(),
            'last_page'    => $modos->lastPage(),
            'from'         => $modos->firstItem(),
            'to'           => $modos->lastPage(),
        ],
            'modos'             => $modos,
        ];
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
        ]);

        DB::table('modo_equipo')
            ->insert([
                'descripcion'    => $request->descripcion,
                'dsc_corta'      => $request->dsc_corta,
                'es_emisor'      => $request->m_emisor ? '1' : '0',
                'es_cliente'     => $request->m_cliente ? '1' : '0',
                'es_router'      => $request->m_router ? '1' : '0',
                'fecha_creacion' => date('Y-m-d H:m:s'),
                'estado'         => '1',
            ]);
        return;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
        ]);

        DB::table('modo_equipo')
            ->where('idmodo', $id)
            ->update([
                'descripcion' => $request->descripcion,
                'dsc_corta'   => $request->dsc_corta,
                'es_emisor'   => $request->m_emisor ? '1' : '0',
                'es_cliente'  => $request->m_cliente ? '1' : '0',
                'es_router'   => $request->m_router ? '1' : '0',
            ]);
    }

    public function delete($id)
    {
        DB::table('modo_equipo')
            ->where('idmodo', $id)
            ->update([
                'estado' => '3',
            ]);
    }

    public function disable($id)
    {
        DB::table('modo_equipo')
            ->where('idmodo', $id)
            ->update([
                'estado' => '2',
            ]);
    }

    public function enable($id)
    {
        DB::table('modo_equipo')
            ->where('idmodo', $id)
            ->update([
                'estado' => '1',
            ]);
    }
}
