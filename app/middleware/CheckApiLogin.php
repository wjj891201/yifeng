<?php

namespace app\middleware;

// use app\api\libs\Auth;

use app\api\libs\Auth;
use app\api\libs\Jwtauth;
use app\api\model\User;
use app\exception\HttpExceptions;

class CheckApiLogin
{
    public function handle($request, \Closure $next)
    {
        // 令牌验证
        // Jwtauth::getInstance()->checkLogin();
        Auth::getInstance()->checkLogin();
        // //判断用户的时实状态
        // $username = Jwtauth::getInstance()->getUsername();
        // $status = User::where("username",'=',$username)->value("status");
        // if($status){
        //     throw new HttpExceptions(403,"账号已冻结",199999);
        // }
        return $next($request);
    }
}
