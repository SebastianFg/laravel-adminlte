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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

//Route::get('/inicio', 'DashboardController@admin')->name('admin');
// Route::get('/dashboard/home', 'DashboardController@versionone')->name('home');
// Route::get('/dashboard/v2', 'DashboardController@versiontwo')->name('v2');
// Route::get('/dashboard/v3', 'DashboardController@versionthree')->name('v3');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('alta_vehiculos', 'vehiculos\VehiculoController@listaAutobomba')->name('listaVehiculos');



Route::group(['prefix' => 'admin'], function () {

	Route::get('/inicio', 'HomeController@index')->name('inicio');
	
	Route::group(['middleware' => ['auth']],function(){

		//usuarios
		Route::get('usuarios', 'UsuarioController@index')->name('listaUsuarios');//\\\->middleware('permiso:usuarios.listaUsuarios');
		Route::post('usuarios', 'UsuarioController@asignarRol')->name('agregarRol');//->middleware('permiso:usuarios.asignarRol');
		Route::post('eliminarUsuarios','UsuarioController@eliminarUsuario')->name('eliminarUsuario');//->middleware('permiso:usuarios.eliminarUsuario');


		//roles
		Route::get('roles','RolController@index')->name('listaRoles');
		//alta
		Route::post('roles','RolController@crear')->name('crearRol');
		//modificacion
		Route::post('editarRol','RolController@editarRol')->name('editarRol');
		//borrado
		Route::post('eliminarRol','RolController@eliminarRol')->name('eliminarRol');

		//permisos
		Route::get('permisos','PermisosController@index')->name('listaPermisos');
		//alta
		Route::post('permisos','PermisosController@crearPermiso')->name('crearPermiso');
		//modificacion
		Route::post('editarPermiso','PermisosController@editarPermiso')->name('editarPermiso');
		//borrado
		Route::post('eliminarPermiso','PermisosController@eliminarPermiso')->name('eliminarPermiso');

		//roles permisos -> donde asignamos cada permiso a su respectivo rol
		Route::get('roles-permisos','RolController@rolPermisoIndex')->name('rolPermisos');

		//asignacion-->modificacion
		Route::post('modificar-rol-permiso','RolController@editarRolPermiso')->name('editarRolPermiso');


		//dependencias
		Route::get('dependencias', 'dependencias\DependenciaController@index')->name('indexDependencia');
		//alta
		Route::post('dependencias', 'dependencias\DependenciaController@altaDependencia')->name('altaDependencia');
		//todas las dependencias para rellenar select
		Route::get('getDependencias', 'dependencias\DependenciaController@getDependecias');
		//baja
		Route::post('bajaDependencia', 'dependencias\DependenciaController@bajaDependencia')->name('bajaDependencia');
		//edicion
		Route::post('editarDependencia', 'dependencias\DependenciaController@editarDependencia')->name('editarDependencia');


		//vehiculos
		Route::get('alta_vehiculos', 'vehiculos\VehiculoController@index')->name('listaVehiculos');
		//alta
		Route::post('/alta_vehiculos', 'vehiculos\VehiculoController@crearVehiculo')->name('vehiculos.crearVehiculo');
		//editar
		Route::post('/editar_vehiculo', 'vehiculos\VehiculoController@updateVehiculo')->name('updateVehiculo');
		//baja
		Route::post('/baja_detalle_vehiculo', 'vehiculos\VehiculoController@fueraDeServicio')->name('eliminarVehiculos');

		//tipo vehiculos
		Route::get('tipo_vehiculos','vehiculos\TipoVehiculoController@index')->name('listaTipoVehiculos');
		//alta
		Route::post('alta_tipo_vehiculo','vehiculos\TipoVehiculoController@crearTipoVehiculo')->name('crearTipoVehiculo');
		//modificacion
		Route::post('editar_tipo_vehiculo','vehiculos\TipoVehiculoController@editarTipoVehiculo')->name('editarTipoVehiculo');
		//baja
		Route::post('baja_tipo_vehiculo','vehiculos\TipoVehiculoController@eliminarTipoVehiculo')->name('eliminarTipoVehiculo');

		//estado vehiculo
		///fuera de servicio
		Route::get('fuera_de_servicio', 'vehiculos\VehiculoController@indexEstadoFueraServicio')->name('listadoEstadoVehiculo');
		//baja definitiva
		Route::get('baja_definitiva', 'vehiculos\VehiculoController@indexEstadoBajaDefinitiva')->name('listadoEstadoBajaDefinitiva');
		//historial completo
		Route::get('historial_completo','vehiculos\VehiculoController@indexEstadoHistorialCompleto')->name('historialCompleto');
		//reparacion
		Route::post('fuera_de_servicio','vehiculos\VehiculoController@estadoVehiculoAlta')->name('altaEstadoVehiculo');
		//baja definitiva
		Route::post('baja_definitiva','vehiculos\VehiculoController@bajaDefinitiva')->name('bajaDefinitiva');


		//asignacion
		Route::get('asignacion','vehiculos\AsignacionController@index')->name('listaAsignacion');




		Route::get('totalVehiculos/{nombre?}', 'vehiculos\vehiculos\VehiculoController@getTotalVehiculos')->name('getTotalVehiculos');

		

		Route::post('conseguirVehiculo', 'vehiculos\VehiculoController@getidVehiculo')->name('getidVehiculo');







		Route::get('Descargar_pdf_Vehiculos/{dato}', 'vehiculos\VehiculoController@exportarPdfVehiculos');



		//baja definitiva
/*		Route::post('/baja_vehiculos', 'vehiculos\VehiculoController@bajaDefinitiva')->name('bajaDefinitiva');

		Route::get('/baja_definitiva', 'vehiculos\VehiculoController@bajaDefinitivaView')->name('bajaDefinitivaView');

		Route::get('/historial_vehiculos_baja_definitiva', 'vehiculos\VehiculoController@getHistorialVehiculosBajaDefinitiva')->name('getHistorialVehiculosBajaDefinitiva');*/

		//reanimacion

		Route::post('/estado_alta_vehiculo', 'vehiculos\VehiculoController@AltadeVehiculosDadosDeBaja')->name('AltadeVehiculosDadosDeBaja');

		//vehiculos detalle
		Route::get('/detalleVehiculo/{id}', 'vehiculos\VehiculoController@detalleVehiculo')->name('vehiculos.detalleVehiculo');
		//datatable detalles
		Route::get('/detalle_Datatable/{vehiculo}', 'vehiculos\VehiculoController@detalleDatatable')->name('detalleDatatable');
		//impresion pdf historial del vehiculo (historial asignacion)
		Route::get('historial_lista_pdf/{id}', 'vehiculos\VehiculoController@exportarPdfHistorial')->name('pdfVehiculos');


		//reportes gdona
		Route::get('/reportes', 'vehiculos\VehiculoController@reportesListado')->name('reportesListado');

		Route::post('/reportesFiltro', 'vehiculos\VehiculoController@reportesListadoFiltro')->name('reportesListadoFiltro');


		Route::POST('/recargaBuscador','vehiculos\VehiculoController@getVehiculosAfectados');

		Route::get('/buscarVehiculos','vehiculos\VehiculoController@getVehiculosEnReparacion');

		Route::post('/detallevehiculos\VehiculoController','vehiculos\VehiculoController@getDetalleVehiculoTodo');

		Route::get('/detalleVehiculoIndividual/{id}','vehiculos\VehiculoController@getdetalleVehiculoIndividual');

		/*Route::get('/historial_completo','vehiculos\VehiculoController@getAllHistorial');*/


		//asignacion
		Route::get('/posibles_afectados','vehiculos\VehiculoController@getPosibleAfectado');

		Route::get('asignar_vehiculos', 'vehiculos\VehiculoController@asignarlistado')->name('asignarlistado');

		Route::post('/asignar_vehiculos', 'vehiculos\VehiculoController@crearAsignacion')->name('vehiculos.crearAsignacion');

		Route::get('/lista_total_afectados', 'vehiculos\VehiculoController@totalAfectadosAsignacion')->name('totalAfectados');

		Route::post('/editar_asignacion', 'vehiculos\VehiculoController@editarAsignacion')->name('editar_vehiculo_asignado');

		Route::get('asignar_vehiculos/{id}', 'vehiculos\VehiculoController@exportarPdfCargo')->name('pdfVehiculosCargo');

		//asignacion repuestos
		Route::get('asignar_vehiculos_repuestos', 'vehiculos\VehiculoController@ListaDeVehiculosParaAsignarRepuestos')->name('asignarlistadorepuestos');

		Route::post('/asignar_vehiculos_repuestos', 'vehiculos\VehiculoController@AsignarRepuesto')->name('vehiculos.AsignarRepuesto');

		Route::get('/vehiculos_select','vehiculos\VehiculoController@getAllVehiculos');

		Route::get('/vehiculos_select_vehiculos_disponibles','vehiculos\VehiculoController@getAllVehiculosDisponibles');

		Route::get('/vehiculos_repuestos_asignados','vehiculos\VehiculoController@getVehiculosRepuestosAsignados');

		Route::get('asignar_vehiculos_repuestos/{id}', 'vehiculos\VehiculoController@exportarPdfRepuestos');

		//asignacion de siniestros
		Route::get('/siniestros', 'vehiculos\VehiculoController@indexSiniestros')->name('indexSiniestros');

		Route::post('/siniestros', 'vehiculos\VehiculoController@altaSiniestro')->name('altaSiniestro');

		Route::get('/total_siniestros', 'vehiculos\VehiculoController@getAllSiniestros')->name('getAllSiniestros');

		Route::post('/detalle_pdf_siniestro','vehiculos\VehiculoController@getAllPdfsSiniestro');

		Route::get('/descargar_pdf_siniestro/{nombre}','vehiculos\VehiculoController@descargaPdfSiniestro')->name('descargarPDF');

		Route::post('/editar_siniestro','vehiculos\VehiculoController@editarSiniestro')->name('EditarSiniestro');


	});
});



//Routes

/*Route::middleware(['auth'])->group(function(){
	//roles
	Route::post()->name()
				->middleware();
});*/