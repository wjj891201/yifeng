<?php
/**
 * * * * * * * * * * * * * * * * * * * * * *
 * 易风课堂系列课程                     　    *
 * * * * * * * * * * * * * * * * * * * * * *
 * password:yifeng                             *
 * * * * * * * * * * * * * * * * * * * * * *
 * www.yifengkt.cn                         *
 * * * * * * * * * * * * * * * * * * * * * *
 * QQ:576617109                            *
 * * * * * * * * * * * * * * * * * * * * * *
 */

namespace app\api\libs;

use app\exception\HttpExceptions;
use think\Exception;

trait Checkdata
{
    protected function checkTime()
    {
        if (!$this->request->has("timestamp") || intval($this->request->get("timestamp")) <= 1 || strlen($this->request->get("timestamp")) !== 10) {
            throw new HttpExceptions(400, "时间戳错误", 19997);
        }

        if (abs(time() - intval($this->request->get("timestamp"))) > 60) {
            throw new HttpExceptions(400, "请求超时", 19997);
        }
    }

    protected function checkSign()
    {

        if ($this->request->header("sign") == null) {
            throw new HttpExceptions(400, "签名参数错误", 19997);
        }
        //验证签名
        $sign = $this->createSign();
        if ($this->request->header("sign") != $sign) {
            throw new HttpExceptions(400, "签名错误", 19997);
        }
    }

    /**
     * 生成签名
     */
    protected function createSign()
    {
        //a=5&b=6
        $sign_data = $this->request->except(['ver']);
        ksort($sign_data);
        $sign_data_str = http_build_query($sign_data);
        return md5($sign_data_str);
    }

    //封装统一返回数据格式
    protected function return_msg($msg = "ok", $data = [], $errorcode = 0, $httpcode = 200)
    {
        $msg_data = [
            "message" => $msg,
            "data" => $data,
            "errorcode" => $errorcode
        ];
        return json($msg_data, $httpcode);
    }
}