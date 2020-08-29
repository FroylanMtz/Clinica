<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResources(['user' => 'API\UserController']);

//Rutas del dashboard
Route::get('/totalusuarios', 'DashboardController@obtenertotalusuarios');
Route::get('/totalcitas', 'DashboardController@obtenertotalcitas');
Route::get('/totalenfermedades', 'DashboardController@obtenertotalenfermedades');
Route::get('/totalpacientes', 'DashboardController@obtenertotalpacientes');

//Rutas que controlan a los usuarios
Route::get('/usuarios', 'UserController@index')->name('usuarios.index');
Route::post('/registrarUsuario', 'UserController@store')->name('usuarios.store');
Route::delete('/eliminarUsuario/{id}', 'UserController@destroy')->name('usuarios.destroy');
Route::post('/actualizarUsuario', 'UserController@update')->name('usuarios.update');
Route::get('/obtenerDoctores', 'UserController@doctores')->name('usuarios.doctores');
Route::get('/obtenerMedicosAsociados', 'UserController@medicosAsociadoas')->name('usuarios.medicosasociados');
Route::get('/obtenerComparticiones', 'UserController@obtenerComparticiones')->name('usuarios.comparticiones');
Route::post('/registrarComparticion', 'UserController@guardarComparticion')->name('usuarios.guardarComparticion');
Route::delete('/eliminarComparticion/{id}', 'UserController@eliminarComparticion')->name('usuarios.eliminarComparticion');

Route::get('/obtenerAlergiasPaciente/{id}', 'UserController@obtenerAlergiasPaciente')->name('usuarios.obtenerAlergiasPaciente');
Route::get('/obtenerEnfermedadesPaciente/{id}', 'UserController@obtenerEnfermedadesPaciente')->name('usuarios.obtenerEnfermedadesPaciente');
Route::get('/obtenerMedicamentosPaciente/{id}', 'UserController@obtenerMedicamentosPaciente')->name('usuarios.obtenerMedicamentosPaciente');

//Rutas qeu controlan las enfermedades
Route::get('/obtenerEnfermedades', 'EnfermedadesController@index')->name('enfermedades.index');
Route::post('/registrarenfermedad', 'EnfermedadesController@store')->name('enfermedades.store');
Route::post('/actualizarenfermedad', 'EnfermedadesController@update')->name('enfermedades.update');
Route::delete('/eliminarenfermedad/{id}', 'EnfermedadesController@destroy')->name('enfermedades.destoy');

//Rutas que controlan la informacion de los pacientes
Route::get('/obtenerPacientes', 'PacientesController@index')->name('pacientes.index');
Route::get('/obtenerPacientesExpediente/{id}', 'PacientesController@obtenerPacientesExpediente')->name('pacientes.obtenerPacientesExpediente');
Route::post('/registrarPaciente', 'PacientesController@store')->name('pacientes.store');
Route::post('/actualizarPaciente', 'PacientesController@update')->name('pacientes.update');
Route::delete('/eliminarPaciente/{id}', 'PacientesController@destroy')->name('pacientes.delete');

//Rutas que controlan la informacion de las citas
Route::get('/obtnerCitas/{id}', 'CitasController@obtenerCitas')->name('Citas.obtenercitas');
Route::get('/obtenerCitasHoy/{id}', 'CitasController@citasDeHoy')->name('Citas.citasDeHoy');
Route::get('/obtenerDatosCita/{id}', 'CitasController@obtenerDatosCita');
Route::get('/cita', 'CitasController@index')->name('Citas.index');
Route::post('/agendarcita', 'CitasController@store')->name('Citas.store');
Route::delete('/eliminarcita/{id}', 'CitasController@destroy')->name('Citas.destroy');
Route::post('/actualizarcita', 'CitasController@update')->name('Citas.update');

//Rutas que controlan la informacio de los medicamento
Route::get('/obtenermedicamentos', 'MedicamentoController@index')->name('pacientes.index');
Route::post('/registrarMedicamento', 'MedicamentoController@store')->name('pacientes.store');
Route::post('/actualizarMedicamento', 'MedicamentoController@update')->name('pacientes.update');
Route::delete('/eliminarMedicamento/{id}', 'MedicamentoController@destroy')->name('pacientes.delete');


//Rutas que controlan la información de las alergias
Route::get('/obteneralergias', 'AlergiasController@index')->name('AlergiasController.index');
Route::post('/registrarAlergia', 'AlergiasController@store')->name('AlergiasController.store');
Route::post('/actualizarAlergia', 'AlergiasController@update')->name('AlergiasController.update');

Route::delete('/eliminarAlergia/{id}', 'AlergiasController@destroy')->name('AlergiasController.delete');


//Rutas para manejar la información del módulo pagos
Route::get('/obtenerpagos', 'PagosController@index')->name('PagosController.index');
Route::post('/registrarPagos', 'PagosController@store')->name('PagosController.store');
Route::post('/actualizarPagos', 'PagosController@update')->name('PagosController.update');
Route::delete('/eliminarPagos/{id}', 'PagosController@destroy')->name('PagosController.delete');

//Rutas para manejar la información del módulo caja cierre apertura
Route::get('/obtenercajas', 'CierreAperturaCajaController@index')->name('CierreAperturaCajaController.index');
Route::post('/actualizarcajas', 'CierreAperturaCajaController@update')->name('CierreAperturaCajaController.update');

//ruta para guardar los datos del analisis clinica (cita)
Route::post('/guardarAlergia', 'CitasController@alergia')->name('Citas.alergia');
Route::get('/obteneralergiasPaciente/{id}', 'CitasController@alergiaPaciente')->name('Cias.alergiaPaciente');
Route::post('/guardarPadecimiento', 'EnfermedadesController@padecimiento')->name('EnfermedadesController.padecimiento');
Route::get('/obtenerenfermedadesCita/{id}', 'EnfermedadesController@enfermedadesCita')->name('EnfermedadesController.enfermedadesCita');
Route::post('/guardarMedicamento', 'MedicamentoController@medicamento')->name('MedicamentoController.medicamento');
Route::get('/obtenermedicamentosCita/{id}', 'MedicamentoController@medicamentosCita')->name('MedicamentoController.medicamentosCita');

//Rutas que controlan las radiografias
Route::get('/obtenerRadiografias', 'RadiografiasController@index')->name('RadiografiasController.index');
Route::post('/guardarRadiografia', 'RadiografiasController@store')->name('RadiografiasController.store');
Route::delete('/eliminarRadiografia/{id}', 'RadiografiasController@destroy')->name('RadiografiasController.destroy');

//Rutas que controlan la vista para que el medico asociado comente la radiografia
Route::get('/obtenerRadiografiasCompartidas/{id}', 'RadiografiasController@obtenerRadiografiasCompartidas')->name('RadiografiasController.obtenerRadiografiasCompartidas');

Route::post('/guardarComentarioRadiografia', 'RadiografiasController@guardarComentarioRadiografia')->name('RadiografiasController.guardarComentarioRadiografia');

//Rutas que controlan los reportes

Route::get('/generarReporteCitas/{id}', 'ReportesController@generarReporteCitas');
Route::get('/generarReporteExpediente/{id}', 'ReportesController@generarReporteExpediente');
Route::get('/generarReportePago/{id}', 'ReportesController@generarReportePago');