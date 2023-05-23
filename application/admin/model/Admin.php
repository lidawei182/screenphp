<?php

namespace app\admin\model;

use \think\Model;
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
        $where = " a.id = " . $uid;
        $user = Db::table('t_admin')
        ->alias('a')
        ->field('a.*,c.jdName')
        ->join(['customer' => 'b'], 'a.UnitNo = b.UnitNo', 'left')
        ->join('t_tree c', 'b.jdParent = c.jdno', 'left')
        ->where($where)
        ->find();
        return $user;
    }

    /** 通过用户名获取用户信息
     * @param $userName 用户名
     */ 
    public function getAdminByName($userName)
    {
        $where = ['userName' => $userName];
        $user  = Db::name('admin')->where($where)->find();

        // $user  = Db::name('admin')->alias('a')->field('a.*,b.jdName')->join('auth_group b', 'a.groupId = b.id', 'left')->where($where)->find();
        return $user;
    }

    /**
     * 获取管理员列表
     */
    public function getLists($userName, $phone, $realName, $startTime, $endTime, $isEnabled, $myorder, $page, $psize,$UnitNo,$jdName)
    {
        $where = true;
        if ($userName) {
            $where .= " and a.userName like '%" . $userName . "%' ";
        }
        if ($UnitNo) {
            $where .= " and a.UnitNo = '" . $UnitNo . "' ";
        }
        if ($jdName) {
            $where .= " and c.jdName = '" . $jdName . "' ";
        }
        if ($phone) {
            $where .= " and  a.phone like '%" . $phone . "%' ";
        }
        if ($realName) {
            $where .= " and  a.realName like '%" . $realName . "%' ";
        }
        if ($startTime) {
            $where .= " and  a.loginTime >= " . $startTime . " ";
        }
        if ($endTime) {
            $where .= " and  a.loginTime <= " . $endTime . " ";
        }
        if ($isEnabled != -1) {
            $where .= " and a.isEnabled =  " . $isEnabled;
        }

        return Db::table('t_admin')
                ->alias('a')
                ->field('a.*,c.jdName')
                ->join(['customer' => 'b'], 'a.UnitNo = b.UnitNo', 'left')
                ->join('t_tree c', 'b.jdParent = c.jdno', 'left')
                ->where($where)
                ->order($myorder)
                ->page($page, $psize)
                ->select();
    }

    /** 查询管理员得数量
     * @param $keyword
     * @param $isEnabled
     */
    public function getTotal($userName, $phone, $realName, $startTime, $endTime, $isEnabled)
    {
        $where = true;
        if ($userName) {
            $where .= " and a.userName like '%" . $userName . "%' ";
        }
        if ($phone) {
            $where .= " and  a.phone like '%" . $phone . "%' ";
        }
        if ($realName) {
            $where .= " and  a.realName like '%" . $realName . "%' ";
        }
        if ($startTime) {
            $where .= " and  a.loginTime >= " . $startTime . " ";
        }
        if ($endTime) {
            $where .= " and  a.loginTime <= " . $endTime . " ";
        }
        if ($isEnabled != -1) {
            $where .= " and a.isEnabled =  " . $isEnabled;
        }
        return Db::table('t_admin')
        ->alias('a')
        ->field('a.*,c.jdName')
        ->join(['customer' => 'b'], 'a.UnitNo = b.UnitNo', 'left')
        ->join('t_tree c', 'b.jdParent = c.jdno', 'left')
        ->where($where)
        ->count();
    }

    /** 更新
     * @param array $uid
     * @param array $data
     * @return $this|void
     */
    public function modify($uid, $data)
    {
        return Db::name('admin')->where(['id' => $uid])->update($data);
    }

    /**新增
     * @param $data
     */
    public function addLogin($data) 
    {
        // 1,2,3,4,5,6,7,8,9,11

        $admin = Db::name('admin')->where(['UnitNo'=>$data['UnitNo'],'userName'=>$data['userName']])->find();

       if ($admin) {
            my_exception('序列码绑定');
        }

        $customer = Db::table('customer')->where(['UnitNo'=>$data['UnitNo']])->find();

        if(!$customer){
            my_exception('序列码不存在');
        }

        $adminUnitNo = Db::name('admin')->where(['UnitNo'=>$data['UnitNo']])->find();

        if($adminUnitNo){
            my_exception('序列码绑定');
        }

        $group = [
            'rules'     => '1,2,3,4,5,6,7,8,9,11',
            'status'    => 1,
        ];

        //开启事物
        Db::startTrans();

        $true = Db::name('tree')->where(['jdno' => $customer['jdParent']])->update($group);

        if(!$true){
            my_exception('用户已存在');
            // 回滚事务
            Db::rollback();
            return false;
        }

        $retAdmin = Db::name('admin')->insertGetId($data);

        if($retAdmin){
            // 提交事务
            Db::commit();
            return $retAdmin;
        }else{
            // 回滚事务
            Db::rollback();
            return false;
        }
        
    }

    /**新增
     * @param $data
     */
    public function add($data) 
    {
        return Db::name('admin')->insertGetId($data);
    }

    /** 删除图片
     * @param $uid
     * @return int
     */
    public function delfile($UnitNo)
    {

        $adminUnitNoDelfile = Db::name('admin')->where(['UnitNo'=>$UnitNo])->find();

        if($adminUnitNoDelfile){

            if($adminUnitNoDelfile['img'] != '' || $adminUnitNoDelfile['img'] != null){

                return Db::name('admin')->where(['UnitNo'=>$UnitNo])->update(['img' => '']);

            }else{

                return true;

            }

        }else{

            return true;

        }
    }

    /** 删除
     * @param $uid
     * @return int
     */
    public function del($uid)
    {
        return Db::name('admin')->where('id', $uid)->delete();
    }

    /** 批量删除
     * @param $uids
     * @return int
     */
    public function delall($uids)
    {
        return Db::name('admin')->where('id', 'in',$uids)->delete();
    }

    /**
     * [checkAdmin 检测用户名是否存在]
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function checkAdmin($name)
    {
        $id = Db::name('admin')->where('userName', $name)->value('id');
        if (empty($id)) {
            return 0;
        } else {
            return $id;
        }
    }

    /**获取密码
     * @param $uid
     */
    public function getPwd($uid)
    {
        return Db::name('admin')->where('id', $uid)->value('password');
    }

    /**设置密码
     * @param $uid
     */
    public function setPwd($uid, $newPwd)
    {
        return Db::name('admin')->where('id', $uid)->setField('password', $newPwd);
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

    /**
     * @param $id id 值
     * @param $lng
     * @param $lat
     * @param $zoom 
     */
    public function mapPositioning($id,$lng,$lat,$zoom)
    {
        return Db::name('admin')
               ->where('id', $id)
               ->update(['lng' => $lng,'lat' => $lat ,'zoom' => $zoom]);
    }

    /**
     * 根据id获取定位信息
     * @param $id id 值
     */
    public function getMapPositioning($id)
    {
        return Db::name('admin') ->where('id', $id) ->find();
    }

    /**
     * 根据id清空定位信息
     * @param $id id 值
     */
    public function updateMapPg($id)
    {
        return Db::name('admin')->where('id', $id)->update(['lng'=>'','lat'=>'','zoom'=>8]);
    }


}
