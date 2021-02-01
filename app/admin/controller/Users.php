<?php
declare (strict_types=1);

namespace app\admin\controller;

use \app\admin\model\Users as UsersModel;
use think\facade\View;

class Users
{
    //加载会员列表
    public function index()
    {
        $list = (UsersModel::where('is_delete', '=', 0)->order('id', "Desc")->paginate(15));
        View::assign("list", $list);
        return view();
    }

    //用户删除
    public function delete($id)
    {
        $result = UsersModel::update(['is_delete' => 1], ['id' => $id]);
        if ($result) {
            return json(return_msg(1, "删除成功"));
        }
        return json(return_msg(0, "删除失败"));
    }

    //用户状态
    public function status($id)
    {
        $status = UsersModel::where("id", "=", $id)->value("status");
        $result = UsersModel::update(['status' => !$status], ['id' => $id]);
        if ($result) {
            return json(return_msg(1, "操作成功", ['status' => !$status]));
        }
        return json(return_msg(0, "操作失败"));
    }

    //用户级别
    public function level($id)
    {
        $status = UsersModel::where("id", "=", $id)->value("level");
        $result = UsersModel::update(['level' => !$status], ['id' => $id]);
        if ($result) {
            return json(return_msg(1, "操作成功", ['status' => !$status]));
        }
        return json(return_msg(0, "操作失败"));
    }
}
