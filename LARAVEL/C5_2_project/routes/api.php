<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;

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
Route::get('users',[UserController::class,'index']);
Route::post('login',[UserController::class,'login']);
//private routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('staff',[StaffController::class,'index']);
    Route::get('staff/{id}',[StaffController::class,'show']);
    Route::post('staff',[StaffController::class,'store']);
    Route::put('staff/{id}',[StaffController::class,'update']);
    Route::delete('staff/{id}',[StaffController::class,'destroy']);
    Route::post('logout',[UserController::class,'logout']);
});

