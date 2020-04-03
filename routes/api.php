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
    Route::post('logout', "UserController@logout"); //cek token
    Route::get('user', "UserController@index"); //cek token
    Route::get('user/{limit}/{offset}', "UserController@getAll"); //read dengan limit petugas

    //Dailyscrum
    Route::get('dailyscrum', "DailyScrumController@index"); //read poin
    Route::get('dailyscrum/{limit}/{offset}/{id_users}', "DailyScrumController@getAll"); //read poin
    Route::post('dailyscrum', 'DailyScrumController@store'); //create poin
    Route::delete('dailyscrum/{id}', 'DailyScrumController@delete'); //delete poin

    //data detail poin per siswa
	Route::get('dailyscrum/{id}','DailyScrumController@getDetailDaily');
    // Route::get('daily', 'DailyScrumController@daily'); //do login
    // Route::get('dailyAll', 'DailyScrumController@dailyAuth'); //do login

});