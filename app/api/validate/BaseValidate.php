<?php

namespace app\api\validate;

use app\api\libs\Sendsms;
use app\exception\HttpExceptions;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public $errorcode = 19999;

    public function runCheck()
    {
        $request = Request::instance();
        if ($this->check($request->param()) == false) {
            throw new HttpExceptions(400, $this->getError(), $this->errorcode);
        }

    }

    // 验证手机验证码
    protected function checkCode($value, $rule, $data = [])
    {
        return (new Sendsms($data['username']))->checkCode($value);
    }

    //设置错误码
    protected function username($value, $rule, $data = [])
    {
        $this->errorcode = 100000;
        return true;
    }

    protected function password($value, $rule, $data = [])
    {
        $this->errorcode = 100001;
        return true;
    }
}
