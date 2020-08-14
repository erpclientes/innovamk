<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function index()
    {
        return view('forms.modelos.index');
    }

    function list() {
        $modelos = DB::table('modelo as m')
            ->select('m.idmodelo', 'm.descripcion', 'm.dsc_corta', 'm.fecha_creacion', 'm.estado', 'ma.idmarca', 'ma.descripcion as marca')
            ->join('marca as ma', 'ma.idmarca', '=', 'm.idmarca')
            ->whereIn('m.estado', [1, 2])
            ->orderBy('m.idmodelo', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $modelos->total(),
            'current_page' => $modelos->currentPage(),
            'per_page'     => $modelos->perPage(),
            'last_page'    => $modelos->lastPage(),
            'from'         => $modelos->firstItem(),
            'to'           => $modelos->lastPage(),
        ],
            'modelos'             => $modelos,
        ];
    }

    public function buscar($descripcion)
    {
        $modelos = DB::table('modelo as m')
            ->select('m.idmodelo', 'm.descripcion', 'm.dsc_corta', 'm.fecha_creacion', 'm.estado', 'ma.idmarca', 'ma.descripcion as marca')
            ->join('marca as ma', 'ma.idmarca', '=', 'm.idmarca')
            ->whereIn('m.estado', [1, 2])
            ->where('m.descripcion', 'like', '%'.$descripcion.'%')
            ->orderBy('m.idmodelo', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $modelos->total(),
            'current_page' => $modelos->currentPage(),
            'per_page'     => $modelos->perPage(),
            'last_page'    => $modelos->lastPage(),
            'from'         => $modelos->firstItem(),
            'to'           => $modelos->lastPage(),
        ],
            'modelos'             => $modelos,
        ];
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
            'idmarca'     => 'required',
        ]);

        DB::table('modelo')
            ->insert([
                'descripcion'    => $request->descripcion,
                'dsc_corta'      => $request->dsc_corta,
                'idmarca'        => $request->idmarca,
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
            'idmarca'     => 'required',
        ]);

        DB::table('modelo')
            ->where('idmodelo', $id)
            ->update([
                'descripcion' => $request->descripcion,
                'dsc_corta'   => $request->dsc_corta,
                'idmarca'     => $request->idmarca,
            ]);
    }

    public function delete($id)
    {
        DB::table('modelo')
            ->where('idmodelo', $id)
            ->update([
                'estado' => '3',
            ]);
    }

    public function disable($id)
    {
        DB::table('modelo')
            ->where('idmodelo', $id)
            ->update([
                'estado' => '2',
            ]);
    }

    public function enable($id)
    {
        DB::table('modelo')
            ->where('idmodelo', $id)
            ->update([
                'estado' => '1',
            ]);
    }
}
