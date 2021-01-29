<?php

// 这是系统自动生成的admin应用公共文件
//生成返回数据
function return_msg($code = 1, $msg = "操作成功", $data = [])
{
    return ['code' => $code, 'msg' => $msg, 'data' => $data];
}

//统一返回数格式
function return_data($bool = false, $msg, $flag = true)
{
    if ($bool)
    {
        if ($flag)
        {
            $msg = $msg . "成功";
        }
        return return_msg(1, $msg);
    }
    if ($flag)
    {
        $msg = $msg . "失败";
    }
    return return_msg(0, $msg);
}
