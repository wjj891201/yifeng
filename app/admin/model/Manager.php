<?php

namespace app\admin\model;

use think\Model;
use app\admin\validate\Manager as ManagerValidate;
use think\Exception\ValidateException;

/**
 * @mixin think\Model
 */
class Manager extends Model
{

    //处理密码修改数据
    public static function store($data)
    {
        //数据的基础验证
        try
        {
            $result = validate(ManagerValidate::class)->scene('edit')->check($data);
        } catch (ValidateException $e)
        {
            // 验证失败 输出错误信息
            return return_msg(0, $e->getError());
        }
        //判断旧密码
        $manager = self::find(session("adminid", "", 'admin'));
        if (!$manager)
        {
            return return_msg(0, "账号登录异常");
        }
        //验证旧密码
        if (password_verify($data['oldpass'], $manager['password']) !== true)
        {
            return return_msg(0, "旧密码输入不正确");
        }
        //新密码和确认密码
//        if($data['newpass']!==$data['repass']){
//            return ['code'=>0,'msg'=>"两次密码输入不一致"];
//        }
        //把新密码更新到数据库
        $manager->password = password_hash($data['newpass'], PASSWORD_DEFAULT);
        $result = $manager->save();
        if ($result)
        {
            return return_msg(1, "修改成功");
        }
        else
        {
            return return_msg(0, "修改失败");
        }
    }

    //管理登录验证
    public static function checkLogin($data)
    {
        //1. 验证验证数据
        try
        {
            $result = validate(ManagerValidate::class)->scene('login')->check($data);
        } catch (ValidateException $e)
        {
            // 验证失败 输出错误信息
            return return_msg(0, $e->getError());
        }
        //2.验证密码和用户名
        $m = self::where('username', $data['username'])->find();
        if (!$m)
        {
            return return_msg(0, "用户名不存在");
        }
        //验证密码是否正确
//        if(password_verify($data['password'],$m['password'])){
//            //记录管理员信息
//            session('username',$data['username'],'admin');
//            session('userid',$m['id'],'admin');
//            return return_msg(1,"登录成功");
//        }
//        return return_msg(0,"密码输入错误");
        if (password_verify($data['password'], $m['password']) !== true)
        {
            return return_msg(0, "密码输入错误");
        }
        session('username', $data['username']);
        session('userid', $m['id']);
        return return_msg(1, "登录成功");
    }

}
