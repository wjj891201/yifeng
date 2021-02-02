<?php

namespace app\api\validate;


use app\api\libs\Sendsms;

class User extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username' => "username|require|mobile",
        'password' => "password|require|min:6|confirm:repassword",

    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => "用户名不能为空",
        'username.mobile' => "用户名必须是手机号",
        'password.require' => "密码不能为空",
        'password.min' => "密码长度不能小于6位",
        'password.confirm' => "两次密码输入不一致"
    ];


}
