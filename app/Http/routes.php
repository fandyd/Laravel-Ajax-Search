<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* This is to render the first time it loads */
Route::get('/property/search', function () {
    return View::make('properties');
});


//restrict this for only index action, for future development we most likely to open other actions handler
Route::resource('properties', 'PropertyController',['only' => ['index', 'show']]);
