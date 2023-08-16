<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

//Route::get('think', function () {
    //return 'hello,ThinkPHP6!';
//});

//Route::get('hello/:name', 'index/hello');


//新建路由
//Route::rule('d/:id','address/details')
    //->pattern(['id'=>'\d+']);

Route::pattern(['id'=>'\d+','uid'=>'\d+']);
Route::rule('s/:id/:uid','Address/search');
Route::rule('h/:name/[:id]','Hello:name/index');
Route::rule('h-<name>-[<id>]','Hello:name/index');
Route::get('t/<str>',function($str){
    return "你在想:".$str;
});
Route::rule('gb/:id','group.blog/search');
Route::rule('d/:id','\app\controller\AddressController@details');
Route::redirect('rd/:id','http://tp.localhost',302);
Route::rule('dp/:id','Address/details')->ext('html|jsp')->https();
