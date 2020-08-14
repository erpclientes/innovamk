<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TipoMonedaController extends Controller
{
    public function index()
    {
        return view('forms.tipoMonedas.index');
    }

    function list() {
        $tipo_monedas = DB::table('tipo_moneda')
            ->select('idmoneda', 'descripcion', 'dsc_corta', 'fecha_creacion', 'estado')
            ->whereIn('estado', [1, 2])
            ->orderBy('idmoneda', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $tipo_monedas->total(),
            'current_page' => $tipo_monedas->currentPage(),
            'per_page'     => $tipo_monedas->perPage(),
            'last_page'    => $tipo_monedas->lastPage(),
            'from'         => $tipo_monedas->firstItem(),
            'to'           => $tipo_monedas->lastPage(),
        ],
            'tipo_monedas'             => $tipo_monedas,
        ];
    }

    public function buscar($descripcion)
    {
        $tipo_monedas = DB::table('tipo_moneda')
            ->select('idmoneda', 'descripcion', 'dsc_corta', 'fecha_creacion', 'estado')
            ->whereIn('estado', [1, 2])
            ->where('descripcion', 'like', '%'.$descripcion.'%')
            ->orderBy('idmoneda', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $tipo_monedas->total(),
            'current_page' => $tipo_monedas->currentPage(),
            'per_page'     => $tipo_monedas->perPage(),
            'last_page'    => $tipo_monedas->lastPage(),
            'from'         => $tipo_monedas->firstItem(),
            'to'           => $tipo_monedas->lastPage(),
        ],
            'tipo_monedas'             => $tipo_monedas,
        ];
    }

    public function listSelect()
    {
        $listSelect = DB::table('tipo_moneda')
            ->select('idmoneda', 'descripcion')
            ->where('estado', '1')
            ->orderBy('idmoneda', 'desc')
            ->get();
        return ($listSelect);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
        ]);

        DB::table('tipo_moneda')
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

        DB::table('tipo_moneda')
            ->where('idmoneda', $id)
            ->update([
                'descripcion' => $request->descripcion,
                'dsc_corta'   => $request->dsc_corta,
            ]);
    }

    public function delete($id)
    {
        DB::table('tipo_moneda')
            ->where('idmoneda', $id)
            ->update([
                'estado' => '3',
            ]);
    }

    public function disable($id)
    {
        DB::table('tipo_moneda')
            ->where('idmoneda', $id)
            ->update([
                'estado' => '2',
            ]);
    }

    public function enable($id)
    {
        DB::table('tipo_moneda')
            ->where('idmoneda', $id)
            ->update([
                'estado' => '1',
            ]);
    }
}
