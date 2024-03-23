<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'index']);
Route::get('level',[UserController::class,'level']);
Route::get('final',[UserController::class,'final']);
