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

Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');
 
Route::group(['middleware' => 'auth'], function () {
    
    Route::get('siswa', 'SiswaController@index');
    Route::post('siswa/create', 'SiswaController@create');
    Route::get('siswaEdit/{id}', 'SiswaController@showFormUpdate');
    Route::post('siswaUpdate/{id}', 'SiswaController@update');
    Route::get('siswaDelete/{id}', 'SiswaController@delete');

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('logout', 'AuthController@logout')->name('logout');
 
});