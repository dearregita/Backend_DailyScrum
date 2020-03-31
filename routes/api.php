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
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login'); //do login

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('login/check', "UserController@LoginCheck"); //cek token    Route::get('login/check', "UserController@LoginCheck"); //cek token
    Route::get('user', "UserController@index"); //cek token
    Route::get('user/{limit}/{offset}', "UserController@getAll"); //read dengan limit petugas

    Route::get('daily', 'DailyScrumController@daily'); //do login
    Route::get('dailyAll', 'DailyScrumController@dailyAuth'); //do login

});