<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserOld;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = UserOld::all();
        echo "<pre>";
        echo "总用户数:".$users->count()."\n";
        $tel_null_users = $users->where('phone','')->all();
        echo "电话为空的用户数:".count($tel_null_users)."\n";
        foreach($users as $k =>$u){
            if($u->phone == ''){
                $u = $this->makeUserInfo($u);
                echo '电话:'.$u->phone."\t用户名:".$u->name."\n";
            }
        }
    }

    /**
     * 原始用户id为5位
     * 虚拟号段为190xxxIDIDI
     * 无姓名无电话的为190001
     * 有姓名无电话的为190002
     * 无姓名无电话但有推荐关系的为190003
     */
    public function makeUserInfo($user){
        if(count($user->children) > 0){
            echo "有关系";
            $prefix = '190003';
            if(trim($user->name) == ''){
                echo "-无姓名\t";
                $user->name = '无电话有关系';
            }else{
                echo "-有姓名\t";
            }
        }elseif(trim($user->name) !=''){
            echo "无关系-有姓名\t";
            $prefix = '190002';

        }else{
            echo "无关系-无姓名\t";
            $prefix= '190001';
            $user->name = '无电话无关系';
        }
        $phone  = $prefix.str_pad($user->id,5,'0',STR_PAD_LEFT);
        $user->phone = $phone;
        return $user;
    }
}
