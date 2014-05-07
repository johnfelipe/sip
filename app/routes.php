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

//Route::get('evaluaciones/nuevo', array('uses' => 'EvaluacionesController@nuevaEvaluacion'));
 
//Route::post('evaluaciones/crear', array('uses' => 'EvaluacionesController@crearEvaluacion'));
// esta ruta es a la cual apunta el formulario donde se introduce la información de la evaluacion
// como podemos observar es para recibir peticiones POST
 
Route::get('evaluaciones/{id}', array('uses'=>'EvaluacionesController@verEvaluacion'));
// esta ruta contiene un parámetro llamado {id}, que sirve para indicar el id de la evaluacion que deseamos buscar
// este parámetro es pasado al controlador, podemos colocar todos los parámetros que necesitemos
// solo hay que tomar en cuenta que los parámetros van entre llaves {}
// si el parámetro es opcional se colocar un signo de interrogación {parámetro?}

Route::get('evaluaciones/borrar/{id}', array('uses'=>'EvaluacionesController@eliminarEvaluacion'));

/*
Route::get('/', function()
{
    $admin = new Role();
    $admin->name = 'Administrador';
    $admin->save();
 
    $psicometrico = new Role();
    $psicometrico->name = 'Psicometrico';
    $psicometrico->save();

    $visita = new Role();
    $visita->name = 'Visita';
    $visita->save();
 
    $full = new Permission();
    $full->name = 'full';
    $full->display_name = 'Accesso Total';
    $full->save();
 
    $calificacion = new Permission();
    $calificacion->name = 'calificacion';
    $calificacion->display_name = 'Accesso módulo de calificación';
    $calificacion->save();

    $calibracion = new Permission();
    $calibracion->name = 'calibracion';
    $calibracion->display_name = 'Accesso módulo de calibración';
    $calibracion->save();
 
    $admin->attachPermission($full);
    $psicometrico->attachPermission($calificacion);
    $psicometrico->attachPermission($calibracion);
     
    $user1 = User::find('admin');
    $user2 = User::find('psicometrico');
 
    $user1->attachRole($admin);
    $user2->attachRole($psicometrico);
 
    return 'Roles creados exitosamente!';
});*/

