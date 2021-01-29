<?php

namespace app\admin\validate;

use think\Validate;

class Manager extends Validate
{

    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username' => 'require',
        'password' => 'require|min:6',
        'oldpass' => 'require|min:6',
        'newpass' => 'require|min:6|confirm:repass',
        'code|验证码' => 'require|captcha'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => "用户名不能为空",
        'password.require' => "密码不能为空",
        'password.min' => "密码不能少于6位",
        'oldpass.require' => "旧密码不能为空",
        'oldpass.min' => "旧密码不能少于6位",
        'newpass.require' => "新密码不能为空",
        'oldpass.min' => "旧密码不能为空",
        'oldpass.confirm' => "两次密码输入不一致",
    ];
    protected $scene = [
        'edit' => ['oldpass', 'newpass'],
        'login' => ['username', 'password'],
    ];

}
