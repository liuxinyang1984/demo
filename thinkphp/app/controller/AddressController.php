<?php
namespace app\controller;

use think\facade\Route;

class AddressController{
    public function index(){
        return 'Address->index()';
    }
    public function details($id = "0"){
        return "id:".$id;
    } 
    public function url(){
        Route::rule('t/:id','Address/test')->name('t');
        return url('t',['id'=>5]);
    }
    public function test(){
        return 'test';
    }
    public function search($name = 'world'){
        return "Hello ".$name;
    }
    public function miss(){
        return "Address_Mr.Miss";
    }

}
