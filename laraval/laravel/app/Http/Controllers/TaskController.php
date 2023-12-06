<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        //return "<h1>Task->index()</h1>";
        return view('task',['id'=>33]);
    }
    public function showId($id,$name){
        return "ID:".$id."\tName:".$name;
    }
    public function url(){
        return route('admin.index',['username'=>'yang']);
        return redirect(route('task.index'));
    }
}
