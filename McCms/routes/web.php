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
    return view('testcss');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/upload', [App\Http\Controllers\UploadController::class, 'image'])->name('upload.image');
Route::post('/upload_editormd', [App\Http\Controllers\UploadController::class, 'editormd'])->name('upload.editormd');
