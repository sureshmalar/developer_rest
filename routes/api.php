<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'developers'
], function () {

    Route::post('/register', 'DevelopersController@registerDevelopers');
    Route::post('/login', 'DevelopersController@loginDevelopers');
    Route::post('/forgotPassword', 'DevelopersController@forgotPassword');
    
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/getDevelopersById/{id}', 'DevelopersController@getDevelopersById');
        Route::post('/update', 'DevelopersController@updateDevelopers');
        Route::get('/delete/{id}', 'DevelopersController@deleteDevelopers');
        Route::get('/getAllDevelopers', 'DevelopersController@getAllDevelopers');
        Route::post('/deleteMultipleDevelopers', 'DevelopersController@deleteMultipleDevelopers');
    });
    
    
});