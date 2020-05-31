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
use App\Mail\Coba;

Route::get('/', function () {
    return redirect('/daftar');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lamaran', 'LampiranController@index')->middleware('auth', 'guest');
Route::post('/lamaran/delete/{id}', 'LampiranController@destroy');
Route::post('/lamaran/tolak/{id}', 'LampiranController@tolak');
Route::get('/peserta', 'pesertaController@index');
Route::get('/peserta/export', 'pesertaController@export');
Route::get('/peserta/edit/{id}', 'pesertaController@edit');
Route::post('/peserta/delete/{id}', 'pesertaController@destroy');
Route::post('/postedit/{id}', 'pesertaController@update');
Route::post('/postlamaran', 'LampiranController@store');
Route::get('/daftar', 'LampiranController@create');
Route::get('/logout', 'loginController@logout');
Route::post('cv/{id}', 'LampiranController@download');
Route::get('/sekolah', 'SekolahController@index')->middleware('auth');
Route::get('/sekolah/create', 'SekolahController@create');
Route::get('/sekolah/edit/{id}', 'SekolahController@edit');
Route::post('/sekolah/update/{id}', 'SekolahController@update');
Route::post('/sekolah/delete/{id}', 'SekolahController@destroy');
Route::post('/sekolah/store', 'SekolahController@store');
Route::post('/postAccount/{id}', 'pesertaController@post');

Route::get('/change-password/{id}', 'UserController@edit');
Route::post('/change-password/{id}', 'UserController@update');
Route::get('/user', 'UserController@index');
Route::post('/user/delete/{id}', 'UserController@destroy');

Route::get('/1','EmployeesController@index');
Route::post('/employees/getEmployees/','EmployeesController@getEmployees')->name('employees.getEmployees');

Route::get('search', 'SearchController@index')->name('search');
Route::get('autocomplete', 'SearchController@autocomplete')->name('autocomplete');

Route::get('coba', function(){
    Mail::to('mahfuzon0@gmail.com')->send(new Coba);
});
