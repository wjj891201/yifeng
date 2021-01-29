<?php

declare (strict_types = 1);

namespace app\admin\controller;

//use think\Request;
use think\facade\Request;
use app\admin\model\Manager as ManagerModel;

class Manager
{

    //加载视图
    public function setpassword()
    {

        return view();
    }

    //密码修改
    public function dopassword(Request $request)
    {
//        session("adminuser", "admin", "admin");
//        session("adminid", "1", "admin");
        $data = $request::post();
        $result = ManagerModel::store($data);
        return json($result);
    }

}
