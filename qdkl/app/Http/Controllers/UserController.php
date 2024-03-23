<?php

namespace App\Http\Controllers;

use App\Models\FinalTable;
use App\Models\LevelTable;
use App\Models\MiddleTable;
use App\Models\User;
use App\Models\UserOld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDO;

/**
 * 虚拟号段
 * 原无推荐人19999999999
 * 无姓名无电话的为190001
 * 有姓名无电话的为190002
 * 无姓名无电话但有推荐关系的为190003
 * 重复号码为190004
 */
class UserController extends Controller
{
    public function index(){
        $users = UserOld::all();
        echo "<pre>";
        echo "总用户数:".$users->count()."\n";
        $tel_null_users = $users->where('phone','')->all();
        echo "电话为空的用户数:".count($tel_null_users)."\n";
        foreach($users as $k =>$u){
            if($u->phone == ''){
                $u = $this->makeUserInfo($u);
                echo '电话:'.$u->phone."\t用户名:".$u->name."\n";
                Log::channel('telnull')->info("修改id:".$u->id."\t用户名:".$u->name."\t 电话:".$u->phone);
            }
            if($havePhone = MiddleTable::where('phone',$u->phone)->first()){
                $phone  = '190004'.str_pad($u->id,5,'0',STR_PAD_LEFT);
                echo "检测到用户:".$u->id."已有相同电话号码,原id:".$havePhone->id."\n";
                Log::channel('samephone')->info("检测到用户:".$u->id."已有相同电话号码".$havePhone->phone.",变更虚拟号为:".$phone);
                $u->phone = $phone;
            }
            if($midUser = MiddleTable::create($u->toArray())){
                echo "创建临时用户:".$midUser->name."成功\n";

            }else{
                Log::channel('telnull')->warning('用户'.$u->id.'创建失败');
            }
        }
    }

    public function level(){
        echo "<pre>";
        $newUsers = LevelTable::all();
        foreach ($newUsers as $value) {
            $user = MiddleTable::find($value->id);
            if(!isset($user->name)){
                continue;
            }
            if($value->phone == null){
                Log::channel('level')->warning("id:".$value->id."电话不存在");
            }
            if($user->phone != $value->phone){
                Log::channel('level')->warning("id:".$user->id."电话不一致\t原电话:".$user->phone."\t新电话:".$value->phone);
                echo "id:".$value->id."电话不一致\t原电话:".$user->phone."\t新电话:".$value->phone."\n";
            }
            if($user->level != $value->level){
                Log::channel('level')->warning("变更id:".$user->id.'级别'."\t原级别".$user->level."\t新级别:".$value->level);
                echo "变更id".$user->id.'级别'."\t原级别".$user->level."\t新级别:".$value->level."\n";
                $user->level = $value->level;
                $user->save();
            }
        }
    }

    public function final(){
        echo "<pre>";
            $tuike = 0;
            $exclude =0;
            $processed =0;
            $root = 0;
        $users = MiddleTable::all();
        foreach ($users as $user) {
            if($user->inviter_id == 0){
                $inviter_phone = '19999999999';
                $root ++;
            }else{
                $inviter = MiddleTable::find($user->inviter_id);
                if (!$inviter) {
                    echo "用户:" . $user->id . "未找到推荐人:" . $user->id . "\t推荐人id:" . $user->inviter_id . "\n";
                    Log::channel('final')->warning("用户:" . $user->id . "未找到推荐人:" . $user->inviter_id . "\t推荐人id:" . $user->inviter_id . "\t放入未处理列表");
                    Log::channel('exclude')->info('id:' . $user->id . "\t用户名:" . $user->name . "\t电话:" . $user->phone . "\t推荐人id" . $user->inviter_id);
                    $exclude++;
                    continue;
                }

                if (!isset($inviter->phone)) {
                    Log::channel('final')->error("用户:" . $inviter->id . "电话为空");
                    echo "用户:" . $inviter->id . "电话为空\n";
                    continue;
                }
                if ($user->inviter_phone != $inviter->phone) {
                    echo "用户:" . $user->id . "推荐人电话:" . $user->inviter_name . "与推荐人:" . $inviter->phone . "不符\n";
                    Log::channel('final')->alert("用户:" . $user->id . "\t推荐人电话:" . $user->inviter_phone . "\t与推荐人:" . $inviter->phone . "不符");
                }
                $inviter_phone = $inviter->phone;
            }


            switch ($user->level) {
                case '大区经理':
                    $level = 6;
                    $processed ++;
                    break;
                case '省级经理':
                    $level = 5;
                    $processed ++;
                    break;
                case '市级经理':
                    $level = 4;
                    $processed ++;
                    break;
                case '店长-县代':
                    $level = 3;
                    $processed ++;
                    break;
                case '员工-单店':
                    $level = 2;
                    $processed ++;
                    break;

                case '推客':
                    $tuike ++;
                default:
                    echo "id".$user->id."原级别为:".$user->level."\n";
                    $level = 1;
                    break;
            }
            $data = [
                //'id'=>$user->id,
                'name'=>$user->name,
                'phone'=>$user->phone,
                'inviter_phone'=>$inviter_phone,
                'level'=>$level
            ];
            if(!FinalTable::create($data)){
                echo '用户id'.$user->id.'写入错误';
                Log::channel('final')->error('用户id'.$user->id.'写入错误');
            }
        }

        $total = $processed+$tuike+$exclude;
        Log::channel('final')->info("处理用户:".$processed."\t推客:".$tuike.",级别为1\t未处理用户:".$exclude."共处理用户:".$total."\n");
        //Log::channel('final')->info("共有推客".$tuike."名未处理,级别为1\n");
    }

    /**
     * 原始用户id为5位
     * 虚拟号段为190xxxIDIDI
     * 无姓名无电话的为190001
     * 有姓名无电话的为190002
     * 无姓名无电话但有推荐关系的为190003
     */
    public function makeUserInfo($user){
        if(count($user->children) > 0){
            //echo "有关系";
            $prefix = '190003';
            if(trim($user->name) == ''){
                //echo "-无姓名\t";
                $user->name = '无电话有关系';
            }else{
                //echo "-有姓名\t";
            }
        }elseif(trim($user->name) !=''){
            //echo "无关系-有姓名\t";
            $prefix = '190002';

        }else{
            //echo "无关系-无姓名\t";
            $prefix= '190001';
            $user->name = '无电话无关系';
        }
        $phone  = $prefix.str_pad($user->id,5,'0',STR_PAD_LEFT);
        $user->phone = $phone;
        return $user;
    }
}
