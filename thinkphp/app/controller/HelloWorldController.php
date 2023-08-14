<?php
namespace app\controller;

class HelloWorldController{
    public function index($id=0){
        return "HelloWorld:".$id;
    }
}
