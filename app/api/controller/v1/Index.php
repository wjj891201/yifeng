<?php
declare (strict_types=1);

namespace app\api\controller\v1;

use app\api\libs\Checkdata;
use app\api\libs\Sendsms;
use app\api\validate\Phone;


class Index extends Common
{
    use Checkdata;

    public function index()
    {
        return '您好！这是一个[api]示例应用-v1';
    }

    // 测试接口
    public function test()
    {
        return "测试接口-v1";
    }

    //短信接口
    public function getsmscode()
    {
        //数据验证
        (new Phone())->runCheck();
        //获取手机号
        $phone = $this->request->post("phone");
        // var_dump((new Sendsms($phone))->checkCode(9631));die;
        //发送短信
        $result = (new Sendsms($phone))->send();
        // var_dump($result);die;
        return $this->return_msg("OK", [], 0, 200);
    }
}
