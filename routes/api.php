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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function(){
    Route::post('login', 'API\AuthController@login'); 

    Route::post('register', 'API\AuthController@register');

    Route::group(['middleware' => 'jwt.verify'], function(){
        Route::get('siswa', 'API\SiswaController@index');
        Route::get('siswa/{id}', 'API\SiswaController@detail');
        Route::post('siswa', 'API\SiswaController@create');
        Route::put('siswa/{id}', 'API\SiswaController@update');
        Route::delete('siswa/{id}', 'API\SiswaController@delete');

        Route::post('logout', 'API\AuthController@logout');
    }); 
});