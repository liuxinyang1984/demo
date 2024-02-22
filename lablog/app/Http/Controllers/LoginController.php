<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function store(Request $request){
        $data = $this->validate($request,[
            'username'=>"required",
            'password'=>"required"
        ]);
        if(Auth::attempt($data)){
            session()->flash('success','登陆成功');
            return redirect('/');
        }else{
            session()->flash('warning','帐号或密码错误');
            return back()->withInput($data);
        }

    }

    public function logout(){
        Auth::logout();
        session()->flash('success','退出成功');
        return redirect('/');
    }
}
