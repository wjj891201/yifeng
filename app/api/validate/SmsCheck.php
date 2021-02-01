<?php

namespace app\api\validate;


class SmsCheck extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'code|验证码'=>"code|require|number|length:4|checkCode"
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'code.require'=>"验证码不能为空",
        'code.number'=>"验证码格式不正确",
        'code.length'=>"验证码长度不正确",
        'code.checkCode'=>"验证码不正确",
    ];
    protected function code($value, $rule, $data=[])
    {
        $this->errorcode = 10002;
        return true;
    }
}
