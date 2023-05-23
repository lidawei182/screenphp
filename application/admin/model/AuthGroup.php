<?php

namespace app\admin\model;

use \think\Model;
use \think\Db;

/**
 * 用户组相关操作
 */
class AuthGroup extends Model
{
    /** 通过ID获取分组信息
     * @param $groupId 用户组id
     */
    public function getGroupById($UnitNo)
    { 
        $where = ['UnitNo' => $UnitNo];
        return  Db::table('t_tree')
                ->alias('a')
                ->field('b.UnitNo,a.*')
                ->join(['customer' => 'b'], 'a.jdno = b.jdParent', 'left')
                ->where($where)->find();
    }

    /** 通过jdName
     * @param
     */
    public function getGroupList($jdName)
    {

        $where = ['jdName' => $jdName];
        $tree = Db::name('tree')->where($where)->find();
        if($tree["jdName"]){
            $array = $this->recursion($tree["jdName"]);
        }else{
            $array = [];
        }
        
        return $array;

    }
    public function recursion($jdName)
    {

        $ret = Db::name('tree')->where(['jdParent' => $jdName])->select();
        
        $data = [];

        if (empty($ret)) {
            return [];
        }
        
        foreach ($ret as $key => $value) {

            if($value['jdParent'] == 0){
                return [];
            }

            array_push($data, $value);

            $data = array_merge($data, $this->recursion($value['jdName']));

        }
   
        return $data;
    }

    /** 获取分组列表
     * @param $jdName
     * @param $status
     */
    public function getLists($jdParent, $jdName, $status, $myorder, $page, $psize)
    {

        $where = true;

        if ($jdName) {
            $where .= " and jdName like '%" . $jdName . "%' ";
        }
        if ($status != -1) {
            $where .= " and status = " . $status;
        }

        $array = $this->getListrecursion($jdParent,$where,$jdName);

        return $array;
        // return Db::name('auth_group')->where($where)->order($myorder)->page($page, $psize)->select();
    }
    public function getListrecursion($jdParent,$where,$jdName)
    {   

        $data = [];

        if (empty($jdName)) {}

        $ret = Db::name('auth_group')->where(['jdParent' => $jdParent])->select();
        
        if (empty($ret)) {
            return [];
        }

        foreach ($ret as $key => $value) {

            array_push($data, $value);

            $data = array_merge($data, $this->getListrecursion($value['jdName'],$where,$jdName));

        }
   
        return $data;
    }

    /**
     * 获取所有的列表,不分页
     */
    public function getListsAll($status, $myorder)
    {
        $where = true;
        if ($status != -1) {
            $where .= " and a.status =  " . $status;
        }
        return Db::name('auth_group')->alias('a')->field('a.*')->where($where)->order($myorder)->select();
    }

    /** 获取分组数量
     * @param $title
     * @param $status
     */
    public function getTotal($title, $status)
    {
        $where = true;
        if ($title) {
            $where .= " and title like '%" . $title . "%' ";
        }
        if ($status != -1) {
            $where .= " and status = " . $status;
        }
        return Db::name('auth_group')->where($where)->count();
    }

    /** 更新
     * @param array $id
     * @param array $data
     * @return $this|void
     */
    public function modify($id, $data)
    {
        $id = intval($id);
        $authGroup = Db::name('auth_group')->where('id', $id)->find();
        $ids = $this->recursionModify($authGroup['jdName']);
        //开启事物
        Db::startTrans();
        $ret = Db::name('auth_group')->where(['id' => $id])->update($data);
        if($ret){
            $r = Db::name('auth_group')->where('id', 'in',$ids)->update(['jdParent' => $data['jdName']]);
            if($r){
                // 提交事务
                Db::commit();
            }else{
                // 回滚事务
                Db::rollback();
            }
        }else{
            // 回滚事务
            Db::rollback();
        }
        return $ret;
    }
    public function recursionModify($jdName){
        $data = [];
        $ret = Db::name('auth_group')->where(['jdParent' => $jdName])->select();
        if (empty($ret)) {
            return [];
        }
        foreach ($ret as $key => $value) {

            array_push($data, $value['id']);

        }
        return $data;
    }

    /**新增
     * @param $data
     */
    public function add($data)
    {
        return Db::name('auth_group')->insertGetId($data);
    }

    /** 删除
     * @param $id
     * @return int
     */
    public function del($id)
    {
        return Db::name('auth_group')->where('id', $id)->delete();
    }

    /** 删除
     * @param $id
     * @return int
     */
    public function delLevel($id)
    {
        $id = intval($id);
        $authGroup = Db::name('auth_group')->where('id', $id)->find();
        $ids = $this->recursionDelLevel($authGroup['jdName']);
        array_push($ids, $id);
        return Db::name('auth_group')->where('id', 'in',$ids)->delete();
    }

    public function recursionDelLevel($jdName){
        $data = [];
        $ret = Db::name('auth_group')->where(['jdParent' => $jdName])->select();
        if (empty($ret)) {
            return [];
        }
        foreach ($ret as $key => $value) {

            array_push($data, $value['id']);

            $data = array_merge($data, $this->recursionDelLevel($value['jdName']));

        }
        return $data;
    }

    /** 批量删除
     * @param $ids
     * @return int
     */
    public function delall($ids)
    {
        return Db::name('auth_group')->where('id', 'in',$ids)->delete();
    }

    /**
     * [check 检测是否存在]
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function check($name)
    {
        $id = Db::name('auth_group')->where('jdName', $name)->value('id');
        if (empty($id)) {
            return 0;
        } else {
            return $id;
        }
    }


    /**
     * [check 检测是否存在]
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function checkList($jdName,$jdParent)
    {
        $id = Db::name('auth_group')->where(['jdName' => $jdName, 'jdParent' => $jdParent])->value('id');
        if (empty($id)) {
            return 0;
        } else {
            return $id;
        }
    }

}
