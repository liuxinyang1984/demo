<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/',[IndexController::class,'home'])->name('home');
Route::get('/home',[IndexController::class,'home'])->name('home');
Route::resource('user',\App\Http\Controllers\UserController::class);
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('login',[LoginController::class,'store'])->name('login');
