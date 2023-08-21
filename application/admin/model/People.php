<?php

namespace app\admin\model;

use \think\Model;
use \think\Db;

/**
 * 首页相关操作
 */
class People extends Model
{
    /** 大数据
     * @param $jdno 关联id , $themoonarraylist 日期数组 , $dateValue 月-年
     */
    public function dataIntegration($jdno,$code,$themoonarraylist,$dateValue)
    {

        $data['tree'] = Db::table('t_people')
            ->where('deviceno', 'IN', function ($query) use ($code) {
            $query->table('t_otherwebservice')->where('ClientNo',$code)->field('deviceno');
        })->select();

        $where1 = " a.jdno = " . $jdno . " and c.status <> '挂断' " . " and d.oldmanname <> ''";
        $calllist = Db::name('tree')
        ->alias('a')
        ->field('c.*,d.No,d.oldmanname,d.Address')
        ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
        ->join('t_calllist_voice c', 'b.deviceid = c.deviceid', 'left')
        ->join('people d', 'c.deviceid = d.deviceno', 'left')
        ->where($where1)
        ->where(function($query){
            $query->where('c.status' ,'<>', NULL)->whereOr('c.status' ,'<>', '');
        })->distinct(true)
        ->order('c.id ASC')
        ->page(1, 10)
        ->select();

        $calllistTotal= Db::name('tree')
        ->alias('a')
        ->field('c.*,d.No,d.oldmanname,d.Address')
        ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
        ->join('t_calllist_voice c', 'b.deviceid = c.deviceid', 'left')
        ->join('people d', 'c.deviceid = d.deviceno', 'left')
        ->where($where1)
        ->where(function($query){
            $query->where('c.status' ,'<>', NULL)->whereOr('c.status' ,'<>', '');
        })->distinct(true)
        ->count();

        $data['calllist'] = $calllist;
        $data['calllistTotal'] = $calllistTotal;

        // 呼叫曲线图数据------------------------------------------------------
        if($dateValue == '月'){
            // $themoonCount 呼叫总数
            foreach ($themoonarraylist as $key => $value) {
                $time1 = $themoonarraylist[$key][0];
                $time2 = strtotime($themoonarraylist[$key][1]) + 86400;
                $time2 = date('Y-m-d', $time2);
                $themoonCount[$key] = $this->themoonfun($jdno,'挂断',true,$time1,$time2);
            }
            $data['themoonCount'] = $themoonCount;
            // $themoonAbnormal 异常挂断
            foreach ($themoonarraylist as $key => $value) {
                $time11 = $themoonarraylist[$key][0];
                $time22 = strtotime($themoonarraylist[$key][1]) + 86400;
                $time22 = date('Y-m-d', $time22);
                $themoonAbnormal[$key] = $this->themoonfun($jdno,'挂断','null',$time11,$time22);
            }
            $data['themoonAbnormal'] = $themoonAbnormal;
        }else{
            // 年
            // $themoonCount 呼叫总数
            foreach ($themoonarraylist as $key => $value) {

                $themoonCount[$key] = $this->themoonfun($jdno,'挂断',1,$themoonarraylist[$key][0],$themoonarraylist[$key][1]);
            }
            $data['themoonCount'] = $themoonCount;

            foreach ($themoonarraylist as $key => $value) {
                
                $themoonAbnormal[$key] = $this->themoonfun($jdno,'挂断',0,$themoonarraylist[$key][0],$themoonarraylist[$key][1]);
            }
            $data['themoonAbnormal'] = $themoonAbnormal;
        }
        // 呼叫曲线图数据-----------------------------------------------

        return $data;
    }

