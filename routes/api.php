<?php

use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\EnsureTokenIsValid;

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

Route::get('posts',[PostsController::class,'index']);
Route::post('user',[UserController::class,'store']);
Route::post('login',[UserController::class,'login']);
Route::middleware('token')->group(function ()
{
    Route::get('logout',[UserController::class,'logout']);
    Route::get('index',[UserController::class,'index']);
});

