<?php
declare (strict_types=1);

namespace app\api\controller\v2;

use app\api\model\User;
use think\Request;

class Users extends Common
{
    /**
     * 用户注册接口
     * @param Request $request
     * @return \think\response\Json
     */
    public function create(Request $request)
    {
        try {
            if (User::store($request->param())) {
                return $this->return_msg("success", [], 0, 201);
            } else {
                return $this->return_msg("注册失败", [], 19999, 400);
            }
        } catch (\Exception $e) {

            return $this->return_msg($e->getMessage(), [], 19999, 500);
        }

    }


}
