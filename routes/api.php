<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::group(['middleware' => 'jwt.auth'], function(){
        Route::group(['namespace' => 'App\Http\Controllers\Fruit', 'prefix' => 'fruits'], function(){
            Route::get('/', IndexController::class);
        });
    });
});



Route::group(['namespace' => 'App\Http\Controllers\User', 'prefix' => 'users'], function(){
    Route::post('/', StoreController::class);
});


