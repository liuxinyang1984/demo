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

//Route::pattern(['id'=>'\d+','uid'=>'\d+']);
//Route::rule('s/:id/:uid','Address/search');
//Route::rule('h/:name/[:id]','Hello:name/index');
//Route::rule('h-<name>-[<id>]','Hello:name/index');
//Route::get('t/<str>',function($str){
    //return "你在想:".$str;
//});
//Route::rule('gb/:id','group.blog/search');
//Route::redirect('rd/:id','http://tp.localhost',302);
//Route::rule('dp/:id','Address/details')->ext('html|jsp');

//Route::domain('tp.localhost',function(){
    //Route::rule('dd/:id','Address/details');
//});
//Route::rule('dd/:id','\app\controller\AddressController@details')->allowCrossDomain([
    //'Access-Control-Allow-Origin' => 'http://tp.localhost'
//]);

Route::group('add',function(){
    Route::rule('d/:id','details');
    Route::rule('s/:name','search');
    Route::miss('miss');
})->ext('html')->pattern(['id'=>'\d+','name'=>'\w+'])->prefix('Address/');
//Route::miss('miss');

Route::resource('ads','Address');
