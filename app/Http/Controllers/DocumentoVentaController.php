<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DocumentoVentaController extends Controller
{
    public function index()
    {
        return view('forms.documentoVentas.index');
    }

    function list() {
        $documentos = DB::table('documento_venta')
            ->select('iddocumento', 'descripcion', 'dsc_corta', 'serie', 'correlativo', 'fecha_creacion', 'estado', 'es_boleta', 'es_factura')
            ->whereIn('estado', [1, 2])
            ->orderBy('iddocumento', 'asc')
            ->paginate(10);
        return ['pagination' => [
            'total'        => $documentos->total(),
            'current_page' => $documentos->currentPage(),
            'per_page'     => $documentos->perPage(),
            'last_page'    => $documentos->lastPage(),
            'from'         => $documentos->firstItem(),
            'to'           => $documentos->lastPage(),
        ],
            'documentos'         => $documentos,
        ];
    }

    public function buscar($descripcion)
    {
        $documentos = DB::table('documento_venta')
            ->select('iddocumento', 'descripcion', 'dsc_corta', 'serie', 'correlativo', 'fecha_creacion', 'estado', 'es_boleta', 'es_factura')
            ->whereIn('estado', [1, 2])
            ->where('descripcion', 'like', '%' . $descripcion . '%')
            ->orderBy('iddocumento', 'asc')
            ->paginate(10);
        return ['pagination' => [
            'total'        => $documentos->total(),
            'current_page' => $documentos->currentPage(),
            'per_page'     => $documentos->perPage(),
            'last_page'    => $documentos->lastPage(),
            'from'         => $documentos->firstItem(),
            'to'           => $documentos->lastPage(),
        ],
            'documentos'         => $documentos,
        ];
    }

  
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',
            'dsc_corta'   => 'required',
            'serie'       => 'required',
            'correlativo' => 'required',
        ]);

        DB::table('documento_venta')
            ->insert([
                'descripcion'    => $request->descripcion,
                'dsc_corta'      => $request->dsc_corta,
                'serie'          => $request->serie,
                'correlativo'    => $request->correlativo,
                'es_boleta'      => $request->m_boleta ? '1' : '0',
                'es_factura'     => $request->m_factura ? '1' : '0',
                'fecha_creacion' => date('Y-m-d H:m:s'),
                'estado'         => '1',
            ]);
        return;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'descripcion' => 'required',   'dsc_corta'   => 'required',
            'serie'       => 'required', 

            
            'correlativo' => 'required',
        ]);

        DB::table('documento_venta')
            ->where('iddocumento', $id)
            ->update([
                'descripcion' => $request->descripcion,
                'dsc_corta'   => $request->dsc_corta,
                'serie'       => $request->serie,
                'correlativo' => $request->correlativo,
                'es_boleta'   => $request->m_boleta ? '1' : '0',
                'es_factura'  => $request->m_factura ? '1' : '0',
            ]);
    }

    public function delete($id)
    {
        DB::table('documento_venta')
            ->where('iddocumento', $id)
            ->update([
                'estado' => '3',
            ]);
    }

    public function disable($id)
    {
        DB::table('documento_venta')
            ->where('iddocumento', $id)
            ->update([
                'estado' => '2',
            ]);
    }

    public function enable($id)
    {
        DB::table('documento_venta')
            ->where('iddocumento', $id)
            ->update([
                'estado' => '1',
            ]);
    }
}