    public function themoonfun($jdno,$status,$taketime,$calltime1,$calltime2){

        $where2 = true;

        $where2 = " a.jdno = " . $jdno ." and c.calltime IS NOT NULL and  d.oldmanname IS NOT NULL";

        $where2 .= " and  c.calltime >= " ."'$calltime1'";

        $where2 .= " and  c.calltime <= " ."'$calltime2'";

        if($taketime == 1){
            return Db::name('tree')
                ->alias('a')
                ->field('COUNT(c.calltime) AS counts,c.calltime as ctime')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('t_calllist_voice c', 'b.deviceid = c.deviceid', 'left')
                ->join('people d', 'c.deviceid = d.deviceno', 'left')
                ->where($where2)
                ->where(function($query){
                    $query->where('c.calltime' ,'<>', NULL)->whereOr('c.calltime' ,'<>', '');
                })
                ->find();
        }
        if($taketime == 0){
            $where2 .= " and c.status = " . "'$status'";
            $where2 .= " and c.taketime IS NULL";
            return Db::name('tree')
                ->alias('a')
                ->field('COUNT(c.calltime) AS counts,c.calltime as ctime')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('t_calllist_voice c', 'b.deviceid = c.deviceid', 'left')
                ->join('people d', 'c.deviceid = d.deviceno', 'left')
                ->where($where2)
                ->where(function($query){
                    $query->where('c.calltime' ,'<>', NULL)->whereOr('c.calltime' ,'<>', '');
                })
                ->find();
        }

    }
    /** 地图大数据
     * @param $jdno 关联id
     */
    public function mapIntegration($code){

        if($code){
            $data['tree'] = Db::table('t_people')
                ->alias('a')
                ->field('a.*,b.isonline')
                ->join('callno b', 'a.deviceno = b.callno', 'left')
                ->where('deviceno', 'IN', function ($query) use ($code) {
                $query->table('t_otherwebservice')->where('ClientNo',$code)->field('deviceno');
            })->select();
        }else{
            $data['tree'] = [];
        }
        return $data;
    }


    /** 呼叫
     * @param $jdno 关联id
     */
    public function dateCallsList($jdno, $id, $oldmanname, $calltime, $endcalltime,  $sort, $page, $psize)
    {
        $where = true;

        $where = " a.jdno = " . $jdno . " and c.status <> '挂断' " . " and d.oldmanname <> ''";

        if ($id) {
            $where .= " and c.id = " . $id;
        }
        
        if ($oldmanname) {
            $where .= " and d.oldmanname like '%" . $oldmanname . "%' ";
        }

        if ($calltime) {
            $where .= " and  c.calltime >= " . "'$calltime'";
        }

        if ($endcalltime) {
            $where .= " and  c.calltime <= " . "'$endcalltime'";
        }

        $ordersort = 'c.calltime DESC';

        if($sort){
            if($sort == 'ASC'){
                $ordersort = 'c.calltime ASC';
            }else{
                $ordersort = 'c.calltime DESC';
            }
        }

        $data = Db::name('tree')
            ->alias('a')
            ->field('c.*,d.No,d.oldmanname,d.Address')
            ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
            ->join('calllist_voice c', 'b.deviceid = c.deviceid', 'left')
            ->join('people d', 'c.deviceid = d.deviceno', 'left')
            ->where($where)
            ->where(function($query){
                $query->where('c.status' ,'<>', NULL)->whereOr('c.status' ,'<>', '');
            })->distinct(true)
            ->order($ordersort)
            ->page($page, $psize)
            ->select();

        return $data;
    }
    /** 呼叫
     * @param $jdno 关联id
     */
    public function dateCallsListTotal($jdno, $id, $oldmanname, $calltime, $endcalltime)
    {
        $where = true;

        $where = " a.jdno = " . $jdno . " and c.status <> '挂断' " . " and d.oldmanname <> ''";

        if ($id) {
            $where .= " and c.id = " . $id;
        }
        
        if ($oldmanname) {
            $where .= " and d.oldmanname like '%" . $oldmanname . "%' ";
        }

        if ($calltime) {
            $where .= " and  c.calltime >= " . "'$calltime'";
        }
        
        if ($endcalltime) {
            $where .= " and  c.calltime <= " . "'$endcalltime'";
        }

        return Db::name('tree')
                ->alias('a')
                ->field('c.*,d.No,d.oldmanname,d.Address')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('calllist_voice c', 'b.deviceid = c.deviceid', 'left')
                ->join('people d', 'c.deviceid = d.deviceno', 'left')
                ->where($where)
                ->where(function($query){
                    $query->where('c.status' ,'<>', NULL)->whereOr('c.status' ,'<>', '');
                })->distinct(true)
                ->count();
    }

