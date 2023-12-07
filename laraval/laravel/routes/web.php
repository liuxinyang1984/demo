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
Route::get('task',[\App\Http\Controllers\TaskController::class,'index']);
// Route::get('task/{id}/{name}',[\App\Http\Controllers\TaskController::class,'showId'])->where(['id'=>'[0-9]+','name'=>'[a-z,A-Z,0-9]+']);

//Route::view('view','task',['id'=>10]);
Route::any('url',[\App\Http\Controllers\TaskController::class,'url']);
Route::group(['prefix'=>'api'],function(){
    Route::any('task',[\App\Http\Controllers\TaskController::class,'index'])->name('task.index');
});
Route::get('one','\App\Http\Controllers\OneController');
Route::get('current',function(){
    return response([1,2,3]);
    return [1,2,3];
})->name('index');
Route::any('redirect',[\App\Http\Controllers\TaskController::class,'redirect']);


Route::resource('blogs','\App\Http\Controllers\BlogController');
Route::resource('blogs.comments','\App\Http\Controllers\CommentController')->shallow()->names([
    'index'=>'b.c.i',
    'create' =>'b.c.e'
])->parameters([
    'blogs'=>'id',
    'comments'=>'cid'
]);


Route::prefix('task')->name('task.')->group(function(){
    Route::any('form',[\App\Http\Controllers\TaskController::class,'form']);
    Route::any('getform',function(){
        return \Illuminate\Support\Facades\Request::method();
    });
});

Route::prefix('data')->name('data.')->group(function(){
    Route::any('/',[\App\Http\Controllers\DataController::class,'index']);
});

