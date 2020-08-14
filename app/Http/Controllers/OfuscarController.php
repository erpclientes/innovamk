<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;
use Carbon\Carbon;

class OfuscarController extends Controller
{
    public function prueba()
    {
    	$directorio = 'C:\xampp\htdocs\innovamk\app\Http\Controllers';
		$archivos = scandir($directorio, 1);

		$dir = 'C:\xampp\htdocs\produccion\app\Http\Controllers\EmpresaController.php';
		$dir2 = 'C:\xampp\htdocs\produccion\app\Http\Controllers\EmpresaController.php';

		$fp = fopen($dir, "r");
		$fp2 = fopen($dir2, "r");
		$clase = fread($fp, filesize($dir));
		$clase2 = fread($fp2, filesize($dir2));
		$clase2 = str_replace('@return', '', $clase2);
		$clase3 = $clase2;


		$total = strlen($clase);
		$i = 0;
		$funciones = array();

		while ($i < $total) {
			$ini = strpos($clase2, 'public function');

			$parteb = substr($clase2,$ini,100);
			$funcion = substr($parteb, 0, strpos($parteb,'{'));

			$fin = strpos($clase2, 'return') - $ini;

			$parte = substr($clase2,$ini,$fin);

			$funcion = substr($parte, 0, strpos($parte,'{'));
			$funcion2 = substr($parte, 0, strpos($parte,'{')+7);

			

			if (empty($funcion) or strlen($funcion) == 0) {
				$total = 0;
				break;
			}

			$ini2 = strpos($clase2, $funcion)+strlen($funcion)+5;
			$fin2 = $fin - strlen('return');

			//------Se extra el metodo completo para ser reemplazado mas adeltante----------
			$texto2 = substr($clase2, strpos($clase2, 'return view'), 500);
			$texto2 = substr($texto2, 0, strpos($texto2, '}')+5);
			$fin3 = $fin2 + strlen($texto2);
			$parte2 = substr($clase2,$ini,$fin3+3);

			$clase2 = str_replace($parte2, '', $clase2);

			$funciones[$i]['funcion'] = $funcion;
			$funciones[$i]['metodo'] = $parte2;
			
			//------------Encritamos la parte del codigo estraido------------------
			$encriptado = base64_encode($parte);

			$codigo = "eval(base64_decode('".$encriptado."'));\n\n";

			//$reem = substr_replace($clase, $texto, $ini2+1,$fin);
			$clase = str_replace($parte, $codigo, $clase);

			$i = $i+1;

		}
		
		dd($funciones);

		//---------posicion del texto a extraer---------
		$ini = strpos($clase, 'public function');
		$fin = strpos($clase, 'return view') - $ini;

		$parte = substr($clase,$ini,$fin);

		$funcion = substr($parte, 0, strpos($parte,'{'));
		$funcion2 = substr($parte, 0, strpos($parte,'{')+7);
		$parte = str_replace($funcion2, '', $parte);

		$ini2 = strpos($clase, $funcion)+strlen($funcion)+5;
		$fin2 = $fin - strlen('return view');


		


		//------------Encritamos la parte del codigo estraido------------------
		$encriptado = base64_encode($parte);

		$codigo = "eval(base64_decode('".$encriptado."'));\n\n";

		//$reem = substr_replace($clase, $texto, $ini2+1,$fin);
		$reem = str_replace($parte, $codigo, $clase);

		$dir2 = 'C:\xampp\htdocs\produccion\app\Http\Controllers\Probando.php';
		$fp2 = fopen($dir2, "w+");

		fwrite($fp2, $reem);



		//dd($reem);
    } 
}
