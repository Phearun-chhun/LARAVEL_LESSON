<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
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
//public routes
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('items',[ItemController::class,'index']);
Route::get('items/{id}',[ItemController::class,'show']);
Route::get('users',[UserController::class,'index']);
Route::get('users/{id}',[UserController::class,'show']);
//private routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('items',[ItemController::class,'store']);
    Route::put('items/{id}',[ItemController::class,'update']);
    Route::delete('items/{id}',[ItemController::class,'destroy']);
    Route::post('logout',[UserController::class,'logout']);
    // Route::post('users',[UserController::class,'store']);
    // Route::put('users/{id}',[UserController::class,'update']);
    // Route::delete('users/{id}',[UserController::class,'destroy']);

});




