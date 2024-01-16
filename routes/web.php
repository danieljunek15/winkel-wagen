<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productList', [App\Http\Controllers\ProductListController::class, 'index'])->name('list');
Route::get('/productItemSubmit', [App\Http\Controllers\ProductListController::class, 'submitWinkelWagenData'])->name('productItemSubmit');

//Dit is de rout met ProductItem data (API)
Route::get('/productItem', [App\Http\Controllers\ProductItemDataAPIController::class, 'index'])->name('data');




