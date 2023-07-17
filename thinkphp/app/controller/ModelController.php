<?php
namespace app\controller;

use app\BaseController;
use app\model\User;

class ModelController extends BaseController{
    public function index(){
        $user = User::select();
        dump($user);
        return User::getLastSql();
    }
}
