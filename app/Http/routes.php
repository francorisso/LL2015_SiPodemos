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

Route::get('/', 'HomeController@index');
Route::get('/{id}', 'HomeController@show')
  ->where([ 'id' => '[0-9]+' ]);


Route::resource('picture-generator', 'PictureGenerator');

Route::get(
  'picture-generator/showImage/{id}',
  [
    'uses' => 'PictureGenerator@showImage'
  ])
  ->where([ 'id' => '[0-9]+' ]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
