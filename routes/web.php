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



Route::view('/login', 'auth/login');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
/*Route::get('alta_vehiculos', 'vehiculos\VehiculoController@listaAutobomba')->name('listaVehiculos');*/



/*Route::group(['prefix' => 'admin'], function () {*/

	Route::get('/', 'HomeController@index')->name('inicio');
	
	Route::group(['middleware' => ['auth']],function(){

		//limpiar cache
		Route::get('optimize', 'HomeController@limpiarCache');//
		//usuarios
		Route::get('usuarios', 'UsuarioController@index')->name('listaUsuarios');//\\\->middleware('permiso:usuarios.listaUsuarios');
		Route::post('usuarios', 'UsuarioController@asignarRol')->name('agregarRol');//->middleware('permiso:usuarios.asignarRol');
	/*	Route::post('eliminarUsuarios','UsuarioController@eliminarUsuario')->name('eliminarUsuario');*/
		Route::post('editarUsuario','UsuarioController@eliminarUsuario')->name('eliminarUsuario');
		Route::get('resetPassword/{id}','UsuarioController@resetPassword')->name('resetPassword')->middleware('permiso:usuarios.resetPassword');

		Route::post('apiJerarquia','UsuarioController@jerarquia')->name('jerarquia');

		Route::post('altaUsuario','UsuarioController@registroUsuario')->name('registroUsuario');
		//primer cambio
		Route::get('primerIngreso','UsuarioController@primerPassword')->name('primerPassword');

		Route::post('primerIngreso','UsuarioController@cambioPrimerPassword')->name('cambioPrimerPassword');

		Route::post('editarPerfil','UsuarioController@editarPerfil')->name('editarPerfil');

		//municipios
		Route::get('municipios', 'municipios\MunicipioController@index')->name('indexMunicipios');
		//crea municipio
		Route::post('crearMunicipio','municipios\MunicipioController@crearMunicipio')->name('crearMunicipio');
		//eliminar municipio
		Route::post('eliminarMunicipio','municipios\MunicipioController@eliminarMunicipio')->name('eliminarMunicipio');
		//editar municipio
		Route::post('editarMunicipio','municipios\MunicipioController@editarMunicipio')->name('editarMunicipio');
		//todos los municipios para el select2
		Route::get('getAllMunicipios','municipios\MunicipioController@getAllMunicipios')->name('getAllMunicipios');


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

		Route::get('storage/{carpeta}/{archivo}','vehiculos\VehiculoController@Imagen')->name('storage');
		
		//lista de vehiculos para select2
		Route::get('/vehiculos_select','vehiculos\VehiculoController@getAllVehiculos')->name('listaVehiculosSelect');

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
		//pdf baja definitiva
		Route::get('baja_definitiva_pdf/{id}', 'vehiculos\VehiculoController@exportarPdfBajaDefinitiva')->name('exportarPdfBajaDefinitiva');


		//asignacion
		Route::get('asignacion','vehiculos\AsignacionController@index')->name('listaAsignacion');
		//getAllVehiculosDisponibles -> select 2
		Route::get('vehiculos_disponibles','vehiculos\AsignacionController@getAllVehiculosDisponibles')->name('getAllVehiculosDisponibles');
		//getAllAfectadosDisponibles -> select 2
		Route::get('afectados_disponibles','vehiculos\AsignacionController@getAllAfectadosDisponibles')->name('getAllAfectadosDisponibles');
		//guardamos asignacion
		Route::post('asignacion','vehiculos\AsignacionController@crearAsignacion')->name('crearAsignacion');
		//eliminar asignacion
		Route::post('eliminar_asignacion','vehiculos\AsignacionController@eliminarAsignacion')->name('eliminarAsignacion');
		//PDF
		Route::get('asignar_vehiculos/{id}', 'vehiculos\AsignacionController@exportarPdfCargo')->name('pdfVehiculosCargo');

		//detalle de autos asignados a las ur
		Route::post('detalle_ur_vehiculos','HomeController@detalleUnidadRegional')->name('detalleUnidadRegional');
		
		//vehiculos detalles
		Route::get('/detalleVehiculo/{id?}', 'vehiculos\DetallesController@index')->name('detalleVehiculo');
		//descargar el historial del vehiculo
		Route::get('historial_completo_pdf/{id}', 'vehiculos\DetallesController@exportarPdfHistorial')->name('pdfVehiculos');

		//asignacion de siniestros
		Route::get('/siniestros', 'vehiculos\SiniestroController@indexSiniestros')->name('indexSiniestros');

		Route::post('/siniestros', 'vehiculos\SiniestroController@altaSiniestro')->name('altaSiniestro');

		Route::get('/total_siniestros', 'vehiculos\SiniestroController@getAllSiniestros')->name('getAllSiniestros');

		Route::post('/detalle_pdf_siniestro','vehiculos\SiniestroController@getAllPdfsSiniestro');

		Route::get('/descargar_pdf_siniestro/{nombre}','vehiculos\SiniestroController@descargaPdfSiniestro')->name('descargarPDF');

		Route::post('/editar_siniestro','vehiculos\SiniestroController@editarSiniestro')->name('EditarSiniestro');

		//asignacion repuestos
		Route::get('repuestos', 'vehiculos\RepuestoController@index')->name('listaRepuestos');

		Route::post('/repuestos', 'vehiculos\RepuestoController@AsignarRepuesto')->name('asignarRepuesto');

		Route::get('/vehiculos_select_vehiculos_disponibles','vehiculos\RepuestoController@getAllVehiculosDisponiblesRepuestos')->name('getAllVehiculosDisponiblesRepuestos');

		Route::get('asignar_vehiculos_repuestos/{id}', 'vehiculos\RepuestoController@exportarPdfRepuestos')->name('descargarPDFRepuesto');
		//editar repuestos
		Route::post('editar_repuesto', 'vehiculos\RepuestoController@editarRepuesto')->name('editarRepuesto');

		//reportes gdona
		Route::get('/reportes', 'vehiculos\GraficosController@index')->name('ListaGraficos');

		Route::post('/reportesFiltro', 'vehiculos\GraficosController@reportesListadoFiltro')->name('reportesListadoFiltro');

		Route::get('totalVehiculos/{nombre?}', 'vehiculos\vehiculos\VehiculoController@getTotalVehiculos')->name('getTotalVehiculos');

		Route::get('Descargar_pdf_Vehiculos', 'vehiculos\VehiculoController@exportarPdfVehiculos')->name('exportarPdfVehiculos');

		Route::post('/estado_alta_vehiculo', 'vehiculos\VehiculoController@AltadeVehiculosDadosDeBaja')->name('AltadeVehiculosDadosDeBaja');

		//datatable detalles
		Route::get('/detalle_Datatable/{vehiculo}', 'vehiculos\VehiculoController@detalleDatatable')->name('detalleDatatable');




	});
/*});*/
