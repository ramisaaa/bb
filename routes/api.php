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

    Route::post('register',  [\App\Http\Controllers\AuthController::class,'register']);
    Route::post('login',  [\App\Http\Controllers\AuthController::class,'login'])->name('login');
    Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('me', [\App\Http\Controllers\AuthController::class,'me']);
});

Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'task'

], function ($router) {

    Route::post('create', [\App\Http\Controllers\TaskController::class,'create']);
    Route::post('update/{task}', [\App\Http\Controllers\TaskController::class,'update']);
    Route::post('delete/{task}', [\App\Http\Controllers\TaskController::class,'delete']);
    Route::post('show/{task}', [\App\Http\Controllers\TaskController::class,'show']);
});
