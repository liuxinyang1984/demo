<?php
namespace app\controller;

use think\annotation\Inject;
use think\annotation\route\Get;
use think\annotation\route\Group;
use think\annotation\route\Middleware;
use think\annotation\route\Resource;
use think\annotation\route\Route;
/**
 * 测试注释路由
 * @param int $id
 * @return string
 * @route ("details/:id)
 */
class RouteController{
    public function test($id){
        return "<h1>测试注释路由:$id</h1>";
    }
}
