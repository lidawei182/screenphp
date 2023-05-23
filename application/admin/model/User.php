<?php

namespace app\admin\model;

use \think\Model;
use \think\Db;

/**
 * 管理员登陆日志
 */
class User extends Model
{
    /**
     * 获取管理员登陸日志列表
     */
    public function getLists($id, $userName, $realName, $startTime, $endTime, $myorder, $page, $psize)
    {
        $where = true;
        if ($id) {
            $where .= " and a.id = " . $id . " ";
        }
        if ($userName) {
            $where .= " and  a.userName like '%" . $userName . "%' ";
        }
        if ($realName) {
            $where .= " and  a.realName = '" . $realName . "' ";
        }
        if ($startTime) {
            $where .= " and  a.regTime >= " . $startTime . " ";
        }
        if ($endTime) {
            $where .= " and  a.regTime <= " . $endTime . " ";
        }
        return Db::name('user')->alias('a')->field('a.*')->where($where)->order($myorder)->page($page, $psize)->select();
    }

    /** 查询管理员登陸日志数量
     * @param $keyword
     * @param $isEnabled
     */
    public function getTotal($id, $userName, $realName, $startTime, $endTime)
    {
        $where = true;
        if ($id) {
            $where .= " and a.id = " . $id . " ";
        }
        if ($userName) {
            $where .= " and  a.userName like '%" . $userName . "%' ";
        }
        if ($realName) {
            $where .= " and  a.realName = '" . $realName . "' ";
        }
        if ($startTime) {
            $where .= " and  a.regTime >= " . $startTime . " ";
        }
        if ($endTime) {
            $where .= " and  a.regTime <= " . $endTime . " ";
        }
        return Db::name('user')->alias('a')->where($where)->count();
    }
    /** 通过ID获取用户信息
     * @param $id 用户id
     */
    public function getUserById($id)
    {
        $where = " a.id = " . $id;
        $user  = Db::name('user')->alias('a')->where($where)->find();
        return $user;
    }
    /** 更新
     * @param array $uid
     * @param array $data
     * @return $this|void
     */
    public function modify($id, $data)
    {
        return Db::name('user')->where(['id' => $id])->update($data);
    }

    /**新增
     * @param $data
     */
    public function add($data)
    {
        return Db::name('user')->insertGetId($data);
    }

    /** 删除
     * @param $uid
     * @return int
     */
    public function del($id)
    {
        return Db::name('user')->where('id', $id)->delete();
    }

    /** 批量删除
     * @param $uids
     * @return int
     */
    public function delall($ids)
    {
        return Db::name('user')->where('id', 'in',$ids)->delete();
    }

    /**
     * [checkAdmin 检测用户名是否存在]
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function checkAdmin($name)
    {
        $id = Db::name('user')->where('userName', $name)->value('id');
        if (empty($id)) {
            return 0;
        } else {
            return $id;
        }
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