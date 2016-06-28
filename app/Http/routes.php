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
use App\GroupOwner;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Modeltest', function () {
	$group = new GroupOwner;
	$group->first_name='test';
	$group->save();
    return view('welcome');
});