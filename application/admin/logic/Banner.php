<?php

namespace app\admin\logic;

use \think\Model;
use app\common\CommonConstant;
use app\common\util\JwtUtil;

/**
 * 管理员相关操作
 */
class Banner extends Model
{

    /** 显示banner图
     * 没有参数
     */
    public function getbanner()
    {
        return my_model('Banner', 'model', 'admin')->getbanner();
    }

    /** 保存
     * @param $uid
     * @param $data
     */
    public function modify($uid, $data)
    {
        if ($uid) {
            $data['updateTime'] = time();
            unset($data['createtime']);
            $res = my_model('Banner', 'model', 'admin')->modify($uid, $data);
            if ($res) {
                return $uid;
            } else {
                return false;
            }

        } else {
            //添加多条图片，循环多次调用方法
            foreach ($data as $key=>$value)
            {
              $res = my_model('Banner', 'model', 'admin')->add($value);
            }

            if($res > 0){
               $res = $data;
            }
            return $res;
        }
    }

    /** 删除
     * @param $uid
     * @return int
     */
    public function del($uid)
    {
        return my_model('Banner', 'model', 'admin')->del($uid);
    }

    /** 批量删除
     * @param $uids
     * @return int
     */
    public function delall($uids)
    {
        return my_model('Banner', 'model', 'admin')->delall($uids);
    }

    /**
     * @param $val id 值
     * @param $field 修改字段
     * @param $value 字段值
     */
    public function change($val, $field, $value)
    {
        $table = 'admin';
        $id    = 'id';
        return my_model('Banner', 'model', 'admin')->change($table, $id, $val, $field, $value);
    }


}
