<?php

namespace app\admin\model;

use \think\Model;
use \think\Db;

/**
 * 管理员相关操作
 */
class Banner extends Model
{
    /** banner
     * @没有参数
     */
    public function getbanner()
    {
        return Db::name('banner')->select();
    }

    /**新增
     * @param $data
     */
    public function add($data)
    {
        return Db::name('banner')->insertGetId($data);
    }

    /** 删除
     * @param $uid
     * @return int
     */
    public function del($uid)
    {
        return Db::name('banner')->where('id', $uid)->delete();
    }

    /** 批量删除
     * @param $uids
     * @return int
     */
    public function delall($uids)
    {
        return Db::name('banner')->where('id', 'in',$uids)->delete();
    }
    /**
     * @param $val id 值
     * @param $field 修改字段
     * @param $value 字段值
     */
    public function change($table, $id, $val, $field, $value)
    {
        return Db::name($table)->where($id, $val)->update([$field => $value,'updateTime'=>time()]);
    }

}
