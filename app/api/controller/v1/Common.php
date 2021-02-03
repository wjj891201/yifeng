<?php

namespace app\api\controller\v1;


use app\api\libs\Checkdata;
use app\BaseController;
use app\Request;

class Common extends BaseController
{
    use Checkdata;
    //初始方法中进行参数过滤
    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        //获取参数
        // halt($this->request->has("timestamp"));
        //判断时间戳是否存在
        // var_dump($this->checkTime());exit;
        $this->checkTime();
        $this->checkSign();
    }


}
