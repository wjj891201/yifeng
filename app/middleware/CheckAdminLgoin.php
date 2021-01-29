<?php

namespace app\middleware;

use think\facade\Session;

class CheckAdminLgoin
{

    public function handle($request, \Closure $next)
    {
        //登录验证
        if (!Session::has('username') || !Session::has('userid'))
        {
            return redirect('/admin/login');
        }
        return $next($request);
    }

}
