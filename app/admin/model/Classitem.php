<?php

namespace app\admin\model;

use think\Model;

/**
 * @mixin think\Model
 */

use app\admin\validate\Classitem as ClassitemValidate;

class Classitem extends Model
{
    //获取列表数据
    public static function getList($classid)
    {
        $list = self::where('classid', '=', $classid)->select();
        return $list;
    }

    //数据的添加
    public static function store($data)
    {
        $result = self::checkDatas($data);
        if ($result !== true) {
            return $result;
        }
        //数据入库
        $result = self::create([
            'classid' => $data['classid'],
            'name' => $data['name'],
            'value' => $data['value'],
            'nvalue' => $data['nvalue'],
            'zhangfu' => $data['zhangfu'],
            'nzhangfu' => $data['nzhangfu'],
            'sort' => $data['sort'],
            'formtype' => $data['formtype']
        ]);
        //返回结果
        return return_data($result, "添加");
    }

    //数据更新
    public static function _update($id, $data)
    {
        if (!is_numeric($id) || !is_integer(intval($id)) || intval($id) <= 0) {
            return return_msg(0, "参数错误");
        }
        //数据验证
        $data['id'] = $id;
        $result = self::checkDatas($data, "update");
        if ($result !== true) {
            return $result;
        }
        //数据入库
        $result = self::update([
            'name' => $data['name'],
            'value' => $data['value'],
            'nvalue' => $data['nvalue'],
            'zhangfu' => $data['zhangfu'],
            'nzhangfu' => $data['nzhangfu'],
            'sort' => $data['sort'],
        ], ['id' => $id]);
        //返回结果
        return return_data($result !== false, "更新");
    }

    //删除
    public static function _del($id)
    {
        if (intval($id) <= 0) {
            return return_msg(0, "参数错误");
        }
        return return_data(self::destroy($id), "删除");
    }

    //数据验证
    private static function checkDatas($data, $scene = "add")
    {
        //数据验证
        try {
            $result = validate(ClassitemValidate::class)->scene($scene)->check($data);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            return return_msg(0, $e->getError());
        }
        return true;
    }
}
