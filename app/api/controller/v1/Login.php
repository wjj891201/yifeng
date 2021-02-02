<?php

namespace app\api\controller\v1;

use app\api\libs\Jwtauth;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

use app\api\libs\Auth;
use app\api\model\User;
use app\Request;
use \app\api\validate\Login as LoginValidate;

class Login extends Common
{
    public function login(Request $request)
    {
        //1. 数据验证
        (new LoginValidate())->runCheck();
        //2.登录验证,到数据库中查询用户信息
        $data = $request->post();
        (new User())->checkLogin($data);
        //3.保持登录状态，令牌：
        $token = Auth::getInstance()->setToken()->getToken();
        // $token = Jwtauth::getInstance()->setToken()->getToken()->__toString();
        //4.响应
        $datas = [
            'username' => $data['username'],
            'token' => $token
        ];
        return $this->return_msg('ok', $datas, 0, 200);
    }

    //登录授权测试
    public function test(Request $request)
    {
        //生成一个JWT TOKEN
        return Jwtauth::getInstance()->setToken()->getToken();
        return "已登录";
    }

    //登录授权测试
    public function test1(Request $request)
    {
        return "授权成功";
    }
}
