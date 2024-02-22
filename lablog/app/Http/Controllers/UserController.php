<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Testing\Fakes\Fake;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[
                'index','show','create','store'
            ]
        ]);
        $this->middleware('guest',[
            'only'=>['create','store']
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_list = User::paginate(20);
        return view('user.index',compact('user_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'username'=>'required|min:4|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        Auth::attempt(['username'=>$request->username,'password'=>$request->password]);
        session()->flash('success','登陆成功');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //dd($user->toArray());
        return view('user.show',compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'nickname' =>'required|min:3',
            'email' =>'nullable|email',
            'mobile' =>'nullable', //未添加忽略自己
            'password' => 'nullable|min:6|confirmed',
        ]);
        $user->nickname = $request->nickname;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->mobile=$request->mobile??$user->mobile;
        $user->save();
        session()->flash('success','用户信息修改成功');
        return redirect()->route('user.show',$user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success','删除用户成功');
        return redirect()->route('user.index');
    }
}
