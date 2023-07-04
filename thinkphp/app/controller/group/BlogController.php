<?php
namespace app\controller\group;

use app\BaseController;
use app\model\User;
use think\facade\Db;

class BlogController extends BaseController{
    public function index(){
        $user = Db::table('tp_user')->find();
    }
    public function testData(){
        $user = Db::table('tp_user')->select();
        return json($user);
    }
    public function getUser(){
        $user = User::select();
        return json($user);
    }
}
