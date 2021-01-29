<?php

namespace app\admin\controller;

use think\facade\View;
use think\Request;
use \app\admin\model\Classs as ClasssModel;

class Classs
{

    /**
     * 显示资源列表
     * 显示列表
     * @return \think\Response
     */
    public function index()
    {
        //读取数据
        $list = ClasssModel::getList(10);
        //分配到模板
        View::assign('list', $list);
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->post();
        return json(ClasssModel::store($data));
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
        $classs = ClasssModel::find($id);
        View::assign('classs', $classs);
        return view();
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
        $data = $request->post();
        return json(ClasssModel::_update($id, $data));
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        return json(ClasssModel::_del($id));
    }

}
