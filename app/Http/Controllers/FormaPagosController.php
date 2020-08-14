<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class FormaPagosController extends Controller
{
    public function index()
    {
        return view('forms.formaPagos.index');
    }

    function list() {
        $pagos = DB::table('forma_pagos')
            ->select('idforma_pago', 'descripcion', 'dsc_corta', 'fecha_creacion', 'estado')
            ->whereIn('estado', [1, 2])
            ->orderBy('idforma_pago', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $pagos->total(),
            'current_page' => $pagos->currentPage(),
            'per_page'     => $pagos->perPage(),
            'last_page'    => $pagos->lastPage(),
            'from'         => $pagos->firstItem(),
            'to'           => $pagos->lastPage(),
        ],
            'pagos'             => $pagos,
        ];
    }

    public function buscar($descripcion)
    {
        $pagos = DB::table('forma_pagos')
            ->select('idforma_pago', 'descripcion', 'dsc_corta', 'fecha_creacion', 'estado')
            ->whereIn('estado', [1, 2])
            ->where('descripcion', 'like', '%'.$descripcion.'%')
            ->orderBy('idforma_pago', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $pagos->total(),
            'current_page' => $pagos->currentPage(),
            'per_page'     => $pagos->perPage(),
            'last_page'    => $pagos->lastPage(),
            'from'         => $pagos->firstItem(),
            'to'           => $pagos->lastPage(),
        ],
            'pagos'             => $pagos,
        ];
    }

    public function listSelect()
    {
        $listSelect = DB::table('forma_pagos')
            ->select('idforma_pago', 'descripcion')
            ->where('estado', '1')
            ->orderBy('idforma_pago', 'desc')
            ->get();
        return ($listSelect);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
        ]);

        DB::table('forma_pagos')
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

        DB::table('forma_pagos')
            ->where('idforma_pago', $id)
            ->update([
                'descripcion' => $request->descripcion,
                'dsc_corta'   => $request->dsc_corta,
            ]);
    }

    public function delete($id)
    {
        DB::table('forma_pagos')
            ->where('idforma_pago', $id)
            ->update([
                'estado' => '3',
            ]);
    }

    public function disable($id)
    {
        DB::table('forma_pagos')
            ->where('idforma_pago', $id)
            ->update([
                'estado' => '2',
            ]);
    }

    public function enable($id)
    {
        DB::table('forma_pagos')
            ->where('idforma_pago', $id)
            ->update([
                'estado' => '1',
            ]);
    }
}
