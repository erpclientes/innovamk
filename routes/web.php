<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test/lista','TestController@index');
Route::get('/test/addTest','TestController@create');
Route::post('/test/grabar','TestController@store');

Route::get('/incidencias/addTest','IncidenciasController@index');


Route::get('/','Auth\LoginController@showLoginForm');
Route::view('/login','Auth\LoginController@showLoginForm');
Route::get('/cerrar','HomeController@cerrar');
Route::view('/registrar','auth.register');
Route::view('/plantilla','forms.plantilla.layoutBasico');
Route::view('/api','API.prueba');
Route::view('/ucv','forms.prueba');
Route::view('/pagina-new','layouts2.app');
Route::view('/pagina-test','layouts2.test');

Route::view('/inicio','inicio');
Route::view('/otro','forms.plantilla.mntBasico');
Route::get('/pppoe','MaestroController@pppoe');

//Prueba Post
Route::get('/post','PostController@index');
Route::post('/post/grabar','PostController@store');
Route::get('ajaxRequest', 'PostController@ajaxRequest');
Route::post('ajaxRequestt', 'PostController@ajaxRequestPost');
Route::get('carbon','PostController@prueba');
Route::get('mk','MaestroController@prueba');
Route::view('/basico','forms.plantilla.mntBasico');
Route::view('/basico2','forms.plantilla.lstBasico');
Route::view('/vuejs','forms.pruebas.vuejs');

Route::view('/format','forms.pruebas.format');


Route::get('/testUsuarios', 'HotspotController@usuarios');
Route::get('/addUsuario', 'HotspotController@addUsuario');


//API SOCIAL LOGIN
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
Route::view('/logeofb', 'forms.pruebas.loginfb');
Route::post('/hotspot', 'Auth\SocialAuthController@hotspot');
Route::get('auth2/{provider}', 'SocialAuthController@redirectToProvider')->name('social2.auth');
Route::get('auth2/{provider}/callback', 'SocialAuthController@handleProviderCallback');

//Plantillas Hotspot
Route::post('/hotspot/login', 'Auth\SocialAuthController@login');
Route::post('/hotspot/status', 'Auth\SocialAuthController@status');
Route::post('/hotspot/logout', 'Auth\SocialAuthController@logout');
Route::view('/hotspot/publicidad', 'hotspot.publicidad');
Route::get('/hotspot/registro', 'RegistroController@index');
Route::post('/addRegistro', 'RegistroController@addRegistro');


//Plantillas Hotspot
//Página de Bienvenida
Route::get('/hotspot/bienvenida', 'HotspotController@mntBienvenida');
Route::get('/hotspot/pagina-bienvenida', 'HotspotController@bienvenida');
Route::post('/addBienvenida', 'HotspotController@addBienvenida');
Route::post('/addParametrosBienvenida', 'HotspotController@addParametrosBienvenida');
//Página de cierre
Route::get('/hotspot/logout', 'HotspotController@mntLogout');
Route::get('/hotspot/pagina-cerrar-sesion', 'HotspotController@logout');
Route::post('/addLogout', 'HotspotController@addLogout');
Route::post('/addParametrosLogout', 'HotspotController@addParametrosLogout');
//Página de Publicidad
Route::get('/hotspot/lstPublicidad', 'HotspotController@lstPublicidad');
Route::get('/hotspot/mntPublicidad', 'HotspotController@mntPublicidad');
Route::get('/hotspot/pagina-publicidad', 'HotspotController@publicidad');
Route::get('/hotspot/publicidad/nuevo', 'HotspotController@create');
//Página de Inicio
Route::get('/hotspot/pagina-inicio', 'HotspotController@inicio');

