<?php

namespace App\Http\Controllers;

use App\Http\Models\Book;
use App\Http\Models\Profile;
use App\Http\Models\Role;
use App\Http\Models\User;
use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\ErrorHandler\Collecting;
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
        $users = DB::table('users')
            ->leftJoin('books','users.id','=','books.user_id')
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
        //$user =User::withoutGlobalScope(StatusScope::class)->get();
        //return $user;
        User::create([
            'username' => '布兰登-史塔克',
            'password' => '123',
            'email'     => 'brandon@north',
            'details'   => 'create'
        ]);
    }
    public function collection(){
        $collection = collect(['龙妈','小指头','小恶魔',null,'Mr.Cookie']);
        // dd($collection);
        //dd ($collection->map(function($val,$key){
        //    return $key.'['.$val.']';
        //})->all());
        // dd ($collection->reject(function($val,$key){
            // return $val === null;
        // })->all());
        // dd ($collection->filter(function($val,$key){
            // return $val === null;
        // })->all());
        // dd ($collection->search('小指头'));
        //return $collection->chunk(2);
        // Collection::macro('toUpper',function(){
            // return $this->map(function($val){
                // return strtoupper($val);
            // });
        // });
        // dd($collection->count());
        // $collection = collect([1,1,3,3,3,3]);
        // return $collection->countBy();

        // $collection = collect(['xiaoxin@163.com','yihui@163.com','xiaoying@qq.com']);
        // return $collection->countBy(function($val){
            // return substr(strrchr($val,'@'),1);
        // });
        // $collection = collect([1,2,3,4,5]);
        // return $collection->diff([3,5]);

        // $collection = collect([1,2,3,4,5,6]);
        // return $collection->slice('3');


        // $profiles = User::find(19)->profile;
        // return $profiles;
        // $user = Profile::find(1)->user;
        // return $user->profile;

        // $books = User::find(19)->book()->where('title','like','%莎%')->get();
        // return $books;
        // $roles  = User::find(19)->role;
        // return $roles;
        // // $user = Role::find(1)->user;
        // return $user;
        // $books = User::find(19)->book;
        // return $books;
        $user = User::withCount('book')->get();
        return $user;
    }
}
