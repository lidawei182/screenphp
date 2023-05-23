<?php

namespace app\admin\logic;

use \think\Model;

/**
 * 管理员登陸日志操作
 */
class User extends Model
{
    /**获取用户列表
     * @return mixed
     */
    public function getLists($id = '', $userName = '', $realName = '', $startTime = '', $endTime = '', $myorder = 'a.id desc', $page = 1, $psize = 10)
    {
        return my_model('User', 'model', 'admin')->getLists($id, $userName, $realName, $startTime, $endTime, $myorder, $page, $psize);
    }

    /**获取用户数量
     * @return mixed
     */
    public function getTotal($id = '', $userName = '', $realName = '', $startTime = '', $endTime = '')
    {
        return my_model('User', 'model', 'admin')->getTotal($id, $userName, $realName, $startTime, $endTime);
    }

    /** 添加
     * @param $id
     * @param $data
     */
    public function modify($id, $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = encrypt_pass($data['password']);
        }
        if ($id) {
            $data['updateTime'] = time();
            unset($data['regTime']);
            if (isset($data['userName']) && my_model('User', 'model', 'admin')->checkAdmin($data['userName']) && $id != my_model('User', 'model', 'admin')->checkAdmin($data['userName'])) {
                my_exception('该账号已存在');
            }
            $res = my_model('User', 'model', 'admin')->modify($id, $data);
            if ($res) {
                return $id;
            } else {
                return false;
            }

        } else {
            $data['regIp'] = request()->ip();
            if (isset($data['userName']) && my_model('User', 'model', 'admin')->checkAdmin($data['userName'])) {
                my_exception('该账号已存在');
            }
            return my_model('User', 'model', 'admin')->add($data);
        }
    }
    /** 删除
     * @param $id
     * @return int
     */
    public function del($id)
    {
        return my_model('User', 'model', 'admin')->del($id);
    }
    /** 通过ID获取用户信息
     * @param $id 用户id
     */
    public function getUserById($id)
    {
        return my_model('User', 'model', 'admin')->getUserById($id);
    }
    /**
     * @param $val id 值
     * @param $field 修改字段
     * @param $value 字段值
     */
    public function change($val, $field, $value)
    {
        $table = 'user';
        $id    = 'id';
        return my_model('User', 'model', 'admin')->change($table, $id, $val, $field, $value);
    }
}