    /** 历史
     * @param $jdno 关联id
     */
    public function historyCallsList($jdno, $id, $oldmanname, $calltime, $endTime, $page, $psize)
    {
        $where = true;

        $where = " a.jdparent = " . $jdno;

        if ($id) {
            $where .= " and c.id = " . $id;
        }
        
        if ($oldmanname) {
            $where .= " and c.oldmanname like '%" . $oldmanname . "%' ";
        }

        if ($calltime) {
            $where .= " and  b.calltime >= " . "'$calltime'";
        }
        if ($endTime) {
            $historytime2 = strtotime($endTime) + 86400;
            $historytime2 = date('Y-m-d', $historytime2);
            $where .= " and  b.calltime <= " . "'$historytime2'";
        }

        $where .= " and  c.oldmanname IS NOT NULL ";

        $data['calltime'] = $calltime;
        $data['endTime'] = $endTime;
     
        $data['list'] =  Db::name('tree_device')
            ->alias('a')
            ->field('b.*,c.oldmanname,c.Address,c.remark')
            ->join('calllist_voice b', 'a.deviceid = b.deviceid', 'left')
            ->join('people c', 'b.deviceid = c.deviceno', 'left')
            ->where($where)
            ->distinct(true)
            ->order('b.calltime','desc')
            ->page($page, $psize)
            ->select();

        return $data;
    }
    /** 历史
     * @param $jdno 关联id
     */
    public function historyCallsListTotal($jdno, $id, $oldmanname, $calltime, $endTime)
    {
        $where = true;

        $where = " a.jdparent = " . $jdno;

        if ($id) {
            $where .= " and c.id = " . $id;
        }
        
        if ($oldmanname) {
            $where .= " and c.oldmanname like '%" . $oldmanname . "%' ";
        }

        if ($calltime) {
            $where .= " and  b.calltime >= " . "'$calltime'";
        }
        if ($endTime) {
            $historytime2 = strtotime($endTime) + 86400;
            $historytime2 = date('Y-m-d', $historytime2);
            $where .= " and  b.calltime <= " . "'$historytime2'";
        }

        $where .= " and  c.oldmanname IS NOT NULL";

        return Db::name('tree_device')
                ->alias('a')
                ->field('b.*,c.oldmanname')
                ->join('calllist_voice b', 'a.deviceid = b.deviceid', 'left')
                ->join('people c', 'b.deviceid = c.deviceno', 'left')
                ->where($where)
                ->distinct(true)
                ->count();
    }

    /** 用户
     * @param $jdno 关联id
     */
    public function getPeopleList($code, $deviceno, $oldmanname, $contact, $identityCard, $myorder, $page, $psize)
    {
        $where = true;

        if ($deviceno) {
            $where .= " and a.deviceno = " . "'$deviceno'";
        }
        
        if ($oldmanname) {
            $where .= " and a.oldmanname like '%" . $oldmanname . "%' ";
        }

        if ($contact) {
            $where .= " and a.Contact like '%" . $contact . "%' ";
        }

        if ($identityCard) {
            $where .= " and a.identity_card like '%" . $identityCard . "%' ";
        }

        $data['list'] = Db::table('t_people')
            ->alias('a')
            ->field('a.*,b.isonline')
            ->join('callno b', 'a.deviceno = b.callno', 'left')
            ->where('deviceno', 'IN', function ($query) use ($code) {
                $query->table('t_otherwebservice')->where('ClientNo',$code)->field('deviceno');
            })
            ->where($where)
            ->order($myorder)
            ->page($page, $psize)
            ->select();

        return $data;
    }
    /** 用户
     * @param $jdno 关联id
     */
    public function getPeopleListTotal($code, $deviceno, $oldmanname, $contact, $identityCard)
    {
        $where = true;

        if ($deviceno) {
            $where .= " and a.deviceno = " . "'$deviceno'";
        }
        
        if ($oldmanname) {
            $where .= " and a.oldmanname like '%" . $oldmanname . "%' ";
        }

        if ($contact) {
            $where .= " and a.Contact like '%" . $contact . "%' ";
        }

        if ($identityCard) {
            $where .= " and a.identity_card like '%" . $identityCard . "%' ";
        }

        return Db::table('t_people')
            ->alias('a')
            ->field('a.*,b.isonline')
            ->join('callno b', 'a.deviceno = b.callno', 'left')
            ->where('deviceno', 'IN', function ($query) use ($code) {
                $query->table('t_otherwebservice')->where('ClientNo',$code)->field('deviceno');
            })
            ->where($where)
            ->count();
    }

    /** 用户
     * @param $jdno 关联id
     */
    public function havePeopleList($code)
    {
        $data['have'] = Db::table('t_people')
            ->alias('a')
            ->field('b.isonline,count(b.isonline) have')
            ->join('callno b', 'a.deviceno = b.callno', 'left')
            ->where('deviceno', 'IN', function ($query) use ($code) {
                $query->table('t_otherwebservice')->where('ClientNo',$code)->field('deviceno');
            })
            ->group('b.isonline')
            ->select();
        return $data;
    }

}
