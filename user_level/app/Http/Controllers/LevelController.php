<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\LevelLiu;
use App\Models\QimallUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Switch_;

class LevelController extends Controller
{
    protected $mall_id = 1;
    public function index(){
        $user = LevelLiu::where('phone',13878650916)->first();
        dump($user->toArray());
        $user = QimallUser::where('mall_id',$this->mall_id)->where('mobile',13878650916)->first();
        //$agent = $user->agent;
        //$agent->level = 88;
        //$agent->update;
        dump($user);
        dd($user->agent);
    }
    public function update(){
        echo "<pre>";
        $success = 0;
        $noUser = 0;
        $noAgent =0;
        $levelLiuList = LevelLiu::all();
        foreach($levelLiuList as $levelLiu){
            $user = QimallUser::where('mall_id',$this->mall_id)->where('mobile',$levelLiu->phone)->first();
            if($user){
                //dd($user->Agent->level);
                if($user->Agent){
                    $success ++;
                    Log::channel('success')->info('用户:'.$user->nickname.'('.$user->id.')修改团队级别为:'.$levelLiu->realLevel);
                    $agent = $user->Agent;
                    $agent->level = $levelLiu->realLevel;
                    $agent->update();
                    //echo "找到电话为".$levelLiu->phone."的用户:".$user->nickname."(".$user->id."),级别为:".$user->Agent->level."\n";
                }elseif($levelLiu->realLevel == 0){
                    $success ++;
                    Log::channel('success')->alert('用户:'.$user->nickname.'('.$user->id.')没有团队信息,但不需要修改级别');
                    //echo "找到电话为".$levelLiu->phone."的用户:".$user->nickname."(".$user->id."),但不存在团队级别\n";
                    //echo "用户不存在团队级别,但也不需要修改,跳过!\n";
                }else{
                    $agent = [
                        'user_id'=>$user->id,
                        'mall_id'=>$this->mall_id,
                        'level' => $levelLiu->realLevel
                    ];
                    if(Agent::create($agent)){
                        $success ++;
                        Log::channel('noagent')->info('用户'.$user->nickname.'('.$user->id.')没有团队等级,创建团队成功');
                    }else{
                        Log::channel('noagent')->error('用户'.$user->nickname.'('.$user->id.')没有团队等级,创建团队失败');
                        $noAgent ++;
                    }
                }
            }else{
                echo "未找到电话为:".$levelLiu->phone."的用户\n";
                Log::channel('nouser')->info('未找到电话为:'.$levelLiu->phone.'的用户');
                $noUser ++;
            }
        }
        echo "共有:".$success."名用户修改成功,".$noUser."名用户查找失败,".$noAgent."名用户没有团队等级,创建失败\n";
    }
}
