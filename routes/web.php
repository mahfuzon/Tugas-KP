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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lamaran', 'LampiranController@index')->middleware('auth');
Route::post('/lamaran/delete/{id}', 'LampiranController@destroy');
Route::get('/peserta', 'pesertaController@index');
Route::get('/peserta/export', 'pesertaController@export');
Route::post('/postlamaran', 'LampiranController@store');
Route::get('/daftar', 'LampiranController@create');
Route::get('/logout', 'loginController@logout');
Route::post('cv/{id}', 'LamaranController@download');
Route::get('/sekolah', 'SekolahController@index')->middleware('auth');
Route::get('/sekolah/create', 'SekolahController@create');
Route::get('/sekolah/edit/{id}', 'SekolahController@edit');
Route::post('/sekolah/update/{id}', 'SekolahController@update');
Route::post('/sekolah/delete/{id}', 'SekolahController@destroy');
Route::post('/sekolah/store', 'SekolahController@store');
Route::post('/postAccount/{id}', 'pesertaController@post');

Route::get('/change-password/{id}', 'UserController@edit');
Route::post('/change-password/{id}', 'UserController@update');



