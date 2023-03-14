<?php

namespace App\Http\Controllers;

use App\Models\Advertisements;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('index', [ReviewController::class, 'index'])->name('index');
Route::get('/', [AdvertisementController::class, 'index'])->name('index');
Route::get('{category}', [AdvertisementController::class, 'index'])->name('category');
Route::post('store', [AdvertisementController::class, 'store'])->name('store');
        //Route::get('/',function (){
        //    return view('welcome');
       // });
Route::post('update',[AdvertisementController::class, 'update'])->name('update');

