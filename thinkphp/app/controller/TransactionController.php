<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;

class TransactionController extends BaseController{
    public function index(){
        echo "TransactionController/index <br>";
     //Db::transaction(function(){ 
         //Db::name('user')->where('id',19)->save(['price'=>Db::raw('price -3')]);
         //Db::name('user1')->where('id',20)->save(['price'=>Db::raw('price +3')]);
     //});
        Db::startTrans();
        try{
         Db::name('user')->where('id',19)->save(['price'=>Db::raw('price -3')]);
         Db::name('user')->where('id',20)->save(['price'=>Db::raw('price +3')]);
         Db::commit();
        }catch(\Exception $e){
            echo "事务执行失败!";
            Db::rollback();
        }
    }
    public function list(){
        $user = Db::name('user')->field('price,username')->where('id',19)->whereOR('id',20)->select()->toArray();
        dump($user);
        return Db::getLastSql();
        Db::startTrans();
        try{
         Db::name('user')->where('id',19)->save(['price'=>Db::raw('price -3')]);
         Db::name('user')->where('id',20)->save(['price'=>Db::raw('price +3')]);
         Db::commit();
        }catch(\Exception $e){
            echo "事务执行失败!";
            Db::rollback();
        }
    }
    public function collection(){
        $user = Db::name('user')->select();
        $user->
    }
}
