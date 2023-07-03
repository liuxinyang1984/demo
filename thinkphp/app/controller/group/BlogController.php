<?php
namespace app\controller\group;

use app\BaseController;
use think\facade\Db;

class BlogController extends BaseController{
    public function index(){
        echo "group.blog.index";
    }
    public function testData(){
        $user = Db::table('tp_user')->select();
        return json($user);
    }
}

