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

