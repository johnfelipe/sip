<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

// Authentication
Route::get('login', array('as' => 'login', 'uses' => 'AuthController@showLogin'));
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@getLogout');

// Secure-Routes
Route::group(array('before' => 'auth'), function()
{
    Route::get('secret', 'HomeController@showSecret');
});

    
Route::get('evaluaciones', array('uses' => 'EvaluacionesController@mostrarEvaluaciones'));
Route::post('evaluaciones', array('uses' => 'EvaluacionesController@crearEvaluacion'));

// esta ruta contiene un parámetro llamado {id}, que sirve para indicar el id de la evaluacion que deseamos buscar
// este parámetro es pasado al controlador, podemos colocar todos los parámetros que necesitemos
// solo hay que tomar en cuenta que los parámetros van entre llaves {}
// si el parámetro es opcional se colocar un signo de interrogación {parámetro?}
Route::get('evaluaciones/{id}', array('uses'=>'EvaluacionesController@verEvaluacion'));
Route::get('evaluaciones/borrar/{id}', array('uses'=>'EvaluacionesController@eliminarEvaluacion'));

Route::get('evaluaciones.mapa_tecnico', array('uses' => 'EvaluacionesController@mapaTecnico'));
Route::post('evaluaciones.mapa_tecnico', array('uses' => 'EvaluacionesController@subirMapaTecnico'));

Route::get('evaluaciones/generar_mapa_tecnico/{id}', array('uses'=>'EvaluacionesController@generarKey'));
Route::get('evaluaciones/descargar_mapa_tecnico/{id}', array('uses'=>'EvaluacionesController@descargarKey'));

Route::get('calificacion.subir_respuestas', array('uses' => 'EvaluacionesController@viewSubirRespuestas'));
Route::post('calificacion.subir_respuestas', array('uses' => 'EvaluacionesController@subirRespuestas'));

Route::get('calificacion/calificar/{id}', array('uses'=>'EvaluacionesController@calificar'));
Route::get('calificacion/calculoIneval/{id}', array('uses'=>'EvaluacionesController@calculoIneval'));
Route::get('calificacion/descargar_calificaciones/{id}', array('uses'=>'EvaluacionesController@descargarCalificaciones'));

Route::get('calificacion.cargar_archivo', array('uses' => 'EvaluacionesController@viewCargarArchivo'));
Route::post('calificacion.cargar_archivo', array('uses' => 'EvaluacionesController@cargarArchivo'));

Route::get('calibracion/bilog', array('uses' => 'EvaluacionesController@bilog'));
Route::get('calibracion/bilog/{id},{nivel}', array('uses'=>'EvaluacionesController@generarBilog'));

