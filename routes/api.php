<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([

    'middleware' => 'api',
    //'prefix' => 'auth'

], function ($router) {

    Route::post('login', [UserController::class,'login']);
    Route::post('logout', [UserController::class,'logout']);
    Route::post('refresh', [UserController::class,'refresh']);
    Route::post('me', [UserController::class,'me']);

    Route::get('tasks',[TaskController::class,'index']);
    Route::get('tasks/{id}',[TaskController::class,'show']);
   //Route::post('tasks',[TaskController::class,'store']);
    //Route::put('tasks/{id}',[TaskController::class,'update']);
    //Route::delete('tasks/{id}',[TaskController::class,'destroy']);

});


