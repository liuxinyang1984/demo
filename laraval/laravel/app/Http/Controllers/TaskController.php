<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        //return "<h1>Task->index()</h1>";
        return view('task',['id'=>"index"]);
    }
    public function showId($id,$name){
        return "ID:".$id."\tName:".$name;
    }
    public function url(){
        return response()->view('task',['id'=>33])->header('Content-type','text/html');
        return response('<b>index</b>')->header('Content-type','text/plain');
        return route('admin.index',['username'=>'yang']);
        return redirect(route('task.index'));
    }
    public function redirect(){
        return redirect()->route('task.index');
        return redirect('task');
    }
    public function form(Request $request){
        if(request()->isMethod('get')) return view('form');

        echo request()->method();
        dd($request->post());
    }
}
