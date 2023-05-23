<?php

namespace app\admin\logic;

use \think\Model;
use app\common\CommonConstant;
use app\common\util\JwtUtil;
use \think\Db;

/**
 * 管理员相关操作
 */
class Admin extends Model
{

    /** 通过ID获取用户信息
     * @param $uid 用户id
     */
    public function getAdminById($uid)
    {
        return my_model('Admin', 'model', 'admin')->getAdminById($uid);
    }

    /**
     * 登录。
     * 此时客户端的用户认证方式是JWT
     * @param string $userName 登录主名称：用户名
     * @param string $password 未加密的密码
     * @return array 对象数组，包含字段：userToken，已编码的用户访问令牌；user，用户信息。
     * @throws Exception my_error抛出
     */
    public function login($userName, $password)
    {
        // 查找身份，验证身份
        $user = my_model('Admin', 'model', 'admin')->getAdminByName($userName);
        if (empty($user)) {
            my_exception('', CommonConstant::e_user_miss);
        }
        //密码验证
        if ($user['password'] !== encrypt_pass($password)) {
            my_exception('', CommonConstant::e_user_pass_wrong);
        }
        // 检测用户状态
        if ($user ['isEnabled'] != CommonConstant::db_true) {
            my_exception('', CommonConstant::e_user_disabled);
        }
        //权限检测
        // $group = model('AuthGroup')->getGroupById($user['groupId']);
        // if (empty($group) || $group['status'] != 1) {
        //     my_exception('用户组不存在或被禁用！', CommonConstant::e_user_role_disabled);
        // }
        // 数据处理和令牌获取
        $time = time();
        // 令牌生成
        $payload['uid']       = $user['id'];
        $payload['loginTime'] = $time;
        $userToken            = think_encrypt(JwtUtil::encode($payload));
        // 返回
        return array('userToken' => $userToken);
    }

    /**
     * 刷新token
     * 此时客户端的用户认证方式是JWT
     * @param string $userid 登录主名称：用户id
     * @return array 对象数组，包含字段：userToken，已编码的用户访问令牌；user，用户信息。
     * @throws Exception my_error抛出
     */
    public function refeshTpken($userid)
    {
        // 查找身份，验证身份
        $user = my_model('Admin', 'model', 'admin')->getAdminById($userid);
        if (empty($user)) {
            my_exception('', CommonConstant::e_user_miss);
        }
        //权限检测
        $group = model('AuthGroup')->getGroupById($user['groupId']);
        if (empty($group) || $group['status'] != 1) {
            my_exception('用户组不存在或被禁用！', CommonConstant::e_user_role_disabled);
        }
        // 数据处理和令牌获取
        $time = time();
        // 令牌生成
        $payload['uid']       = $user['id'];
        $payload['loginTime'] = $time;
        $userToken            = think_encrypt(JwtUtil::encode($payload));
        // 返回
        return array('userToken' => $userToken);
    }

    /**获取管理员列表
     * @param string $userName
     * @param string $phone
     * @param string $realName
     * @param string $startTime
     * @param string $endTime
     * @param int $isEnabled
     * @param string $myorder
     * @param int $page
     * @param int $psize
     * @return mixed
     */
    public function getLists($userName = '', $phone = '', $realName = '', $startTime = '', $endTime = '', $isEnabled = -1, $myorder = 'a.id desc', $page = 1, $psize = 10, $UnitNo='', $jdName='')
    {
        return my_model('Admin', 'model', 'admin')
            ->getLists(
                $userName, 
                $phone, 
                $realName, 
                $startTime, 
                $endTime, 
                $isEnabled, 
                $myorder, 
                $page, 
                $psize,
                $UnitNo,
                $jdName
            );
    }

    /**获取管理员数量
     * @param string $userName
     * @param string $phone
     * @param string $realName
     * @param string $startTime
     * @param string $endTime
     * @param int $isEnabled
     * @return mixed
     */
    public function getTotal($userName = '', $phone = '', $realName = '', $startTime = '', $endTime = '', $isEnabled = -1, $UnitNo='',$jdName='')
    {
        return my_model('Admin', 'model', 'admin')
            ->getTotal(
                $userName, 
                $phone, 
                $realName, 
                $startTime, 
                $endTime, 
                $isEnabled,
                $UnitNo,
                $jdName
            );
    }

    /** 保存
     * @param $uid
     * @param $data
     */
    public function modifyLogin($data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['pd'] = $data['password'];
            $data['password'] = encrypt_pass($data['password']);
        }

        $data['regIp'] = request()->ip();

        if (isset($data['userName']) && my_model('Admin', 'model', 'admin')->checkAdmin($data['userName'])) {
            my_exception('该账号已存在');
        }

        return my_model('Admin', 'model', 'admin')->addLogin($data);

    }    

    /** 删除图片
     * @param $UnitNo
     */
    public function delfile($UnitNo)
    {
        $res = my_model('Admin', 'model', 'admin')->delfile($UnitNo);
        if ($res) {
            return $UnitNo;
        } else {
            return false;
        } 
    }

    /** 保存
     * @param $uid
     * @param $data
     */
    public function modify($uid, $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['pd'] = $data['password'];
            $data['password'] = encrypt_pass($data['password']);
        }
        if ($uid) {
            $data['updateTime'] = time();
            unset($data['regTime']);
            if (isset($data['userName']) && my_model('Admin', 'model', 'admin')->checkAdmin($data['userName']) && $uid != my_model('Admin', 'model', 'admin')->checkAdmin($data['userName'])) {
                my_exception('该账号已存在');
            }
            $res = my_model('Admin', 'model', 'admin')->modify($uid, $data);
            if ($res) {
                return $uid;
            } else {
                return false;
            } 

        } else {
            $data['regIp'] = request()->ip();
            if (isset($data['userName']) && my_model('Admin', 'model', 'admin')->checkAdmin($data['userName'])) {
                my_exception('该账号已存在');
            }
            return my_model('Admin', 'model', 'admin')->add($data);
        }
    }

    /** 删除
     * @param $uid
     * @return int
     */
    public function del($uid)
    {
        return my_model('Admin', 'model', 'admin')->del($uid);
    }

    /** 批量删除
     * @param $uids
     * @return int
     */
    public function delall($uids)
    {
        return my_model('Admin', 'model', 'admin')->delall($uids);
    }

    /**修改密码
     * @param $uid
     * @param $newPwd
     */
    public function setPwd($uid, $newPwd, $oldPwd)
    {
        $password = my_model('Admin', 'model', 'admin')->getPwd($uid);
        if ($password !== encrypt_pass($oldPwd)) {
            my_exception('原始密码错误');
        }
        return my_model('Admin', 'model', 'admin')->setPwd($uid, $newPwd);
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
        return my_model('Admin', 'model', 'admin')->change($table, $id, $val, $field, $value);
    }


}
