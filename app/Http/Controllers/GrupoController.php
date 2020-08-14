<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        return view('forms.grupos.index');
    }

    function list(Request $request) {
        $grupos = DB::table('grupo')
            ->select('idgrupo', 'descripcion', 'dsc_corta', 'fecha_creacion', 'estado')
            ->whereIn('estado', [1, 2])
            ->orderBy('idgrupo', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $grupos->total(),
            'current_page' => $grupos->currentPage(),
            'per_page'     => $grupos->perPage(),
            'last_page'    => $grupos->lastPage(),
            'from'         => $grupos->firstItem(),
            'to'           => $grupos->lastPage(),
        ],
            'grupos'           => $grupos
        ];
    }

    public function buscar($descripcion)
    {
        $grupos = DB::table('grupo')
            ->select('idgrupo', 'descripcion', 'dsc_corta', 'fecha_creacion', 'estado')
            ->whereIn('estado', [1, 2])
            ->where('descripcion', 'like', '%'.$descripcion.'%')
            ->orderBy('idgrupo', 'asc')         
            ->paginate(3);
        return ['pagination' => [
            'total'        => $grupos->total(),
            'current_page' => $grupos->currentPage(),
            'per_page'     => $grupos->perPage(),
            'last_page'    => $grupos->lastPage(),
            'from'         => $grupos->firstItem(),
            'to'           => $grupos->lastPage(),
        ],
            'grupos'           => $grupos
        ];
    }

    public function listSelect()
    {
        $listSelect = DB::table('grupo')
            ->select('idgrupo', 'descripcion')
            ->where('estado', '1')
            ->orderBy('idgrupo', 'desc')
            ->get();
        return ($listSelect);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
        ]);

        DB::table('grupo')
            ->insert([
                'descripcion'    => $request->descripcion,
                'dsc_corta'      => $request->dsc_corta,
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

        DB::table('grupo')
            ->where('idgrupo', $id)
            ->update([
                'descripcion' => $request->descripcion,
                'dsc_corta'   => $request->dsc_corta,
            ]);
    }

    public function delete($id)
    {
        DB::table('grupo')
            ->where('idgrupo', $id)
            ->update([
                'estado' => '3',
            ]);
    }

    public function disable($id)
    {
        DB::table('grupo')
            ->where('idgrupo', $id)
            ->update([
                'estado' => '2',
            ]);
    }

    public function enable($id)
    {
        DB::table('grupo')
            ->where('idgrupo', $id)
            ->update([
                'estado' => '1',
            ]);
    }
}
