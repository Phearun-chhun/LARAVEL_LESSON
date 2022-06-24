<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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
Route::post('register',[UserController::class,'store']);
Route::get('users',[UserController::class,'index']);
Route::get('users_posts',[UserController::class,'getUserAndPost']);
Route::get('users_posts_comments',[UserController::class,'getUserAndPostComment']);
Route::get('users_posts_comments/{id}',[UserController::class,'getOneUserAndPostComment']);
Route::get('count_posts_comments',[UserController::class,'getUserAndCountPostComment']);
Route::post('login',[UserController::class,'login']);
//private routes
// Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('posts',[PostController::class,'index']);
    Route::get('posts/{id}',[PostController::class,'show']);
    Route::post('posts',[PostController::class,'store']);
    Route::put('posts/{id}',[PostController::class,'update']);
    Route::delete('posts/{id}',[PostController::class,'destroy']);

    Route::get('comments',[CommentController::class,'index']);
    Route::get('comments/{id}',[CommentController::class,'show']);
    Route::post('comments',[CommentController::class,'store']);
    Route::put('comments/{id}',[CommentController::class,'update']);
    Route::delete('comments/{id}',[CommentController::class,'destroy']);
    Route::post('logout',[UserController::class,'destroy']);
// });