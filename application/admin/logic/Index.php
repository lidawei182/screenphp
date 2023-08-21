<?php

namespace app\admin\logic;

use \think\Model;
use app\common\CommonConstant;
use app\common\util\JwtUtil;
use \think\Db;

/**
 * 首页相关操作
 */
class Index extends Model
{

    /** 数据可视化
     * @param jdno 关联id themoonarraylist 日期数组 dateValue 月-年
     */
    public function dataIntegration($jdno,$code,$themoonarraylist,$dateValue)
    {
        return my_model('People', 'model', 'admin')->dataIntegration($jdno,$code,$themoonarraylist,$dateValue);
    }
    /** 地图数据可视化
     * @param jdno 关联id
     */
    public function mapIntegration($code){
        return my_model('People', 'model', 'admin')->mapIntegration($code);
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
    public function dateCallsList($jdno, $id, $oldmanname, $calltime, $endcalltime,  $sort, $page, $psize)
    {
        return my_model('People', 'model', 'admin')->dateCallsList($jdno, $id, $oldmanname, $calltime, $endcalltime,  $sort, $page, $psize);
    }
    /** 呼叫
     * @param jdno 关联id
     */
    public function dateCallsListTotal($jdno, $id, $oldmanname, $calltime, $endcalltime)
    {
        return my_model('People', 'model', 'admin')->dateCallsListTotal($jdno, $id, $oldmanname, $calltime, $endcalltime);
    }
    /** 历史
     * @param jdno 关联id
     */
    public function historyCallsList($jdno, $id, $oldmanname, $calltime, $endTime, $page, $psize) 
    {
        return my_model('People', 'model', 'admin')->historyCallsList($jdno, $id, $oldmanname, $calltime, $endTime, $page, $psize);
    }
    /** 历史
     * @param jdno 关联id
     */
    public function historyCallsListTotal($jdno, $id, $oldmanname, $calltime, $endTime)
    {
        return my_model('People', 'model', 'admin')->historyCallsListTotal($jdno, $id, $oldmanname, $calltime, $endTime);
    }

    /** 用户
     * @param jdno 关联id
     */
    public function getPeopleList($code, $deviceno, $oldmanname, $contact, $identityCard, $myorder = 'a.deviceno desc', $page, $psize)
    {
        return my_model('People', 'model', 'admin')->getPeopleList($code,$deviceno, $oldmanname, $contact, $identityCard, $myorder, $page, $psize);
    }
    /** 用户
     * @param jdno 关联id
     */
    public function getPeopleListTotal($code, $deviceno, $oldmanname, $contact, $identityCard)
    {
        return my_model('People', 'model', 'admin')->getPeopleListTotal($code, $deviceno, $oldmanname, $contact, $identityCard);
    }

    /** 用户have
     * @param code 关联deviceno
     */
    public function havePeopleList($code)
    {
        return my_model('People', 'model', 'admin')->havePeopleList($code);
    }

}
