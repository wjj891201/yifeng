<?php
declare (strict_types=1);

namespace app\api\controller\v2;

class Index
{
    public function index()
    {
        return '您好！这是一个[api]示例应用-v1';
    }

    // 测试接口
    public function test()
    {
        return "测试接口-v1";
    }
}
