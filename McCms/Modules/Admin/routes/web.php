<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Http\Controllers\AdminController;
use Modules\Admin\App\Http\Controllers\Auth\LoginController;
use Modules\Admin\App\Http\Controllers\RoleController;

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


// 框架的路由
Route::middleware('web','auth:admin')->get('admin',[AdminController::class,'index']);

// 框架内部路由
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin'])->group(function () {
    // 认证模块
    // 框架内部主页的路由
    Route::get('home',[AdminController::class,'home'])->name('home');
    Route::resource('role',RoleController::class);
});
Route::prefix('admin')->name('admin.')->group(function(){
    Auth::routes();
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
});
