<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index()
    {
        return view('forms.documentos.index');
    }

    function list() {
        $documentos = DB::table('documento')
            ->select('iddocumento', 'descripcion', 'dsc_corta', 'longitud_caracteres', 'fecha_creacion', 'estado')
            ->whereIn('estado', [1, 2])
            ->orderBy('iddocumento', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $documentos->total(),
            'current_page' => $documentos->currentPage(),
            'per_page'     => $documentos->perPage(),
            'last_page'    => $documentos->lastPage(),
            'from'         => $documentos->firstItem(),
            'to'           => $documentos->lastPage(),
        ],
            'documentos'             => $documentos,
        ];
    }

    public function buscar($descripcion)
    {
        $documentos = DB::table('documento')
            ->select('iddocumento', 'descripcion', 'dsc_corta', 'longitud_caracteres', 'fecha_creacion', 'estado')
            ->whereIn('estado', [1, 2])
            ->where('descripcion', 'like', '%'.$descripcion.'%')
            ->orderBy('iddocumento', 'asc')
            ->paginate(3);
        return ['pagination' => [
            'total'        => $documentos->total(),
            'current_page' => $documentos->currentPage(),
            'per_page'     => $documentos->perPage(),
            'last_page'    => $documentos->lastPage(),
            'from'         => $documentos->firstItem(),
            'to'           => $documentos->lastPage(),
        ],
            'documentos'             => $documentos,
        ];
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
        ]);

        DB::table('documento')
            ->insert([
                'descripcion'         => $request->descripcion,
                'dsc_corta'           => $request->dsc_corta,
                'longitud_caracteres' => $request->longitud_caracteres,
                'fecha_creacion'      => date('Y-m-d H:m:s'),
                'estado'              => '1',
            ]);
        return;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
        ]);

        DB::table('documento')
            ->where('iddocumento', $id)
            ->update([
                'descripcion'         => $request->descripcion,
                'longitud_caracteres' => $request->longitud_caracteres,
                'dsc_corta'           => $request->dsc_corta,
            ]);
    }

    public function delete($id)
    {
         
        DB::table('documento')
            ->where('iddocumento', $id)
            ->update([
                'estado' => '3',
            ]);
    }

    public function disable($id)
    {
        DB::table('documento')
            ->where('iddocumento', $id)
            ->update([
                'estado' => '2',
            ]);
    }

    public function enable($id)
    {
        DB::table('documento')
            ->where('iddocumento', $id)
            ->update([
                'estado' => '1',
            ]);
    }
}
