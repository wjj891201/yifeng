<?php

declare (strict_types = 1);

namespace app\admin\controller;

class Index
{

    public function index()
    {
        //加载后台主页模板
        return view();
    }

    //后台欢迎页面
    public function welcome()
    {
        return view();
    }

}
