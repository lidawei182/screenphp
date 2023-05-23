<?php

namespace app\admin\model;

use \think\Model;
use \think\Db;

/**
 * 管理员相关操作
 */
class People extends Model
{
    /** 大数据
     * @param $jdno 关联id , $themoonarraylist 日期数组 , $dateValue 月-年
     */
    public function dataIntegration($jdno,$themoonarraylist,$dateValue)
    {
        $where = " a.jdno = " . $jdno;

        $data['tree'] = Db::name('tree')
        ->alias('a')
        ->field('a.jdName,c.No,c.oldmanname,c.Contact,c.Address,c.birthday,c.sex,
            c.identity_card,c.deviceno,c.Residence_state,c.oldman_type,c.marital_status,
            c.pathography,c.Children_situation,c.anaphylactic,c.Healthy,c.remark,
            c.lianxiren1,c.lianxiren2,c.lianxiren3,c.lianxiren4,c.lianxiren5,c.lianxiren6,
            c.lianxiren7,c.lianxiren8,c.longitude1,c.latitude1,c.clientno')
        ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
        ->join('people c', 'b.deviceid = c.deviceno', 'left')
        ->where($where)
        ->distinct(true)
        ->select();

        $where1 = " a.jdno = " . $jdno . " and c.status <> '挂断' ";
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
        ->order('c.id desc')
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

        $where2 = " a.jdno = " . $jdno ;

        $where2 .= " and c.status = " . "'$status'";
        
        $where2 .= " and  c.calltime >= " ."'$calltime1'";

        $where2 .= " and  c.calltime <= " ."'$calltime2'";

        // $whereOr = [ 
        //     'c.taketime' => NULL,
        //     'c.taketime' => ''
        // ];

        if($taketime == 1){
            return Db::name('tree')
                ->alias('a')
                ->field('COUNT(c.calltime) AS counts,c.calltime as ctime')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('t_calllist_voice c', 'b.deviceid = c.deviceid', 'left')
                ->where($where2)
                ->find();
        }
        if($taketime == 0){
            //$where2 .= " and  c.endtime IS NULL ";
            return Db::name('tree')
                ->alias('a')
                ->field('COUNT(c.calltime) AS counts,c.calltime as ctime')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('t_calllist_voice c', 'b.deviceid = c.deviceid', 'left')
                ->where($where2)
                ->where(function($query){
                    $query->where(['c.taketime' => NULL])->whereOr(['c.taketime' => '']);
                })->where(function($query){
                    $query->where(['c.endtime' => NULL])->whereOr(['c.endtime' => '']);
                })->find();
        }

    }
    /** 地图大数据
     * @param $jdno 关联id
     */
    public function mapIntegration($jdno){
        $where = " a.jdno = " . $jdno;
        $data['tree'] = Db::name('tree')
        ->alias('a')
        ->field('a.jdName,c.No,c.oldmanname,c.Contact,c.Address,c.birthday,c.sex,
            c.identity_card,c.deviceno,c.Residence_state,c.oldman_type,c.marital_status,
            c.pathography,c.Children_situation,c.anaphylactic,c.Healthy,c.remark,
            c.lianxiren1,c.lianxiren2,c.lianxiren3,c.lianxiren4,c.lianxiren5,c.lianxiren6,
            c.lianxiren7,c.lianxiren8,c.longitude1,c.latitude1,c.clientno,d.isonline')
        ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
        ->join('people c', 'b.deviceid = c.deviceno', 'left')
        ->join('callno d', 'c.deviceno = d.callno', 'left')
        ->where($where)
        ->distinct(true)
        ->select();
        return $data;
    }


    /** 呼叫
     * @param $jdno 关联id
     */
    public function dateCallsList($jdno, $id, $oldmanname, $page, $psize)
    {
        $where = true;

        $where = " a.jdno = " . $jdno . " and c.status <> '挂断' ";

        if ($id) {
            $where .= " and c.id = " . $id;
        }
        
        if ($oldmanname) {
            $where .= " and d.oldmanname like '%" . $oldmanname . "%' ";
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
            ->order('c.id desc')
            ->page($page, $psize)
            ->select();

        return $data;
    }
    /** 呼叫
     * @param $jdno 关联id
     */
    public function dateCallsListTotal($jdno, $id, $oldmanname)
    {
        $where = true;

        $where = " a.jdno = " . $jdno . " and c.status <> '挂断' ";

        if ($id) {
            $where .= " and c.id = " . $id;
        }
        
        if ($oldmanname) {
            $where .= " and d.oldmanname like '%" . $oldmanname . "%' ";
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
    public function historyCallsList($jdno, $id, $oldmanname, $page, $psize)
    {
        $where = true;

        $where = " a.jdno = " . $jdno;

        if ($id) {
            $where .= " and c.id = " . $id;
        }
        
        if ($oldmanname) {
            $where .= " and d.oldmanname like '%" . $oldmanname . "%' ";
        }

        $exp = new \think\Db\Expression('c.id desc');

        return Db::name('tree')
                ->alias('a')
                ->field('c.*,d.No,d.oldmanname,d.Address')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('calllist_voice c', 'b.deviceid = c.deviceid', 'left')
                ->join('people d', 'c.deviceid = d.deviceno', 'left')
                ->where($where)
                ->distinct(true)
                ->page($page, $psize)
                ->select();
    }
    /** 历史
     * @param $jdno 关联id
     */
    public function historyCallsListTotal($jdno, $id, $oldmanname)
    {
        $where = true;

        $where = " a.jdno = " . $jdno;

        if ($id) {
            $where .= " and c.id = " . $id;
        }
        
        if ($oldmanname) {
            $where .= " and d.oldmanname like '%" . $oldmanname . "%' ";
        }

        return Db::name('tree')
                ->alias('a')
                ->field('c.*,d.No,d.oldmanname,d.Address')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('t_calllist_voice c', 'b.deviceid = c.deviceid', 'left')
                ->join('people d', 'c.deviceid = d.deviceno', 'left')
                ->where($where)
                ->where($where)
                ->distinct(true)
                ->count();
    }

    /** 用户
     * @param $jdno 关联id
     */
    public function getPeopleList($jdno, $deviceno, $oldmanname, $myorder, $page, $psize)
    {
        $where = true;

        $where = " a.jdno = " . $jdno;

        if ($deviceno) {
            $where .= " and c.deviceno = " . "'$deviceno'";
        }
        
        if ($oldmanname) {
            $where .= " and c.oldmanname like '%" . $oldmanname . "%' ";
        }

        $data = Db::name('tree')
                ->alias('a')
                ->field('a.jdName,c.*')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('people c', 'b.deviceid = c.deviceno', 'left')
                ->where($where)
                ->order($myorder)
                ->distinct(true)
                ->page($page, $psize)
                ->select();

        return $data;
    }
    /** 用户
     * @param $jdno 关联id
     */
    public function getPeopleListTotal($jdno, $deviceno, $oldmanname)
    {
        $where = true;

        $where = " a.jdno = " . $jdno;

        if ($deviceno) {
            $where .= " and c.deviceno = " . "'$deviceno'";
        }
        
        if ($oldmanname) {
            $where .= " and c.oldmanname like '%" . $oldmanname . "%' ";
        }

        return Db::name('tree')
                ->alias('a')
                ->field('a.jdName,c.*')
                ->join('tree_device b', 'a.jdno = b.jdparent', 'left')
                ->join('people c', 'b.deviceid = c.deviceno', 'left')
                ->where($where)
                ->distinct(true)
                ->count();
    }

}
