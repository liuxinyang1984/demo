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


        //
        $users = DB::table('users')->select(DB::raw('COUNT(*) as count,gender'))
            ->groupBy('gender')
            ->havingRaw('count > 5')
            ->get();
        $users = DB::table('users')->leftJoin('books','users.id','=','books.user_id')
                                   ->leftJoin('profiles','users.id','=','profiles.user_id')
                                   ->select('users.id','users.username','books.title','profiles.hobby')
                                   ->get();

        $res = DB::table('users')->updateOrInsert(
            ['id'=>101],
            [
                'list->id' => 22
            ]);
        return $res;
    }
    public function model(){
        //$user = User::all()->toArray();
        //$user= User::all
        //dd($user);
        // $user = new User();
        // $user->username = '艾德-史塔克';
        // $user->password = '123';
        // $user->email = 'stack@north';
        // $user->details = "model save";
        // $user->save();
        // $user = User::find(308);
        // $user->username='罗柏-史塔克';
        // $user->save();

        // $users = User::where('username','辉夜')
            // ->update([
                // 'username'=>'提利昂-兰尼斯特'
            // ]);
        // User::create([
            // 'username' => '布兰登-史塔克',
            // 'password' => '123',
            // 'email'     => 'brandon@north',
            // 'details'   => 'create'
        // ]);
        //
        // $user = User::find(80);
        // $res = $user->delete();
        // $res = User::destroy(100);
        // $users  = User::where('username','like','%洋%');
        // $res = $users->delete();



        // $request = [
            // 'username' => '班扬-史塔克',
            // 'password' => '123',
            // 'email'     => 'benjen@north',
            // 'details'   => 'create',
            // 'slogan'    => 'winner is comming',
            // 'age'       => '46'
        // ];
        // $res = User::create($request);
        // $users = User::where('username','like','%孙%');
        // $res = $users->delete();
        //User::destroy([24,25,26,27]);
        $user = User::gender('女')->where('price','>','60')->get()->toArray();
        return dd($user);
    }
}
