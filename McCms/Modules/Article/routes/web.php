<?php

use Illuminate\Support\Facades\Route;
use Modules\Article\App\Http\Controllers\PostController;

// use Modules\Article\App\Http\Controllers\ArticleController;

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

Route::group(['middleware'=>'web','auth:admin'], function () {
    // Route::resource('article', ArticleController::class);
});
Route::prefix('article')->name('article.')->middleware(['web','auth:admin'])->group(function () {
    Route::resource('category',CategoryController::class);
    Route::resource('post',PostController::class);
    route::get('test',[PostController::class,'test'])->name('post.test');
});
