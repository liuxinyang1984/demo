<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function index($param1,$param2){
        return request()->input();
    }
    public function form(){
        return view('form');
    }
    public function url(){
        return URL::signedRoute('user.url.id',['id'=>5]);
    }
    public function cookie(){

    }
    public function sess(){
        return session()->all();
    }
}
