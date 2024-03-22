<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function image(Request $request){
        $file = $request->file('file');
        $res = $this->move($file);
        if($res){
            return [
                'code'=>200,
                'msg'=>'上传成功',
                'data'=>$res
            ];
        }else{
            return [
                'code'=>500,
                'msg'=>'上传失败',
            ];
        }
    }
    public function editormd(Request $request){
        $file = $request->file('editormd-image-file');
        $res = $this->move($file);
        if($res){
            return [
                'success'=>1,
                'message'=>'上传成功',
                'url'=>$res
            ];
        }else{
            return [
                'success'=>0,
                'message'=>'上传失败',
            ];
        }
    }
    protected function move($file){
        $filename = $file->getBasename().Str::random(6).'.'.$file->getClientOriginalExtension();
        $dir = 'uploads/'.date('Ymd');
        if($res =$file->move($dir,$filename)){
            return url($res->getPathname());
        }else{
            return false;
        }
    }
}
