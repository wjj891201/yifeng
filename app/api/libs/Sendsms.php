<?php


namespace app\api\libs;

use think\facade\Cache;

/**
 * 短信业务处理
 * 1.生成验证码
 * 2.发送短信
 * 3.短信验证
 * Class Sendsms
 * @package app\api\libs
 */
class Sendsms
{
    private $phone = "";
    private $expire_time=300;
    public function __construct($phone)
    {
        $this->phone = $phone;
        $this->expire_time = config("Aliyun.expire_time");
    }

    /**
     * 发送短信
     * @return mixed
     */
    public function send()
    {
        //生成验证码
        $code = $this->createCode();
        //发送短信
        if ((new Aliyun())->sendSms($this->phone, $code)) {
            //短信发送成功之后，存储验证，并设置过期时间
            Cache::set('sms_' . $this->phone, $code, $this->expire_time);
            return true;
        }
        // throw new HttpExceptions(403, "短信验证码异常", 19999);
    }

    /**
     * 生成验证码
     * @return int
     */
    private function createCode()
    {
        return rand(1000, 9999);
    }

    /**
     * 短信验证
     * @return bool
     */
    public function checkCode($code)
    {
        if ($code == Cache::get('sms_' . $this->phone)) {
            return true;
        }
        return false;
    }
}