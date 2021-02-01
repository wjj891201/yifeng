<?php

namespace app\admin\controller;

use think\Request;
use think\facade\View;
use \app\admin\model\Classitem as ClassitemModel;

class Classitem
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($classid)
    {
        //读取数据
        $list = ClassitemModel::getList($classid);
        //分配到模板
        View::assign('list', $list);
        View::assign('classid', $classid);
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create($classid)
    {
        View::assign('classid', $classid);
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->post();
        return json(ClassitemModel::store($data));
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //获取编辑的内容
        $classitem = (new ClassitemModel())->find($id);
        View::assign("classitem", $classitem);
        return view();
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->post();
        return json(ClassitemModel::_update($id, $data));
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        return json(ClassitemModel::_del($id));
    }
}
