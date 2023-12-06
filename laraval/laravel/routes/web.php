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

// Route::get('/', function () {
    // return view('welcome');
// });
// Route::redirect('index','task',301);
// Route::get('user/{id}',function($id){
    // return "id:".$id;
// });
//
// Route::get('task',[\App\Http\Controllers\TaskController::class,'index']);
// Route::get('task/{id}/{name}',[\App\Http\Controllers\TaskController::class,'showId'])->where(['id'=>'[0-9]+','name'=>'[a-z,A-Z,0-9]+']);

//Route::view('view','task',['id'=>10]);
Route::any('url',[\App\Http\Controllers\TaskController::class,'url']);
Route::group(['prefix'=>'api'],function(){
    Route::any('task',[\App\Http\Controllers\TaskController::class,'index'])->name('task.index');
});
Route::prefix('admin')->name('admin.')->namespace('\App\Http\Controllers\Admin')->group(function(){
    Route::get('/',[IndexController::class,'index'])->name('index');
    Route::get('test',[IndexController::class,'index']);
});
Route::get('one','\App\Http\Controllers\OneController');
Route::get('current',function(){
    return response([1,2,3]);
    return [1,2,3];
})->name('index');
