<?php
declare (strict_types=1);

namespace app\api\controller\v1;

use app\api\model\User;
use app\api\validate\SmsCheck;
use app\api\validate\Userunique;
use app\exception\HttpExceptions;
use think\Request;
use \app\api\validate\User as UserValidate;

class Users extends Common
{
    /**
     * 用户注册接口
     * @param Request $request
     * @return \think\response\Json
     */
    public function create(Request $request)
    {
        (new UserValidate())->runCheck();
        (new Userunique())->runCheck();
        (new SmsCheck())->runCheck();
        if (User::store($request->param())) {
            return $this->return_msg("success", [], 0, 201);
        } else {
            throw new HttpExceptions(400, "注册失败", 19999);
        }

    }

    /**
     * 用户密码找回
     * @param Request $request
     * @return \think\response\Json
     */
    public function findpassword(Request $request)
    {
        //1.数据验证
        (new UserValidate())->runCheck();
        (new SmsCheck())->runCheck();
        //2.更新入库
        if (User::updatepassword($request->param())) {
            return $this->return_msg("success", [], 0, 200);
        } else {
            throw new HttpExceptions(400, "密码修改失败", 19999);
        }
    }

}
