<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        return view('forms.marcas.index');
    }

    function list() {
        $marcas = DB::table('marca as m')
            ->select('m.idmarca', 'm.descripcion', 'm.dsc_corta', 'm.fecha_creacion', 'm.estado', 'g.idgrupo', 'g.descripcion as grupo')
            ->join('grupo as g', 'g.idgrupo', '=', 'm.idgrupo')
            ->whereIn('m.estado', [1, 2])
            ->orderBy('m.idmarca', 'asc')
            ->paginate(3);
         return ['pagination' => [
            'total'        => $marcas->total(),
            'current_page' => $marcas->currentPage(),
            'per_page'     => $marcas->perPage(),
            'last_page'    => $marcas->lastPage(),
            'from'         => $marcas->firstItem(),
            'to'           => $marcas->lastPage(),
        ],
            'marcas'           => $marcas
        ];
    }

    public function buscar($descripcion)
    {
        $marcas = DB::table('marca as m')
            ->select('m.idmarca', 'm.descripcion', 'm.dsc_corta', 'm.fecha_creacion', 'm.estado', 'g.idgrupo', 'g.descripcion as grupo')
            ->join('grupo as g', 'g.idgrupo', '=', 'm.idgrupo')
            ->whereIn('m.estado', [1, 2])
            ->where('m.descripcion', 'like', '%'.$descripcion.'%')
            ->orderBy('m.idmarca', 'asc')
            ->paginate(3);
         return ['pagination' => [
            'total'        => $marcas->total(),
            'current_page' => $marcas->currentPage(),
            'per_page'     => $marcas->perPage(),
            'last_page'    => $marcas->lastPage(),
            'from'         => $marcas->firstItem(),
            'to'           => $marcas->lastPage(),
        ],
            'marcas'           => $marcas
        ];
    }

    public function listSelect()
    {
        $listSelect = DB::table('marca')
            ->select('idmarca', 'descripcion')
            ->where('estado', '1')
            ->orderBy('idmarca', 'desc')
            ->get();
        return ($listSelect);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
            'idgrupo'     => 'required',
        ]);

        DB::table('marca')
            ->insert([
                'descripcion'    => $request->descripcion,
                'dsc_corta'      => $request->dsc_corta,
                'idgrupo'        => $request->idgrupo,
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
            'idgrupo'     => 'required',
        ]);

        DB::table('marca')
            ->where('idmarca', $id)
            ->update([
                'descripcion' => $request->descripcion,
                'dsc_corta'   => $request->dsc_corta,
                'idgrupo'     => $request->idgrupo,
            ]);
    }

    public function delete($id)
    {
        DB::table('marca')
            ->where('idmarca', $id)
            ->update([
                'estado' => '3',
            ]);
    }

    public function disable($id)
    {
        DB::table('marca')
            ->where('idmarca', $id)
            ->update([
                'estado' => '2',
            ]);
    }

    public function enable($id)
    {
        DB::table('marca')
            ->where('idmarca', $id)
            ->update([
                'estado' => '1',
            ]);
    }
}
