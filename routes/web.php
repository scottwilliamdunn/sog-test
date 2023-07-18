<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/fires', [\App\Http\Controllers\FireController::class, 'index'])->name('fires');
Route::get('/fires/{id}', [\App\Http\Controllers\FireController::class, 'show'])->name('fires.show');
Route::get('/{id}', [\App\Http\Controllers\PageController::class, 'view'])->name('view');
Route::get('/', [\App\Http\Controllers\PageController::class, 'home'])->name('home');
