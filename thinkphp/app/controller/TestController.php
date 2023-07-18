<?php
namespace app\controller;

use app\BaseController;
use app\model\User;

class TestController extends BaseController{
    public function index(){
        return "index->".$this->request->action()."()<br>".'path:'.$this->app->getBasePath();
    }
    public function output(){
        $user = new User();
        //$user->username = '不地狱咆哮';
        //$user->password = '123';
        //$user->gender   = '男';
        //$user->email    = 'dypx@163.com';
        //$user->price    = 100;
        //$user->details  = '那叫一个帅';
        //$user->uid      = 10010;           
        //$user->allowField(['username','password'])->save(); 

        //$data=[
            //[
                //'username' => 'MINI地狱咆哮1',
                //'password' => '123',
                //'gender'   => '男',
                //'email'    => 'dypx@163.com',
                //'price'    => 100,
                //'details'  => '那叫一个帅',
                //'uid'      => 10010,
            //],
            //[
                //'username' => 'MINI地狱咆哮2',
                //'password' => '123',
                //'gender'   => '男',
                //'email'    => 'dypx@163.com',
                //'price'    => 100,
                //'details'  => '那叫一个帅',
                //'uid'      => 10010,
            //]
        //];
        //$user ->saveAll($data);
        $user  = User::create([
            'username' => 'MINI地狱咆哮3',
            'password' => '123',
            'gender'   => '男',
            'email'    => 'dypx@163.com',
            'price'    => 100,
            'details'  => '那叫一个帅',
            'uid'      => 10010,
        ],
        [
            'username',
            'password',
            'details'
        ],
        false);
        echo $user->id;
    }
}
