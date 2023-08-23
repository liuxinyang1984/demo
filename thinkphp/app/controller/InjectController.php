<?php
namespace app\controller;

use app\facade\Test;
use app\model\One;
class InjectController{
    protected $test;
    public function __construct(One $test){
        $this->test = $test;
    }
    public function index(){
        return $this->test->myname;
    }
    public function bind(){
        bind('one','app\model\One');
        return app('one')->myname;
        var_dump(app('one'));
    }
    public function facade(){
        return Test::hello('Mr.Cookie');
    }
}
