<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\FindPasswordNotify;
use Auth;
use Illuminate\Http\Request;
use Notification;

class PasswordController extends Controller
{
    public function show(){
        return view('password.find');
    }
    public function send(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);
        //dd($request);
        $user = User::where('email',$request->email)->first();
        if($user){
            //dd($user);
            Notification::send($user,new FindPasswordNotify('test_token'));
            session()->flash('success','找回邮件已发送,请点击邮箱内链接,重置密码.');
            return redirect(route('login'));
        }else{
            //die('木有');
            session()->flash('warning','未找到正确邮箱,请确认后重新输入');
            return redirect(route('password.find'));
        }
    }
    public function edit($token){
        if($token == 'test_token'){
            $user = User::find(1);
            return view('password.reset',compact('user'));
        }else{
            session()->flash('warning','邮件已过期,请重新发送邮件!');
            return redirect('/');
        }
    }
    public function update(Request $request){
        //dd($request->post());
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);
        if($user = User::find($request->user_id)){
            $user->password = bcrypt($request->password);
            if($user->save()){
                //Auth::login($user);
                session()->flash('success','密码修改成功!');
                //return redirect(route('user.show',$user));
                return redirect(route('login'));
            }else{
                session()->flash('danger','密码修改失败!');
                return redirect(route('password.find'));
            }
        }else{
            session()->flash('danger','未找到该用户,请联系管理员!');
            return redirect(route('password.find'));
        }
    }
}
