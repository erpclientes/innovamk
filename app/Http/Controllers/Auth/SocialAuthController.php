<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Carbon\Carbon;
use Auth;
use DB;
use App\User;
use Socialite;
use App\Http\Controllers\Auth\Routeros_api;

class SocialAuthController extends Controller
{
	//Metodo encargado de pasar los datos al Hotspot externo
	public function Hotspot(Request $req)
    {
        $datos = Collection::make($req);
        //dd($datos);
        $carrusel = DB::table('carrusel')->where([
            'estado'        => 1,
            'app'           => 'INNOVAWIFI'
        ])->get();

        $parametros = DB::table('parametros')
            ->where([
                'idempresa'         => '001',
                'tipo_parametro'    => 'HOTSPOT',
                'estado'            => 1
            ])->get();

        return view('hotspot.index', [
        	'datos'         => $datos,
            'parametros'    => $parametros,
            'carrusel'      => $carrusel     
        ]);
    }

    //Metodo que se encarga de mostrar datos despues de logearse por el Hotspot
    public function login(Request $req)
    {
        $datos = Collection::make($req);
        //dd($datos);
        $parametros = DB::table('parametros')
            ->where([
                'idempresa'         => '001',
                'tipo_parametro'    => 'HOTSPOT',
                'estado'            => 1
            ])->get();

        return view('hotspot.login', [
        	'datos'        => $datos,
            'parametros'   => $parametros 
        ]);
    }

    //Metodo que se encarga de mostrar es status
    public function status(Request $req)
    {
        $datos = Collection::make($req);    
        $email = null;    
        $concurrencia = 0;
        //dd($datos);
        $router = DB::table('router')->where('idrouter','RO2')->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
        $collection = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/ip/hotspot/user/print");
                //$ARRAY = $API->comm("/ip/hotspot/active/print");
                $collection = Collection::make($ARRAY);            
            }       
        }
        //dd($collection);

        foreach ($collection as $value) {
            if ($value['name'] == $req->username) {
                $email = $value['email'];
            }
        }

        $user = DB::table('usuarios_hotspot')->where('email',$email)->get();

        foreach ($user as $val) {
            $concurrencia = $val->concurrencia;
        }

        $concurrencia++;

        DB::table('usuarios_hotspot')
            ->where('email',$email)
            ->update([
                'concurrencia'  => $concurrencia        
            ]);

        return view('hotspot.login', [
        	'datos'		=> $datos,
            'user'      => $user
        ]);
    }

    //Metodo que se encarga de mostrar es logout
    public function logout(Request $req)
    {
        $datos = Collection::make($req);
        //dd($datos);

        return view('hotspot.logout', [
        	'datos'		=> $datos
        ]);
    }

    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        //add($provider);
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user(); 
        //dd($social_user);
        // Comprobamos si el usuario ya existe
        if($provider == 'google'){
            if (!$user = DB::table('usuarios_hotspot')->where('email', $social_user->email)->first()) { 
              
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = DB::table('usuarios_hotspot')
                ->insert([
                    'idempresa'         => '001',
                    'codigo'            => $social_user->id,
                    'ip'                => $_SERVER["REMOTE_ADDR"],
                    'nombre'            => $social_user->name,
                    'genero'            => $social_user->user['gender'],
                    'email'             => $social_user->email,
                    'avatar'            => $social_user->avatar,
                    'avatar_original'    => $social_user->avatar_original,
                    'usuario'           => $social_user->id,
                    'social_login'      => $provider,
                    'nickname'          => $social_user->nickname,

                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'estado'            => 1
                ]);
            }
        }

        if($provider == 'twitter'){
            if (!$user = DB::table('usuarios_hotspot')->where('email', $social_user->email)->first()) { 
              
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = DB::table('usuarios_hotspot')
                ->insert([
                    'idempresa'         => '001',
                    'codigo'            => $social_user->id,
                    'ip'                => $_SERVER["REMOTE_ADDR"],
                    'nombre'            => $social_user->name,
                //    'genero'            => $social_user->user['gender'],
                    'email'             => $social_user->email,
                    'avatar'            => $social_user->avatar,
                    'avatar_original'    => $social_user->avatar_original,
                    'usuario'           => $social_user->id,
                    'social_login'      => $provider,
                    'nickname'          => $social_user->nickname,

                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'estado'            => 1
                ]);
            }
        }

        if($provider == 'facebook'){
            if (!$user = DB::table('usuarios_hotspot')->where('email', $social_user->email)->first()) { 
               
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = DB::table('usuarios_hotspot')
                ->insert([
                    'idempresa'         => '001',
                    'codigo'            => $social_user->id,
                    'ip'                => $_SERVER["REMOTE_ADDR"],
                    'nombre'            => $social_user->name,
                    'email'             => $social_user->email,
                    'avatar'            => $social_user->avatar,
                    'avatar_original'    => $social_user->avatar_original,
                    'usuario'           => $social_user->id,
                    'social_login'      => $provider,
                    'nickname'          => $social_user->nickname,
                    'ciudad_nacimiento' => $social_user['location']['name'],
                    'ciudad_radica'     => $social_user['hometown']['name'],
                    'fecha_nacimiento'  => Carbon::createFromFormat('d/m/Y', $social_user['birthday']),

                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'estado'            => 1
                ]);
            }
        }
    
            $router = DB::table('router')->where('idrouter','R03')->get();
      //dd($social_user);
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;
            //$ARRAY = $API->comm("/ppp/profile/print");
            //dd($ARRAY);
            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $perfil = DB::table('perfiles')->where('idrouter',$rou->idrouter)->get();
                    
                    foreach ($perfil as $val) {                    

                        $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                            "name"      => $social_user->id,
                            "password"  => $social_user->id,  
                            "profile"   => $val->hotspot_perfil,  
                            "server"    => 'hotspot1'
						));  
                    }
                
                }       
            }
 
 			$user = DB::table('usuarios_hotspot')->where('email', $social_user->email)->first();
 			//dd($user);

            return $this->authAndRedirect($user); // Login y redirección
      
    }
 
    // Login y redirección
    public function authAndRedirect($user)
    {
        //dd($user);
        //Auth::login($user);    
        //return redirect('/home');
        
       // return redirect('/hotspot/pagina-bienvenida');

        return redirect()->to('https://portal.innovatec.me/#?usu='.$user->usuario);    
                  
              
    }
}
