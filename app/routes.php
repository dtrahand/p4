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

Route::get('/get-environment',function() {
    echo "Environment: ".App::environment();
});

Route::get('/', function()
{
	return View::make('hello');
});

/**
* User
* (Explicit Routing)
*/
# Note: the beforeFilter for 'guest' on getSignup and getLogin is handled in the Controller
Route::get('/signup', 'UserController@getSignup');
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup'] );
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin'] );
Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout'] );
Route::post('/logout', ['before' => 'auth', 'uses' => 'UserController@postLogout'] );

Route::get('/liststudents', ['before' => 'auth', 'uses' => 'UserController@getListstudents'] );

/**
* Availabletime
* (Implicit RESTful Routing)
*/
Route::resource('time', 'TimeController');
Route::post('/time/create', 'TimeController@store');

/**
* Debug
* (Implicit Routing)
*/
Route::controller('debug', 'DebugController');


Route::get('mysql-test', function() {
    # Print environment
    echo 'Environment: '.App::environment().'<br>';
    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');
    # If the "Pre" package is not installed, you should output using print_r in-stead
    echo Pre::render($results);
});