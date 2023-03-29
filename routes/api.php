<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserOnShiftController;
use App\Http\Controllers\Api\WorkShiftController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['token'=>'group:admin'])->group(function ()
{
    Route::get('logout',[UserController::class,'logout']);
    Route::get('index',[UserController::class,'index']);
    Route::post('work-shift',[WorkShiftController::class,'store']);
    Route::get('work-shift/{id}/open',[WorkShiftController::class, 'openShift']);
    Route::get('work-shift/{id}/close',[WorkShiftController::class, 'closeShift']);
    Route::post('work-shift/{id}/user',[UserOnShiftController::class, 'store']);
    Route::get('work-shift/{shift}/order',[WorkShiftController::class, 'shiftOrders']);
});

Route::middleware(['token'=>'group:waiter'])->group(function ()
{
    Route::post('order',[OrderController::class, 'store']);
    Route::get('order/{id}',[OrderController::class,'order']);
    Route::get('work-shift/{shift}/orders',[WorkShiftController::class, 'shiftOrders']);
    Route::patch('order/{id}/change-status',[OrderController::class,'setStatus']);
});

Route::middleware(['token'=>'group:cook'])->group(function ()
{
   Route::get('taken',[OrderController::class,'orderTaken']);

});

