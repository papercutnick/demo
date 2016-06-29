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
use App\Group;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Modeltest', function () {
	DB::beginTransaction();
	$group = new Group(['name'=>'test1','description'=>'iweri']);
	$group->save();
	//$group->first_name='test';
	$group->owners()->saveMany([
		new App\User(['name' => 'owner1','netid'=>'udf345']),
		new App\User(['name' => 'owner2','netid'=>'dfl455']),
	]);
	DB::commit();

    return view('welcome');
});

Route::resource('group', 'GroupController');
