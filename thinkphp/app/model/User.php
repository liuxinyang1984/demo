<?php
namespace app\model;
use think\Model;
use think\model\concern\SoftDelete;

class User extends Model{
    protected $readonly = ['username','email'];
    protected $json = ['list'];
    use SoftDelete;

    //protected $schema = [
        //'id'        =>  'int',
        //'username'  =>  'string',
        //'status'    =>  'int',
        //'email'     =>  'string',
        //'password' => 'string'
    //];
    public function getStatusAttr($value){
        $status = [-1 =>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
        if(isset($status[$value])){
            return $status[$value];
        }else{
            return "未定义";
        }
    }
    public function getLevAttr($val,$obj){
        if($obj['price'] > 50){
            return '大款';
        }else{
            return '屁民';
        }
    }
    public function scopeMale($queryObj){
        return $queryObj->where('gender','男')->field('id,username,gender,email');
    }
    public function scopeEmail($queryObj,$val){
        $queryObj->where('email','like','%'.$val.'%');
    }
    public function scopePrice($queryObj,$val){
        $queryObj->where('price','>',$val)->field('id,username,price');
    }
    public function searchEmailAttr($queryObj,$val,$data){
        $queryObj->where('email','like','%'.$val.'%');
    }
    public function searchCreateTimeAttr($queryObj,$val,$data){
        $queryObj->whereBetweenTime('create_teme',$val[0],$val[1]);
    }
}
