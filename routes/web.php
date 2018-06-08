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

Route::post('/login',"LoginController@login");
Route::get('/login','LoginController@login');

Route::post('/register',"LoginController@register");
Route::get('/register',"LoginController@register");

Route::post('/logout',"LoginController@logout");
Route::get('/logout',"LoginController@logout");