Auth::routes();
Route::group(['middleware' => 'auth'], function(){ 
	Route::get('/home', 'HomeController@index')->name('home'); 
	//Router
	Route::get('/router','RouterController@index');
	Route::post('/router/grabar','RouterController@store');
	Route::post('router/actualizar','RouterController@update');
	Route::view('/nuevo-router','forms.router.mntRouter');
	Route::get('/eliminar-router/{idrouter}','RouterController@destroy');
	Route::get('/mostrar-router/{id}','RouterController@show');
	Route::post('router/verificarID','RouterController@verificarID');
	Route::post('router/reiniciar','RouterController@reiniciar');
	Route::post('router/apagar','RouterController@apagar');

	//Queues
	Route::get('/queues','QueuesController@index');
	Route::get('/queues/nuevo','QueuesController@create');
	Route::post('/queues/grabar','QueuesController@store');

	//Equipos
	Route::get('/equipos','EquiposController@index');
	Route::get('/equipos/nuevo','EquiposController@create');
	Route::post('/equipos/grabar','EquiposController@store');
	Route::post('/equipos/grabarEmisor','EquiposController@storeEmisor');

	Route::get('/equipos/mostrar/{id}','EquiposController@show');
	Route::post('/equipos/actualizar','EquiposController@update');
	Route::get('/equipos/eliminar/{id}','EquiposController@destroy');

	//-----DOCUMENTOS ADJUNTOS ---------- 
	
	Route::get('/adjuntarDoc','documentosAdjuntosController@index');
	Route::post('/guardarDoc','documentosAdjuntosController@store'); 
	Route::post('/download/{nombre}','documentosAdjuntosController@getDownload'); 
	Route::get('/adjuntarDoc/eliminar/{id}','documentosAdjuntosController@destroy');  

	//-----Clientes----------- recibir
	Route::get('/clientes','ClientesController@index');
	Route::get('/mapa','ClientesController@mapaPrueba');
	Route::get('/iframe','ClientesController@iframe');
	Route::post('/recibir','ClientesController@recibir');
	Route::post('/pasar','ClientesController@pasar');
	Route::post('/pasarCreate','ClientesController@pasarCreate'); 
	Route::post('/agregarDocumento','ClientesController@agregarDocumento');  
	Route::get('/clientes/mapa','ClientesController@mapaClientes'); 
	Route::get('/clientes/nuevo','ClientesController@create');
	Route::post('/clientes/grabar','ClientesController@store');
	Route::get('/clientes/mostrar/{id}','ClientesController@show');
	Route::post('/clientes/actualizar','ClientesController@update');
	Route::get('/clientes/eliminar/{id}','ClientesController@destroy');
	Route::get('/cliente','ClientesController@cliente');
	Route::post('/cliente/verificarID','ClientesController@verificarID');
	Route::get('/cliente/{id}','ClientesController@cliente');
	Route::post('/cliente/desabilitar','ClientesController@disabled');
	Route::post('/cliente/habilitar','ClientesController@habilitar');
	Route::get('/clientes/exportExcel','ClientesController@exportExcelClientes');
	Route::post('/usuariosCorte','MaestroController@usuariosCorte');
	Route::post('/cliente/exonerar','ClientesController@exonerar');
	Route::get('/clientes/notificaciones','ClientesController@notificaciones');
	Route::post('/cliente/setAviso','ClientesController@setAviso');
	Route::post('/cliente/setCorte','ClientesController@setCorte');
	Route::post('/cliente/restablecer','ClientesController@restablecer');
	Route::get('/herramientas/clientes','ClientesController@herramientaClientes');
	Route::post('herramientas/importarClientes','ClientesController@importarClientes');
	Route::get('herramientas/addUserPPPoE','ClientesController@addUserPPPoE');
	Route::get('herramientas/addIpPool','ClientesController@addIpPool');
	//Servicios	
	Route::post('/cliente/servicios','ClientesController@storeServicio');
	Route::get('/servicio/nuevo/{idcliente}','ServicioController@create');
	Route::post('/servicio/grabar','ServicioController@store');
	Route::get('/servicio/mostrar/{id}','ServicioController@show');
	Route::post('/servicio/actualizar','ServicioController@update');
	Route::post('/servicio/perfil','MaestroController@getPerfil');
	Route::get('/servicio/eliminar/{id}','ServicioController@destroy');
	Route::post('/guardarDEquipo','DEquipoController@guardarDEquipo');
	Route::post('/guardarEquipoComprobante','DEquipoController@guardarEquipoComprobante');
	Route::post('/newComprobante','ComprobanteController@newComprobante');
	Route::post('/servicio/desabilitar','ServicioController@disabled');
	Route::post('/servicio/habilitar','ServicioController@habilitar');
	Route::post('/getQueues','MaestroController@getQueues');
	//Notificaciones
	Route::post('/notificaciones/actualizar','ServicioController@updateNotificaciones');
	Route::post('/notificacion/activar','ServicioController@activar');
	Route::post('/notificacion/desactivar','ServicioController@desactivar');
	//Herramientas
	Route::get('/clientes/importar','HerramientasController@importClientes');
	Route::get('/clientes/exportar','HerramientasController@exportClientes');
	Route::post('/showUsuarios','HerramientasController@showUsuarios');
	Route::post('/validaParametros','HerramientasController@validaParametros');
	Route::post('/guardarClientesPppoe','HerramientasController@guardarImportPPPoE');
	Route::post('/guardarClientesPCQ','HerramientasController@guardarImportPCQ');
	Route::post('/guardarClientesQUEUES','HerramientasController@guardarImportQUEUES');
	Route::post('/guardarClientesHotspot','HerramientasController@guardarImportHotspot');
	//Ip Pool
	Route::get('/pool','HerramientasController@pool');
	Route::post('/pool/grabar','HerramientasController@storePool');
	Route::post('/listaIpDisponibles','ServicioController@listaIpDisponibles');
	Route::post('/getIpPool','ServicioController@getIpPool');
	Route::post('/pool/actualizar','HerramientasController@updPool');
	Route::post('/pool/eliminar','HerramientasController@destroyPool');
	//Comprobante
	Route::post('/comprobante/cliente/guardar','ComprobanteController@storeCliente');
	Route::get('/comprobante/plantilla/{id}','ComprobanteController@plantilla');
	Route::get('/descargarPDF/{id}', 'ComprobanteController@pdf');
	Route::get('/comprobante/anular/{id}','ComprobanteController@anular');
	Route::post('/comprobante/grabarConceptoManual','ComprobanteController@conceptoManual');


	//----FIN Clientes---------

	//Empresa
	Route::get('/empresa','EmpresaController@index');
	Route::get('/empresa/nuevo','EmpresaController@create');
	Route::post('/empresa/grabar','EmpresaController@store');
	Route::get('/empresa/mostrar/{id}','EmpresaController@show');
	Route::post('/empresa/actualizar','EmpresaController@update');
	Route::get('/empresa/eliminar/{id}','EmpresaController@destroy');
	

	//Tipo de Acceso
	Route::get('/tipo-de-acceso','MaestroController@indexTipoAcceso');
	Route::get('/tipo/mostrar/{id}','MaestroController@showTipoAcceso');
	Route::post('/tipo/grabar','MaestroController@storeTipoAcceso');
	Route::post('/tipo/actualizar','MaestroController@updateTipoAcceso');
	Route::post('/tipo/eliminar','MaestroController@destroyTipoAcceso');
	Route::post('/tipo/actualizar/estado','MaestroController@updateEstadoTipoAcceso');

	//Perfiles(planes de internet)
	Route::get('/perfiles','PerfilesController@index');
	Route::post('/perfil/grabar','PerfilesController@store');
	Route::post('/perfil/actualizar','PerfilesController@update');
	Route::post('/perfil/eliminar','PerfilesController@destroy');
	Route::post('/perfil/desabilitar','PerfilesController@disabled');
	Route::post('/perfil/habilitar','PerfilesController@habilitar');
	//Hotspot
	Route::post('/hotspot/perfil','PerfilesController@getPerfil');
	Route::post('/perfil/hotspot/grabar','PerfilesController@storeHotspot');
	Route::post('/perfil/hotspot/actualizar','PerfilesController@updateHotspot');
	Route::post('/guardarImportPerfil','PerfilesController@guardarImportPerfil');
	//Importar y Exportar Perfiles de Internet
	Route::post('/exportPerfil','PerfilesController@exportPerfil');
	Route::post('/importPerfil','PerfilesController@importPerfil');
	//PPPoE
	Route::post('/perfil/pppoe','PerfilesController@getPerfilPPPoE');
	Route::post('/perfil/pppoe/grabar','PerfilesController@storePPPoE');
	Route::post('/perfil/pppoe/actualizar','PerfilesController@updatePPPoE');
	Route::post('/guardarImportPppoe','PerfilesController@guardarImportPppoe');
	//PCQ
	Route::post('/pcq/getParent','PcqController@getParent');
	Route::post('/pcq/grabar','PcqController@store');
	Route::post('/guardarImportPCQ','PcqController@guardarImportPCQ');
	Route::post('/pcq/actualizar','PcqController@update');
	//zonas 
	Route::get('/zonas','ZonasController@index');	
	Route::get('/zonas/nuevo','ZonasController@create');
	Route::post('zonas/grabar','ZonasController@store'); 
	Route::post('/zonas/actualizar','ZonasController@update');
	Route::get('/zonas/mostrar/{id}','ZonasController@show');
	Route::get('/zonas/eliminar/{id}','ZonasController@destroy');
	Route::get('/zonas/habilitar/{id}','ZonasController@habilitar');
	Route::get('/zonas/desabilitar/{id}','ZonasController@desabilitar');
	//proforma
	Route::get('/proformas','proformaController@index');	
	Route::get('/proformas/nuevo','proformaController@create');	
	Route::get('/proformas/generar','proformaController@generarProforma');
	Route::post('/proformas/grabar','proformaController@Store');
	Route::post('/proformas/StoreDetallePlan','proformaController@StoreDetallePlan');	 
	Route::post('/proformas/StoreDetalleEquipo','proformaController@StoreDetalleEquipo');	
	Route::post('/proformas/StoreDetalleConceptoManual','proformaController@StoreDetalleConceptoManual');	
	Route::get('/proformas/mostrar/{id}','proformaController@show');	
	Route::get('/proformas/eliminar/{id}','proformaController@destroy'); 

	//SoproteTecnico 
	Route::get('/tickets','TicketsController@index');	
	Route::get('/tecnicos','TecnicosController@index');	
	Route::get('/tecnicos/nuevo','TecnicosController@create');	 
	Route::post('/tecnicos/grabar','TecnicosController@Store');	 
	Route::get('/tecnicos/mostrar/{id}','TecnicosController@show');	
	Route::get('/tecnicos/eliminar/{id}','TecnicosController@destroy');
	Route::get('/tecnicos/desabilitar/{id}','TecnicosController@disabled');
	Route::get('/tecnicos/habilitar/{id}','TecnicosController@habilitar');
	Route::post('/tecnicos/actualizar','TecnicosController@update'); 
	//Usuarios
	Route::get('/usuarios','UsuarioController@index');
	Route::get('/usuario/nuevo','UsuarioController@create');
	Route::post('/usuario/grabar','UsuarioController@store');
	Route::get('/usuario/mostrar/{id}','UsuarioController@show');
	Route::post('/usuario/actualizar','UsuarioController@update');
	Route::get('/usuario/eliminar/{id}','UsuarioController@destroy');
	Route::post('/usuario/desabilitar','UsuarioController@disabled');
	Route::post('/usuario/habilitar','UsuarioController@habilitar');
	Route::post('/usuario/updContra','UsuarioController@updContra');
	Route::post('usuario/verificarID','UsuarioController@verificarID');
	Route::post('usuario/verificarUsuario','UsuarioController@verificarUsuario'); 
	//Facturación
	Route::get('/pagos','PagosController@index');
	Route::get('/pagos/detalle/{id}','PagosController@show');
	Route::post('/pagos/grabar','PagosController@store');
	Route::get('/reporte-pagos','PagosController@lstReporte');
	Route::post('/reportePagos','PagosController@reportePagos');
	
	//MAESTROS
	Route::post('/ip/pool','MaestroController@getPoolIp');  //Retorna el POOL de IPs del Mikrotik
	Route::post('/getMarca','MaestroController@getMarca');  //Retorna registro de marcas con relacion al idgrupo
	Route::post('/getTipoAcceso','MaestroController@getTipoAcceso');  //Retorna lista de tipos de acceso (HOTSPOT, PPPoE, QUEUES)
	Route::post('/getModelo','MaestroController@getModelo');  //Retorna registro de modelo de equipos segun idmarca

	//GRUPO
	Route::get('/grupo', 'GrupoController@index');
	Route::get('/grupo/lista', 'GrupoController@list');
	Route::post('/grupo/store', 'GrupoController@store');
	Route::put('/grupo/update/{id}', 'GrupoController@update');
	Route::delete('/grupo/delete/{id}', 'GrupoController@delete');
	Route::delete('/grupo/disable/{id}', 'GrupoController@disable');
	Route::delete('/grupo/enable/{id}', 'GrupoController@enable');
	Route::get('/grupo/listaSelect', 'GrupoController@listSelect');
	Route::get('/grupo/buscar/{id}', 'GrupoController@buscar');

	//MARCA
	Route::get('/marca', 'MarcaController@index');
	Route::get('/marca/lista', 'MarcaController@list');
	Route::post('/marca/store', 'MarcaController@store');
	Route::put('/marca/update/{id}', 'MarcaController@update');
	Route::delete('/marca/delete/{id}', 'MarcaController@delete');
	Route::delete('/marca/disable/{id}', 'MarcaController@disable');
	Route::delete('/marca/enable/{id}', 'MarcaController@enable');
	Route::get('/marca/listaSelect', 'MarcaController@listSelect');
	Route::get('/marca/buscar/{id}', 'MarcaController@buscar');

	//MODELO
	Route::get('/modelo', 'ModeloController@index');
	Route::get('/modelo/lista', 'ModeloController@list');
	Route::post('/modelo/store', 'ModeloController@store');
	Route::put('/modelo/update/{id}', 'ModeloController@update');
	Route::delete('/modelo/delete/{id}', 'ModeloController@delete');
	Route::delete('/modelo/disable/{id}', 'ModeloController@disable');
	Route::delete('/modelo/enable/{id}', 'ModeloController@enable');
	Route::get('/modelo/buscar/{id}', 'ModeloController@buscar');

	//MODO EDQUIPO
	Route::get('/modo', 'ModoEquipoController@index');
	Route::get('/modo/lista', 'ModoEquipoController@list');
	Route::post('/modo/store', 'ModoEquipoController@store');
	Route::put('/modo/update/{id}', 'ModoEquipoController@update');
	Route::delete('/modo/delete/{id}', 'ModoEquipoController@delete');
	Route::delete('/modo/disable/{id}', 'ModoEquipoController@disable');
	Route::delete('/modo/enable/{id}', 'ModoEquipoController@enable');
	Route::get('/modo/buscar/{id}', 'ModoEquipoController@buscar');

	//DOCUMENTO DE PERSONA
	Route::get('/documento', 'DocumentoController@index');
	Route::get('/documento/lista', 'DocumentoController@list');
	Route::post('/documento/store', 'DocumentoController@store');
	Route::put('/documento/update/{id}', 'DocumentoController@update');
	Route::get('/documento/delete/{id}', 'DocumentoController@delete');
	Route::delete('/documento/disable/{id}', 'DocumentoController@disable');
	Route::delete('/documento/enable/{id}', 'DocumentoController@enable');
	Route::get('/documento/buscar/{id}', 'DocumentoController@buscar');

	//FORMA DE PAGOS
	Route::get('/formaPago', 'FormaPagosController@index');
	Route::get('/formaPago/lista', 'FormaPagosController@list');
	Route::post('/formaPago/store', 'FormaPagosController@store');
	Route::put('/formaPago/update/{id}', 'FormaPagosController@update');
	Route::delete('/formaPago/delete/{id}', 'FormaPagosController@delete');
	Route::delete('/formaPago/disable/{id}', 'FormaPagosController@disable');
	Route::delete('/formaPago/enable/{id}', 'FormaPagosController@enable');
	Route::get('/formaPago/buscar/{id}', 'FormaPagosController@buscar');

	//TIPO DE MONEDAS
	Route::get('/moneda', 'TipoMonedaController@index');
	Route::get('/moneda/lista', 'TipoMonedaController@list');
	Route::post('/moneda/store', 'TipoMonedaController@store');
	Route::put('/moneda/update/{id}', 'TipoMonedaController@update');
	Route::delete('/moneda/delete/{id}', 'TipoMonedaController@delete');
	Route::delete('/moneda/disable/{id}', 'TipoMonedaController@disable');
	Route::delete('/moneda/enable/{id}', 'TipoMonedaController@enable');
	Route::get('/moneda/buscar/{id}', 'TipoMonedaController@buscar');

	//DOCUMENTO DE VENTAS
	Route::get('/documentoVenta', 'DocumentoVentaController@index');
	Route::get('/documentoVenta/lista', 'DocumentoVentaController@list');
	Route::post('/documentoVenta/store', 'DocumentoVentaController@store');
	Route::put('/documentoVenta/update/{id}', 'DocumentoVentaController@update');
	Route::delete('/documentoVenta/delete/{id}', 'DocumentoVentaController@delete');
	Route::delete('/documentoVenta/disable/{id}', 'DocumentoVentaController@disable');
	Route::delete('/documentoVenta/enable/{id}', 'DocumentoVentaController@enable');
	Route::get('/documentoVenta/buscar/{id}', 'DocumentoVentaController@buscar');

	//Correos
	Route::get('/correo', 'MailController@index');
	Route::get('/selectEmails', 'MailController@selectMultipleEmails');
	Route::post('/correo/enviarMensaje', 'MailController@enviarMensaje');
	Route::get('/outbox', 'MailController@obtenerMensajesSalida');
	Route::get('/outbox/{id}', 'MailController@detalleSalida');

	//Fichas Hotspot
	Route::get('/fichas', 'FichasController@index');
	Route::post('/fichas/grabar', 'FichasController@store');
	Route::get('/fichas/plantilla/{id}/{idplantilla}', 'FichasController@plantilla');
	Route::get('/fichas/pdf/{id}/{idplantilla}', 'FichasController@pdf');
	Route::get('/fichas/plantillas', 'FichasController@plantillas');
	Route::get('/fichas/plantillas/nuevo', 'FichasController@createPlantilla');
	Route::post('/fichas/plantillas/grabar', 'FichasController@storePlantilla');
	Route::post('/fichas/actualizar','FichasController@update');
	Route::get('/fichas/plantillas/mostrar/{id}', 'FichasController@show');
	Route::post('/fichas/plantilla/actualizar','FichasController@update');
	//Detalle Fichas
	Route::get('/fichas/{id}', 'FichasController@detalleFichas');


	//--------------------HOTSPOT------------------------
    //Redes Sociales
    Route::get('/social', 'SocialController@index');
    Route::post('/social/actualizar', 'SocialController@update');
    //Metodo para obtener las Conexiones de usuarios en el Hotspot
    Route::get('/conexiones', 'HotspotController@conexiones');
    Route::get('/desconectar/{id}', 'HotspotController@desconectar');
    //---Usuarios Hotspot---
    Route::get('/hotspot/usuarios', 'Clientes2Controller@index');
    Route::get('/hotspot/usuario/{id}', 'Clientes2Controller@show');

    //Carrusel
    Route::get('/carrusel', 'CarruselController@index');
    Route::get('/carrusel/nuevo', 'CarruselController@create');
    Route::post('/carrusel/grabar', 'CarruselController@store');
    Route::post('/carrusel/eliminar', 'CarruselController@destroy');
    Route::post('/carrusel/actualizar', 'CarruselController@update');
    Route::get('/carrusel/mostrar/{id}', 'CarruselController@show');
    Route::post('/carrusel/desabilitar', 'CarruselController@disabled');
    Route::post('/carrusel/habilitar', 'CarruselController@habilitar');

    //Plantillas Hotspot
    //Página de Bienvenida
    Route::get('/hotspot/bienvenida', 'HotspotController@mntBienvenida');
    Route::get('/hotspot/pagina-bienvenida', 'HotspotController@bienvenida');
    Route::post('/addBienvenida', 'HotspotController@addBienvenida');
    Route::post('/addParametrosBienvenida', 'HotspotController@addParametrosBienvenida');
    //Página de cierre
    Route::get('/hotspot/logout', 'HotspotController@mntLogout');
    Route::get('/hotspot/pagina-cerrar-sesion', 'HotspotController@logout');
    Route::post('/addLogout', 'HotspotController@addLogout');
    Route::post('/addParametrosLogout', 'HotspotController@addParametrosLogout');
    //Página de Publicidad
    Route::get('/hotspot/lstPublicidad', 'HotspotController@lstPublicidad');
    Route::get('/hotspot/mntPublicidad', 'HotspotController@mntPublicidad');
    Route::get('/hotspot/pagina-publicidad', 'HotspotController@publicidad');
    Route::get('/hotspot/publicidad/nuevo', 'HotspotController@create');
    //Página de Inicio
    Route::get('/hotspot/pagina-inicio', 'HotspotController@inicio');

    //HOME MONITOR
	Route::get('/monitor','HomeController@monitor');
	Route::post('/getInterfaces','MaestroController@getInterfaces');
	Route::post('/herramientaPlantilla','HomeController@herramientaPlantilla');

    //--------------------------LICENCIA------------------------    
	Route::get('/licencia','LicenciaController@index');
	Route::get('/licencia/nuevo','LicenciaController@create');
	Route::post('/licencia/grabar','LicenciaController@store');
	Route::post('/licencia/generador','LicenciaController@generadorLicencia');

    //Parametros
	Route::get('/parametros','ParametrosController@index');
	Route::get('/parametros-clientes','ParametrosController@clientes');
	Route::get('/parametros-facturacion','ParametrosController@facturacion');
	Route::post('/parametros/actualizar','ParametrosController@update');
	Route::post('/parametros/updCliente','ParametrosController@updCliente');
	Route::post('/parametros/updFacturacion','ParametrosController@updFacturacion');

	//Dashboard
	Route::get('/dashboard/finanzas','DashboardController@finanzas');




	//-----------------------------------cPanel CLientes------------------------------
	//Pagos
	Route::get('/registrar-pagos','PagosController@index2');
	Route::post('/pagos/imgGrabar','PagosController@imgUpdate');
	Route::post('/pago/rechazar','PagosController@rechazar');
	Route::post('/pago/aceptar','PagosController@aceptar');
	Route::get('/excel/exportar/{id}','PagosController@exportExcelPedido');
	Route::get('/pagos/historial','PagosController@historial');

	//Servicio
	Route::get('/servicio/{id}','ServicioController@index2');



    //OFUSCAR CODIGO
    Route::get('/ofuscar', 'CampanaController@vistaOfuscarCodigo');
    Route::post('/ofuscar/resultado', 'CampanaController@ofuscarCodigo');

    //Helpers
	Route::view('/colores','forms.helpers.colores');
	Route::view('/iconos','forms.helpers.iconos');

    //PRUEBA PDF CON DOMPDF
    Route::get('/testPDF', 'MaestroController@indexPDF')->name('products');
	Route::get('descargar-productos', 'MaestroController@pdf')->name('products.pdf');


});

