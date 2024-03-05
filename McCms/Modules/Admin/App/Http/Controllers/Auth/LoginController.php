<?php

//namespace App\Http\Controllers\Auth;
namespace Modules\Admin\App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    // 重写父类方法
    public function showLoginForm()
    {
        return view('admin::login');
    }

    // 重写父类方法
    public function username()
    {
        return "username";
    }


    // 重写父类方法
    protected function guard()
    {
        return \Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        \Auth::guard('admin')->logout();
        session()->flash('success','退出成功');
        return redirect('/admin/login');
    }

}
