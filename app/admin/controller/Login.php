<?php

namespace app\admin\controller;

use think\facade\Request;
use app\admin\model\Manager;
use think\facade\Session;

class Login
{

    //加载登录页面

    public function login()
    {
        return view();
    }

    //登录数据处理
    public function dologin(Request $request)
    {
        $data = $request::post();
        $result = Manager::checkLogin($data);
        return json($result);
    }

    //退出
    public function logout()
    {
        Session::clear();
        return redirect('/admin/login');
    }

}
