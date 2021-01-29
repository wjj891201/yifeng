<?php

namespace app\admin\model;

use app\admin\validate\Classs as ClasssValidate;
use think\exception\ValidateException;
use think\Model;

/**
 * @mixin think\Model
 */
class Classs extends Model
{

    //关联模型
    public function classitem()
    {
        return $this->hasMany(Classitem::class, 'classid', 'id');
    }

    //获取分页列表数据
    public static function getList($num = 10)
    {
        $list = self::paginate($num);
        return $list;
    }

    //数据的添加
    public static function store($data)
    {
        $result = self::checkDatas($data);
        if ($result !== true)
        {
            return $result;
        }
        //数据入库
        $result = self::create([
                    'name' => $data['name'],
                    'label' => $data['label'],
                    'sort' => $data['sort']
        ]);
        //返回结果
//        if($result){
//            return return_msg(1,"添加成功");
//        }
//        return return_msg(0,"添加失败");
        return return_data($result, "添加");
    }

    //数据更新
    public static function _update($id, $data)
    {
        if (!is_numeric($id) || !is_integer(intval($id)) || intval($id) <= 0)
        {
            return return_msg(0, "参数错误");
        }
        //数据验证
        $data['id'] = $id;
        $result = self::checkDatas($data);
        if ($result !== true)
        {
            return $result;
        }
        //数据入库
        $result = self::update([
                    'name' => $data['name'],
                    'label' => $data['label'],
                    'sort' => $data['sort']
                        ], ['id' => $id]);
        //返回结果
//        if($result!==false){
//            return return_msg(1,"更新成功");
//        }
//        return return_msg(0,"更新失败");
        return return_data($result !== false, "更新");
    }

    //删除
    public static function _del($id)
    {
        if (intval($id) <= 0)
        {
            return return_msg(0, "参数错误");
        }
//        if(self::destroy($id)){
//            return return_msg(1,"删除成功");
//        }
//        return return_msg(0,"删除失败");
        return return_data(self::destroy($id), "删除");
    }

    //数据验证
    private static function checkDatas($data)
    {
        //数据验证
        try
        {
            $result = validate(ClasssValidate::class)->check($data);
        } catch (ValidateException $e)
        {
            // 验证失败 输出错误信息
            return return_msg(0, $e->getError());
        }
        return true;
    }

}
