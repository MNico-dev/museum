<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('cuadros', 'PaintingController');
    Route::get("api/logout" , ['uses' => "AuthController@logout" , 'as' => 'api.logout']);
});

Route::get("api/login" , ['uses' => "AuthController@login" , 'as' => 'api.login']);
Route::post("api/login" , ['uses' => "AuthController@postLogin" , 'as' => 'api.post.login']);

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
