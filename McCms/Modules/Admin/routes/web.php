<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Http\Controllers\AdminController;

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
Route::get('admin',function(){
    return view('admin::index');
});

// 框架内部路由
Route::prefix('admin')->name('admin.')->group(function () {

    // 框架内部主页的路由
    Route::get('home',function(){
        return view('admin::home');
    })->name('home');
    //Route::resource('admin', AdminController::class)->names('admin');
});
