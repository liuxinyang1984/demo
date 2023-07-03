<?php
namespace app\controller;

use app\BaseController;

class TestController extends BaseController{
    public function index(){
        return "index->".$this->request->action()."()<br>".'path:'.$this->app->getBasePath();
    }
    public function output(){
        $data = [
            'a' =>1,
            'b' =>2,
            'c' =>3
        ];
        return json($data);
    }
}
