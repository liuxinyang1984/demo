<?php
declare (strict_types = 1);

namespace app\controller;

use think\facade\Request as FR;
use think\Request;

class RelyController
{

    public $req;
    public function __construct(Request $req)
    {
        $this->req = $req;
    }
    public function facade(){
        return FR::param('name');
    }
    public function helper(){
        return request()->param('name');
    }
    public function has(){
        dd (FR::has('id','get'));
    }
    public function get(){
        dd (FR::param());
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $req)
    {
        //
        //$str = $req->param('name');
        $str = $this->req->param('name');
        echo $str;
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
