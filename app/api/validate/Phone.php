<?php

namespace app\api\validate;


class Phone extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'phone'=>'phone|require|mobile'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'phone.require'=>"手机号不能为空",
        'phone.mobile'=>"手机号不正确",
    ];

    protected function phone(){
        $this->errorcode = 10000;
        return true;
    }
}
