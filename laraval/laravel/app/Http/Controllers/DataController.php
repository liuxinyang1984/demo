<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Foreach_;

class DataController extends Controller
{
    public function index(){
        // echo "<h1>DataController->index()</h1><pre>";
        // return Str::plural('child');

        // 原生查询
        // $user = DB::select('select * from laravel_users');
        // return $user;

        // 查询构造器
        // $user = DB::table('laravel_users')->find(19);
        //return $user;

        // 模型查询
        // $user = User::all();
        // return $user;

        // $users = DB::table('users')->get();
        // $users = DB::table('users')->where('id',20)->value('email');
        // $users = DB::table('users')->find(20);
        // $users = DB::table('users')->pluck('username','id');
//
        // $users = DB::table('users')->orderBy('id')->chunk(3,function($users){
            // foreach($users as $user){
                // echo $user->username."\t";
            // }
            // echo "<hr>";
        // });
        // return $users;
        // dd(DB::table('users')->where('id',20)->exists());
        $users = DB::table('users')->select('username as name','email');
        $users = $users->addSelect('gender')->get();


        $users = DB::table('users')->select(DB::raw('COUNT(*) as count,gender'))
            ->groupBy('gender')
            ->havingRaw('count > 5')
            ->get();
        return $users;
    }
}