//Redireccion de Login
Route::get('/userReg', 'Auth\LoginController@usuarioRegistrado');

//-------Test Correo--------------
Route::get('/enviar', 'MailController@test');

//------------------PRUEBAS|TEST--------------------------
Route::view('/prueba','forms.plantilla.mntBasico');
Route::get('/editor', 'EditorController@index');
Route::post('/editor/test', 'EditorController@test');
Route::get('/datosHost','MaestroController@datosHost');

//------REGISTRO DE EMPRESA INICIAL--LICENCIA----------------
Route::get('/registrar-empresa','EmpresaController@create2');
Route::post('/empresa/grabar2','EmpresaController@store2');
Route::post('/empresa/verificarID','EmpresaController@verificarID');
//--------------GESTION DE LICENCIA-------------------
Route::get('/licencia/registrar','LicenciaController@create2');
Route::post('/licencia/validar','LicenciaController@validar');
Route::post('/setLicencia','LicenciaController@setLicencia');

Route::get('/directorio','OfuscarController@prueba');
Route::get('/generarComprobante','ComprobanteController@generarComprobante');
Route::get('/corte','MaestroController@corte');
Route::get('/avisos','MaestroController@avisos');
Route::get('/actualizarNotificacionesMasivo','MaestroController@updateNotificacionesMasivos');
Route::get('/clientesMasivos','MaestroController@generarUsuariosClientes');
Route::get('/eliminarUsuariosMasivos','MaestroController@deleteUsuariosClientes');
Route::get('/validarComprobante','MaestroController@validarComprobante');
Route::get('/eliminarComprobantesDuplicados','MaestroController@eliminarComprobantesDuplicados');
Route::get('/eliminarComprobantesPagadosDuplicados','MaestroController@eliminarComprobantesPagadosDuplicados');
Route::get('/validarFechaCorte','MaestroController@validarFechaCorte');



//Avisos
	Route::get('/aviso', 'AvisosController@aviso');
	Route::get('/aviso/mntAviso', 'AvisosController@index');
	Route::post('/aviso/actualizar','AvisosController@update');
	//Corte
	Route::get('/vwCorte', 'AvisosController@corte');
	Route::get('/corte/mntCorte', 'AvisosController@index2');
	Route::post('/corte/actualizar','AvisosController@updCorte');

