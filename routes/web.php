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
Route::get('/lamaran', 'LamaranController@index');
Route::get('/peserta', 'pesertaController@index');
Route::post('/postlamaran', 'LamaranController@store');
Route::get('/daftar', 'LamaranController@create');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home');
Route::get('/logout', 'loginController@logout');
Route::post('cv/{id}', 'LamaranController@download');
Route::get('/sekolah', 'SekolahController@index');
Route::get('/sekolah/create', 'SekolahController@create');
Route::get('/sekolah/edit/{id}', 'SekolahController@edit');
Route::post('/sekolah/update/{id}', 'SekolahController@update');
Route::post('/sekolah/delete/{id}', 'SekolahController@destroy');
Route::post('/sekolah/store', 'SekolahController@store');

Route::post('/postAccount/{id}', 'pesertaController@post');


