<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        echo "登陆成功!";
    }
    public function relogin(){
        echo "登陆成功,请重新登陆";
    }
    public function login(){
        echo "请登陆";
    }
}
