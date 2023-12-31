<?php
namespace app\controller;

use app\BaseController;
use think\facade\Config;
use think\facade\Env;

class IndexController extends BaseController
{
    public function index()
    {
        $config = Env::get('database.hostname');
        echo "Env::".$config."<br>";
        $config = Config::get('database.connections.mysql.hostname');
        echo "Config::".$config."<br>";
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' .$name;
    }

    public function test($param = 'Yang'){
        
        echo "hello,".$param;
    }
    public function miss(){
        return "Index_Mr:miss";
    }
}
