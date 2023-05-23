<?php

namespace app\admin\logic;

use \think\Model;
use app\common\CommonConstant;
use app\common\util\JwtUtil;
use \think\Db;

/**
 * 管理员相关操作
 */
class Index extends Model
{

    /** 数据可视化
     * @param jdno 关联id themoonarraylist 日期数组 dateValue 月-年
     */
    public function dataIntegration($jdno,$themoonarraylist,$dateValue)
    {
        return my_model('People', 'model', 'admin')->dataIntegration($jdno,$themoonarraylist,$dateValue);
    }
    /** 地图数据可视化
     * @param jdno 关联id
     */
    public function mapIntegration($jdno){
        return my_model('People', 'model', 'admin')->mapIntegration($jdno);
    }
    /** 地图数据可视化定位
     * @param $id,$lng,$lat,$zoom
     */
    public function mapPositioning($id,$lng,$lat,$zoom){
        return my_model('Admin', 'model', 'admin')->mapPositioning($id,$lng,$lat,$zoom);
    }
    /** 根据id获取定位信息
     * @param $id,$lng,$lat,$zoom
     */
    public function getMapPositioning($id){
        return my_model('Admin', 'model', 'admin')->getMapPositioning($id);
    }
    /** 根据id清空定位信息
     * @param $id
     */
    public function updateMapPg($id){
        return my_model('Admin', 'model', 'admin')->updateMapPg($id);
    }
    /** 呼叫
     * @param jdno 关联id
     */
    public function dateCallsList($jdno, $id, $oldmanname, $page, $psize)
    {
        return my_model('People', 'model', 'admin')->dateCallsList($jdno, $id, $oldmanname, $page, $psize);
    }
    /** 呼叫
     * @param jdno 关联id
     */
    public function dateCallsListTotal($jdno, $id, $oldmanname)
    {
        return my_model('People', 'model', 'admin')->dateCallsListTotal($jdno, $id, $oldmanname);
    }
    /** 历史
     * @param jdno 关联id
     */
    public function historyCallsList($jdno, $id, $oldmanname, $page, $psize)
    {
        return my_model('People', 'model', 'admin')->historyCallsList($jdno, $id, $oldmanname, $page, $psize);
    }
    /** 历史
     * @param jdno 关联id
     */
    public function historyCallsListTotal($jdno, $id, $oldmanname)
    {
        return my_model('People', 'model', 'admin')->historyCallsListTotal($jdno, $id, $oldmanname);
    }

    /** 用户
     * @param jdno 关联id
     */
    public function getPeopleList($jdno, $deviceno, $oldmanname, $myorder = 'c.deviceno desc', $page, $psize)
    {
        return my_model('People', 'model', 'admin')->getPeopleList($jdno,$deviceno, $oldmanname, $myorder, $page, $psize);
    }
    /** 用户
     * @param jdno 关联id
     */
    public function getPeopleListTotal($jdno, $deviceno, $oldmanname)
    {
        return my_model('People', 'model', 'admin')->getPeopleListTotal($jdno, $deviceno, $oldmanname);
    }

}
