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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
});

Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'task'

], function ($router) {

    Route::post('create', [\App\Http\Controllers\TaskController::class,'create']);
    Route::post('update', [\App\Http\Controllers\TaskController::class,'update']);
    Route::post('delete', [\App\Http\Controllers\TaskController::class,'delete']);
    Route::post('show', [\App\Http\Controllers\TaskController::class,'show']);
});
