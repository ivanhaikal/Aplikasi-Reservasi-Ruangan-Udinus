<?php

use Illuminate\Support\Facades\Route;

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
    return view('auths.login');
});

Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

Route::group(['middleware' => 'auth'],function(){

    Route::get('/dashboard','DashboardController@index');
    Route::get('/dashboard/reservationview','DashboardController@reservationview');
    Route::get('/dashboard/accountview','DashboardController@accountview');
    Route::get('/dashboard/roomview','DashboardController@roomview');
    Route::get('/dashboard/timeview','DashboardController@timeview');

    Route::get('/kelas','KelasController@index');
    Route::post('/kelas/create','KelasController@create');
    Route::get('/kelas/{id}/edit','KelasController@edit');
    Route::post('/kelas/{id}/update','KelasController@update');
    Route::get('/kelas/{id}/delete','KelasController@delete');
    Route::get('/kelas/{id}/preview','KelasController@preview');

    Route::get('/aula','AulaController@index');
    Route::post('/aula/create','AulaController@create');
    Route::get('/aula/{id}/edit','AulaController@edit');
    Route::post('/aula/{id}/update','AulaController@update');
    Route::get('/aula/{id}/delete','AulaController@delete');
    Route::get('/aula/{id}/preview','AulaController@preview');

    Route::get('/lab','LabController@index');
    Route::post('/lab/create','LabController@create');
    Route::get('/lab/{id}/edit','LabController@edit');
    Route::post('/lab/{id}/update','LabController@update');
    Route::get('/lab/{id}/delete','LabController@delete');
    Route::get('/lab/{id}/preview','LabController@preview');

    Route::get('/account','AccountController@index');
    Route::post('/account/create','AccountController@create');
    Route::get('/account/{id}/edit','AccountController@edit');
    Route::post('/account/{id}/update','AccountController@update');
    Route::get('/account/{id}/delete','AccountController@delete');
    Route::get('/account/{id}/profile','AccountController@profile');

    Route::get('/time','TimeController@index');
    Route::post('/time/create','TimeController@create');
    Route::get('/time/{id}/delete','TimeController@delete');
    Route::post('/time/{id}/update','TimeController@update');
    Route::get('/time/{id}/delete','TimeController@delete');

    Route::get('/reservation','ReservationController@index');
    Route::post('/reservation/create','ReservationController@create');
    Route::get('/reservation/{id}/delete','ReservationController@delete');
    Route::get('/reservation/{id}/edit','ReservationController@edit');
    Route::post('/reservation/{id}/update','ReservationController@update');
  
});



