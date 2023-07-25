<?php
namespace app\controller;

use app\BaseController;
use app\model\User;
use app\Request;
use think\facade\Db;

class TestController extends BaseController{
    public function index(){
        //return "index->".$this->request->action()."()<br>".'path:'.$this->app->getBasePath();

    }
    public function add(){
        $userData = [
            'username' => '测试添加用户',
            'email' => 'testuser@localhost',
            'password' => '123',
            'gender'   => '男',
            'price'    => 100,
            'details'  => '那叫一个帅',
            'uid'      => 10010,
            'list'     => [
                'nickname' => '这个那个',
                'level' => 70
            ]
        ];
        $res = User::json(['list'])->insert($userData);
        return $res;
    }
    public function output(){
        $user = new User();
        //$user->username = '不地狱咆哮';
        //$user->password = '123';
        //$user->gender   = '男';
        //$user->email    = 'dypx@163.com';
        //$user->price    = 100;
        //$user->details  = '那叫一个帅';
        //$user->uid      = 10010;           
        //$user->allowField(['username','password'])->save(); 

        //$data=[
            //[
                //'username' => 'MINI地狱咆哮1',
                //'password' => '123',
                //'gender'   => '男',
                //'email'    => 'dypx@163.com',
                //'price'    => 100,
                //'details'  => '那叫一个帅',
                //'uid'      => 10010,
            //],
            //[
                //'username' => 'MINI地狱咆哮2',
                //'password' => '123',
                //'gender'   => '男',
                //'email'    => 'dypx@163.com',
                //'price'    => 100,
                //'details'  => '那叫一个帅',
                //'uid'      => 10010,
            //]
        //];
        //$user ->saveAll($data);
        $user  = User::create([
            'username' => 'MINI地狱咆哮3',
            'password' => '123',
            'gender'   => '男',
            'email'    => 'dypx@163.com',
            'price'    => 100,
            'details'  => '那叫一个帅',
            'uid'      => 10010,
        ],
        [
            'username',
            'password',
            'details'
        ],
        false);
        echo $user->id;
    }
    public function delete(){
        $user = User::find(308);
        $user->username = '洋嫂嫂';
        $user->email = 'mrscookie@localhost';
        $user->save();
        
        //$user->delete();
    }
    public function update(){
        //$user = User::where('username','like','%地狱咆哮%')->select();
        //dump($user);diec
        //$user->username = '哪个地狱咆哮';
        //$user->save();
        //$user = new User();
        //$dataList = [
         //['id'=>315,'username'=>'兽人1号'],
         //['id'=>316,'username'=>'兽人2号'],
         //['id'=>317,'username'=>'兽人3号'],
         //['id'=>318,'username'=>'兽人4号'],
         //['id'=>319,'username'=>'兽人5号'],
        //];
    //$user->allowField(['username','email'])->saveAll($dataList);
        //User::update([
            //'id' => 314,
            //'username' => '那我就叫update'
        //]);
        //User::update(
            //[
                //'username' => '那我就叫update',
                //'email' => 'update@localhost'
            //],
            //[
                //'id' => 314,
            //]
        //);
        return User::update([
            'username' => '改成什么好呢?',
            'price' => 1233,
        ],
        ['id' => 320],['username']
        );
    }
    public function find(){
        //$user = User::where('username','兽人1号')->find();
        //return json($user);
        //$user = User::findOrEmpty(444);
        //if($user->isEmpty()){
            //echo "空的";
        //}
        //$user = User::select([315,316,317]);
        //$user = User::where('id',315)->value('username');
        //$user  = User::whereIn('id',[317,318,319])->column('email','username');
        //return json($user);
        //$userData = [];
        //User::chunk(5,function($users){
         //foreach($users as $user){
             //echo $user->username."<br>";
             //$userData[]=$user;
         //}
         //echo '<hr>';
        //});
        //dump($userData);
        //$cursor = User::cursor();
        //foreach ($cursor as $user){
            //echo $user->username."<br>";
        //}
        $user = User::find(303);
        return json($user->getData());
    }
    public function field(){
        User::select();
    }
    public function fieldAttr(){
        //$userList = User::select();
        //foreach ($userList as $user){
            //echo $user->username.':'.$user->lev.":status:".$user->status."status原始数据:".$user->getData('status')."<br>";
        //}
        $userList = User::select()->WithAttr('status',function($val){
            $arr = [-1 =>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
            if(isset($arr[$val])){
                return $arr[$val];
            }else{
                return '错误的状态值';
            }
        });
        foreach($userList as $user){
            echo $user->username.'=>'.$user->status.'<br>';
        }
    }
    public function scope(){
        //$res = User::male()->select()->toArray();
        //dump($res);
        //$res = User::email('xiao')->select();
        //return json($res);
        $res = User::price(50)->email('xiao')->select();
        return json($res);
    }
    public function search(){

    }
    public function collection(){
        $res = User::select();
        $res->hidden(['password','details','start_time','end_time','create_time','update_time'])->append(['lev']);
        return (json($res));
    }
    public function json(){
        //$user = User::json(['list'])->where('id',303)->value('list'); 
        //dump($user);
        //$data['list'] = [
            //'nickname' =>'兽人萨尔',
            //'level' => 32
        //];
        //return User::json(['list'])->where('id',302)->update($data);
        //$data['list->nickname'] = "人类阿尔萨斯";
        //return User::json(['list'])->where('id',302)->update($data);
        $user = User::where('list->nickname','这个那个')->find();
        echo Db::getLastSql();
        dump ($user);
    }
    public function softDelete(){
        //$res = User::destroy(302);
        //echo Db::getLastSql();
        //return $res;
        //$res = User::find(301)->delete();
        //echo Db::getLastSql();
        //echo "<hr>";
        //return $res;
        //$user = User::onlyTrashed()->find(301);
        //$user->restore();
        //User::destroy(301,true);
         $user = User::onlyTrashed()->find(302);
         $user->force()->delete();
    }





















    public function testApi(Request $request){
        $data = $request->post();
        if($request->isPost()){
            if($data['mothod'] == 'w'){
                $res = [
                    'code' => 1,
                    'message' => '接收成功',
                    'time' => date('c',time()),
                ];
                echo json_encode($res);


                sleep(10);
                //返回后修改个用户
                $time = date('H-i-s',time());
                User::find(317)->save(['username'=>$time]);
            }else{
                $res = [
                    'code' => 0,
                    'message' => '参数错误'
                ];
                echo json_encode($res);
            }
        }
        
    }













}
