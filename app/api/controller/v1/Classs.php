<?php
declare (strict_types=1);

namespace app\api\controller\v1;

use \app\admin\model\Classs as ClasssModel;
use app\api\libs\Auth;
use app\api\libs\Jwtauth;
use app\api\model\User;
use think\Request;

class Classs extends Common
{
    public function getClasss()
    {
        $type = input('type', null);
        $config = ClasssModel::select();
        if ($type === null) {
            $data = $this->formatData($config);
        } else {
            $data = $this->formatDataList($config);
        }
        // return json($data);
        return $this->return_msg('ok', $data, 0, 200);
    }

    /**
     * 获会员的级别
     * @return mixed
     */
    private function getlevel()
    {
        $token = Auth::getInstance()->getToken();
        $level = User::where('login_code', '=', $token)->value("level");
        return $level;
    }

    /**
     * 格式化数据
     * @param $config
     * @return array
     */
    private function formatData($config)
    {
        $data = [];
        $islevel = $this->getlevel();
        foreach ($config as $item) {
            $arr = [];
            // $arr[$item->label] =$item->classitem->hidden(["id","formtype","sort","classid","nvalue"]);
            foreach ($item->classitem as $rs) {
                $tmp = [];
                if ($item->label == "fumo") {
                    switch ($rs->name) {
                        case "哑膜":
                            $arr['ya'] = $islevel ? $rs->nvalue : $rs->value;
                            break;
                        case "亮膜":
                            $arr['liang'] = $islevel ? $rs->nvalue : $rs->value;
                            break;
                        case "不覆膜":
                            $arr['wu'] = $islevel ? $rs->nvalue : $rs->value;
                            break;
                    }
                } else {
                    $tmp['name'] = $rs->name;
                    $tmp['price'] = $islevel ? $rs->nvalue : $rs->value;;
                    if ($item->label == "yinshua") $tmp['zhangfu'] = $islevel ? $rs->nzhangfu : $rs->zhangfu;;
                    $arr[] = $tmp;
                }

            }
            $data[$item->label] = $arr;
        }
        return $data;
    }

    private function formatDataList($config)
    {
        $data = [];
        $islevel = $this->getlevel();
        foreach ($config as $item) {
            $tmp = [];
            foreach ($item->classitem as $rs) {
                if ($item->label == "yinshua") {
                    $price = $islevel ? $rs->nvalue . "/" . $rs->nzhangfu : $rs->value . "/" . $rs->zhangfu;
                } else {
                    $price = $islevel ? $rs->nvalue : $rs->value;
                }
                $tmp[] = [
                    'lx' => $rs->name,
                    'price' => $price
                ];
                $arr[] = $tmp;
            }
            $data[] = [
                'title' => $item->name,
                'list' => $tmp
            ];
        }
        return $data;
    }
}
