<?php

namespace app\admin\validate;

use think\Validate;

class Classitem extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'classid'=>'require',
        'name'=>'require|unique:classs',
        'sort'=>'require|integer',
        'formtype'=>'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'classid.require'=>'配置类型不能为空',
        'name.require'=>'类型名称不能为空',
        'name.unique'=>'类型已存在',
        'sort.require'=>'排序不能为空',
        'sort.integer'=>'格式不正确',
        'formtype.require'=>"表单类型不能为空"
    ];

    protected $scene =[
        'add'=>["classid","name","sort","formtype"],
        'update'=>["name","sort"]
    ];
}
