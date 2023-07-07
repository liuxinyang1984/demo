<?php
namespace app\controller\group;

use app\BaseController;
use app\model\User;
use think\facade\Db;

class BlogController extends BaseController{
    public function index(){
        //$user = Db::table('tp_user')->where('id',19)->find();
        //return json($user);
        //return Db::getLastSql();
        //$user = Db::table('tp_user')->where('status',4)->selectOrFail();
        //$user = Db::table('tp_user')->select()->toArray();
        //$user = Db::name('user')->select()->toArray();
        //$user =  Db::name('user')->where('id',19)->value('username');
        //$user =  Db::name('user')->column('username','id');
        //return json($user);
        //Db::name('user')->chunk(3,function($users){
          //foreach($users as $user){
              //dump($user);
          //}
          //echo "单次读取结束<br>";
          //echo '====================================';
        //});

        //$cursor = Db::name('user')->cursor();
        //foreach($cursor as $user){
          //dump($user); 
          //echo "单次读取结束<br>";
          //echo '====================================';
        //}
        //$user = Db::name('user')->where('status',1)->order('id','DESC')->where('id',27)->select()->toArray();
        //dump($user);
        //$userQuery = Db::name('user');
        //$dataFind = $userQuery->where('id',27)->find();
        //$dateSelect = $userQuery->select();

        //dump($dataFind);
        //dump($dateSelect);
        //$data1 = $userQuery->order('id','DESC')->select();
        //$data2 = $userQuery->removeOption()->select();
        //return Db::getLastSql();
/*        $data = [*/
             /*'id' => 309,*/
             /*'username' => '洋叔',*/
             /*'password' => 'mrcookie',*/
             /*'gender' => '男',*/
             /*'email' => 'mrcookie@localhost',*/
             /*'price' => 50,*/
             /*'details' => '',*/
        /*];*/
        /*Db::name('user')->save($data);*/
        /*return Db::getLastSql();*/

        //$data = [
         //[
             //'username' => '洋嫂',
             //'password' => 'mrcookie',
             //'gender' => '女',
             //'email' => 'mrcookie@localhost',
             //'price' => 50,
             //'details' => '',
         //],
         //[
             //'username' => '洋姐',
             //'password' => 'mrcookie',
             //'gender' => '女',
             //'email' => 'mrcookie@localhost',
             //'price' => 50,
             //'details' => '',
         //]
        //];
        ////return Db::name('user')->insertAll($data);
        //Db::name('user')->replace()->insertAll($data);
        //return Db::getLastSql();
        //$data = [
            //'username' => '关云长'
        //];
        //return Db::name('user')->where('id',38)->update($data);


        //$data = [
            //'username' => '关云短',
            //'email' => 'guanyunduan@localhost'
        //];
        //return Db::name('user')->where('id',309)->exp('email','UPPER(email)')->update();
        //Db::name('user')->where('id',304)->inc('price')->dec('status',2)->update();
        //Db::name('user')
            //->update([
                //'email'     =>      Db::raw('UPPER(email)'),
                //'price'     =>      Db::raw('price +10'),
                //'status'    =>      Db::raw('status +2'),
                //'id'        =>      304,
        //]);
        //return Db::name('user')->delete([304,305,306]);
        Db::name('user')->where('id',303)->delete();
        return Db::getLastSql();
        //Db::name('user')->where('id',304)->save(['username' => '洋弟']);
        //return Db::name('user')->save(['username' => '洋弟','id' => 307]);

    }
    public function testData(){
        $user = Db::table('tp_user')->select();
        return json($user);
    }
    public function getUser(){
        $user = User::select();
        return json($user);
    }
    public function search(){
        $user =  Db::name('user')->whereBetweenTimeField('start_time','end_time')->select();
        dump($user); 
        echo Db::getLastSql();
    }
    public function count(){
        //return Db::name('user')->buildSql(true); 
/*        $sql = Db::name('two')->field('uid')->where('gender','男')->buildSql();*/
        /*$res = Db::name('one')->where('id','exp','IN'.$sql)->select();*/

        //$res = Db::name('user')->where([
            //'gender' => '男',
            //'price' => 100
        //])->select(); 
        $map[]=['gender','=','男'];
        $map[]=['price','in',[60,70,80]];
        $map[]=['status','>=',0];
        $res = Db::name('user')->field(['id','username'=>'name','email'])->select(); 
        dump ($res);
        return Db::getLastSql();
    }
}
