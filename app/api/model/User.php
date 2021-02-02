<?php

namespace app\api\model;

use app\exception\HttpExceptions;
use think\Model;

class User extends Model
{
    protected $name = 'users';

    //用户注册
    public static function store($data)
    {
        $user = new self();
        $user->username = $data['username'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($user->save() === true) {
            return true;
        } else {
            return false;
        }
    }

    //密码修改
    public static function updatepassword($data)
    {
        $datas = [
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ];
        $user = self::where(['username' => $data['username']])->find();
        if ($user) {
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $user->save();
            return true;
        } else {
            throw new HttpExceptions(400, "账号不存在", 10000);
        }
    }

    //用户登录
    public static function checkLogin($data)
    {
        //1.查询用户信息，根据用户名查询
        $user = self::where('username', '=', $data['username'])->field(['id,username,password,status'])->find();
        if (!$user) {
            throw new HttpExceptions(403, "账号不存在", 10000);
        }
        //验证密码是否正确
        if (!password_verify($data['password'], $user['password'])) {
            throw new HttpExceptions(403, "密码不正确", 10001);

        }
        //验证用户状态
        if ($user['status']) {
            throw new HttpExceptions(403, "账号异常", 10001);
        }
        return true;
    }
}