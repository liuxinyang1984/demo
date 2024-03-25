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
            $newSys = [
                '15943096458',
                '18946684139',
                '13665328326',
                '15948758485',
                '18946660917'
            ];

            // 新系统用户
            if(in_array($user->inviter_phone,$newSys)){
                $tempName = $user->name??'';
                echo "用户:".$tempName.'('.$user->id.')推荐人为新系统:'.$user->inviter_phone."\n";
                Log::channel('final')->alert("用户:".$tempName.'('.$user->id.')推荐人为新系统:'.$user->inviter_phone);
                $inviter_phone = $user->inviter_phone;

               //  用户7(小米 尾号0917)电话改成19999999999
            }elseif ($user->inviter_id == '7') {
                $tempName = $user->name??'';
                echo "用户:".$tempName.'('.$user->id.')推荐人为:原用户7(小米 尾号0917)['.$user->inviter_phone."]\n";
                Log::channel('final')->alert("用户:".$tempName.'('.$user->id.')推荐人为:原用户7(小米 尾号0917)['.$user->inviter_phone.']');
                $inviter_phone = '19999999999';

                // 原用户8(文莲‘尾号15948758485)改成19999999998
            }elseif ($user->inviter_id == '5') {
                $tempName = $user->name??'';
                echo "用户:".$tempName.'('.$user->id.')推荐人为:原用户8(李女士‘尾号13134431390)['.$user->inviter_phone."]\n";
                Log::channel('final')->alert("用户:".$tempName.'('.$user->id.')推荐人为:推荐人为:原用户8(文莲‘尾号15948758485)['.$user->inviter_phone.']');
                $inviter_phone = '19999999997';

                // 原用户8(文莲‘尾号15948758485)改成19999999998
            }elseif ($user->inviter_id == '8') {
                $tempName = $user->name??'';
                echo "用户:".$tempName.'('.$user->id.')推荐人为:原用户8(文莲‘尾号15948758485)['.$user->inviter_phone."]\n";
                Log::channel('final')->alert("用户:".$tempName.'('.$user->id.')推荐人为:推荐人为:原用户8(文莲‘尾号15948758485)['.$user->inviter_phone.']');
                $inviter_phone = '19999999998';

                // 根用户
            }elseif($user->inviter_id == 0){
                $tempName = $user->name??'';
                $inviter_phone = '13134431390';
                echo "用户:".$tempName.'('.$user->id.")推荐人更改为12部[13134431390]\n";
                Log::channel('inviterroot')->info("用户:".$tempName.'('.$user->id.')推荐人更改为12部[13134431390]');
                $root ++;
            }else{
                $inviter = MiddleTable::find($user->inviter_id);

                // 未找到推荐人用户
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

                    $tempName = $user->name??'';
                    Log::channel('final')->alert("用户:".$tempName.'('.$user->id.')'. "推荐人电话:[" . $user->inviter_phone . "]变更为:[" . $inviter->phone . "]");
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
            if(strlen($user->phone) < 11){
                Log::channel('fixphone')->info('会员'.$user->id.'电话变更前:'.$user->phone);
                $phone = str_pad($user->phone,11,'0',STR_PAD_RIGHT);
                Log::channel('fixphone')->info('会员'.$user->id.'电话变更后:'.$phone."\n");
            }elseif(strlen($user->phone) > 11){
                Log::channel('fixphone')->info('会员'.$user->id.'电话变更前:'.$user->phone);
                $phone = substr($user->phone,0,11);
                Log::channel('fixphone')->info('会员'.$user->id.'电话变更后:'.$phone."\n");
            }else{
                $phone = $user->phone;
            }
            if(strlen($inviter_phone) > 11){
                Log::channel('fixphone')->info('会员'.$user->id.'推荐电话变后:'.$inviter_phone);
                $inviter_phone = substr($inviter_phone,0,11);
                Log::channel('fixphone')->info('会员'.$user->id.'推荐电话变更后:'.$inviter_phone."\n");
            }
            if(strlen($inviter_phone) < 11){
                Log::channel('fixphone')->info('会员'.$user->id.'推荐电话变后:'.$inviter_phone);
                $inviter_phone = str_pad($inviter_phone,11,'0',STR_PAD_RIGHT);
                Log::channel('fixphone')->info('会员'.$user->id.'推荐电话变更后:'.$inviter_phone."\n");
            }
            $data = [
                'user_id'=>$user->id,
                'name'=>$user->name,
                'phone'=>$phone,
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
        Log::channel('inviterroot')->info("共处理用户:".$root."位");
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
    public function orderUser(){
        echo "<pre>";
        $rootUser = FinalTable::where('inviter_phone','13134431390')->get();
        //dd($rootUser);
        //dd($users->count());
        foreach ($rootUser as $user) {
            //dd($user);
                $user->depth = 1;
                $user->update();
                //dd($user);
                $tempName = $user->name??'';
                //echo "设置根用户".$tempName."(".$user->id.")深度为:1\n";
        }
        echo "<h1>完成设置根用户</h1><hr>";
        foreach ($rootUser as $user) {
            echo "开始设置".$user->name.'('.$user->user_id.")下级用户\n";
            //dump($user);
            $this->makeChildOrder($user,2);
        }
    }
    public function makeChildOrder($user,$depth=1){
        if($this->hasChildren($user)){
            foreach ($user->children as $child) {
                if ($child->inviter_phone == $child->phone) {
                    echo "用户".$child->name.'('.$child->id.")推荐人为自己,跳过\n";
                    continue;
                }
                if ($child->depth != 9999) {
                    echo "用户$child->name(".$child->user_id.")已设置级别,当前深度:$depth,所属用户:$user->name(".$user->user_id.")\n";
                    dd($child);
                }
                echo "更改".$user->name.":".$user->user_id."排序为:".$depth."\n";
                $child->depth = $depth;
                $child->save();
                //dump($child);
                if($this->hasChildren($child)){
                    echo "\t有下级\n";
                    //dd($child->children);
                    $this->makeChildOrder($child,$depth+1);
                }
            }
        }
    }
    public function hasChildren($user){
            if (count($user->children) > 0){
                //dd($user->children);
                return true;
            }else{
                return false;
            }

    }


    public function test(){
        $user = FinalTable::where('phone','13159757519')->first();
        //$user = FinalTable::where('phone','19000132080')->first();
        //dd(count($user->children));
        //if(count($user->children) > 0){
        //    echo "有下级";
        //}else {
        //    echo "无下级";
        //}
        $this->makeChildOrder($user);
    }
}
