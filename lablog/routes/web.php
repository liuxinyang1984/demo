<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
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
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('login',[LoginController::class,'store'])->name('login');
Route::post('findpassword',[PasswordController::class,'show'])->name('findPasswordByEmail');

Route::prefix('password')->name('password.')->group(function(){
    Route::get('find',[\App\Http\Controllers\PasswordController::class,'show'])->name('find');
    Route::post('sendemail',[PasswordController::class,'send'])->name('sendEmail');
    Route::get('reset/{token}',[PasswordController::class,'edit'])->name('reset');
    Route::post('update',[PasswordController::class,'update'])->name('update');
});



// 用户相关
Route::resource('user',\App\Http\Controllers\UserController::class);
Route::prefix('user')->name('user.')->group(function(){
    Route::get('follow/{user}',[\App\Http\Controllers\UserController::class,'follow'])->name('follow');
    Route::get('follower/{user}',[\App\Http\Controllers\FollowController::class,'follower'])->name('follower');
    Route::get('following/{user}',[\App\Http\Controllers\FollowController::class,'following'])->name('following');
});

// 博客相关
Route::resource('blog',\App\Http\Controllers\BlogController::class);
