<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Auth;
use Validator;

class documentosAdjuntosController extends Controller
{
    public function index(){

    }
    public function create(){

    }
    public function destroy($id)
    {
        //dd($id);
        $idcliente = session('idcliente');
       // return redirect('/clientes' ); 
        DB::table('documentos_adjuntos')
        ->where('iddocumento',strval($id))
        ->update([ 
            'estado'            => '0',  
        ]);
        return redirect('/cliente/'.$idcliente); 
    }
    public function store(Request $request){
               //dd($request); 

            $rules = array(      
                'archivo'                => 'required',
                'iddocumento'            => 'required|string|',
                'descripcionAdj'            => 'required|string|', 
            );
            $validator = Validator::make ( $request->all(), $rules );

            if ($validator->fails()){
                $var = $validator->getMessageBag()->toarray();
                array_push($var, 'error');
                //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
                return response()->json($var);
            }

            $descripcion= $request->descripcionAdj; 
            $glosa= $request->glosa; 
            $nombre= $request->text;  
            $iddocumento= $request->iddocumento;
            $idcliente= $request->idcliente;
            $idempresa= $request->idempresa;

           //dd( $descripcion  );
            //Validamos que el archivo exista
            if($_FILES["archivo"]["name"]) {
                //dd("ingreso");
                $filename = $_FILES["archivo"]["name"]; //Obtenemos el nombre original del archivo
                $source = $_FILES["archivo"]["tmp_name"]; //Obtenemos un nombre temporal del archivo
                //dd($filename);
                
                //$directorio = 'docs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos 
                $directorio = ''; 
                $carpeta ='';
                $extencion = $_FILES["archivo"]["type"];
                //dd($extencion); 
                if ($extencion == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                    $extencion = 'DOCX';
                    $directorio = 'documentosAdj/word';
                    $carpeta='word';
                } 
                if ($extencion == "image/jpeg") {
                    $extencion = 'JPG';
                    $directorio = 'documentosAdj/imagen'; 
                    $carpeta='imagen';
                }
                if ($extencion == "image/png") {
                    $extencion = 'PNG';
                    $directorio = 'documentosAdj/imagen';
                    $carpeta='imagen';

                }
                if ($extencion == "application/pdf") {
                    $extencion = 'PDF';
                    $directorio = 'documentosAdj/pdf';
                    $carpeta='pdf';

                }
                if ($extencion == "application/x-zip-compressed") {
                    $extencion = 'ZIP';
                    $directorio = 'documentosAdj/zip';
                    $carpeta='zip';

                }
                if ($extencion == "application/octet-stream") {
                    $extencion = 'RAR';
                    $directorio = 'documentosAdj/zip';
                    $carpeta='zip';

                }
                //dd($extencion);
                
                 //Indicamos la ruta de destino, así como el nombre del archivo 
                //Movemos y validamos que el archivo se haya cargado correctamente
                //El primer campo es el origen y el segundo el destino
                if( $extencion == 'PNG'or'DOCX'or'JPG'or'PDF'or'ZIP'OR 'RAR') {
                   // dd("ingreso");
                    //Validamos si la ruta de destino existe, en caso de no existir la creamos
                    if(!file_exists($directorio)){
                        mkdir($directorio, 0777) or die("No se puede crear el directorio de extración");    
                    } 
                    $dir=opendir($directorio); //Abrimos el directorio de destino
                    $target_path = $directorio.'/'.$filename;
                    
                    //dd("se movio",$target_path);  
                    move_uploaded_file($source, $target_path); 
                    DB::table('documentos_adjuntos')
                    ->insert([
                        'idempresa'       =>$idempresa ,  
                        'idcliente'       => $idcliente,
                        'descripcion'     => $descripcion, 
                        'glosa'           => $glosa, 
                        'nombre'           => $nombre,  
                        'tipo_doc'        => $iddocumento, 
                        'url_doc'         => $target_path,
                        'fecha_creacion'  => date('Y-m-d H:m:s'),
                        'estado'          => '1', 
                        'extencion'       => $extencion,
                        'carpeta'         =>$carpeta
                    ]);
                   
                    //dd("guardo" );
                    return response()->json("TRUE");
                    
                   

                } else {    
                    return response()->json("FALSE");
                }
                closedir($dir); //Cerramos el directorio de destino
            
            
            }else {
                //dd("no ingresa");
                //return response()->json("FILE VACIO");
                echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }
        
       
        
        
 

    }
    public function update(){

    }
    public function delete(){

    }
     
}
