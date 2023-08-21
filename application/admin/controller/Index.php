<?php

namespace app\admin\controller;

use app\admin\controller\Base;

/**
 * 系统首页
 */
class Index extends Base
{

    public function index()
    {
    }

    public function dataIntegration()
    {
        
        $data = input('data', '', 'trim');

        $data = json_decode($data, true);

        $jdno = $data['jdno'];

        $code = $data['code'];

        $dateValue = $data['dateValue'];

        $themoonarraylist = [];

        if($dateValue == '月'){
            $themoonarraylist = json_decode($data['themoonarraylist'], true);
        }else {
            $themoonarraylist = $data['themoonarraylist'];
        }        

        $result = my_model('Index', 'logic', 'admin')->dataIntegration($jdno,$code,$themoonarraylist,$dateValue);

        ajax_return_ok($result);
    }


    public function mapIntegration()
    {
        
        $code = input('code', '', 'trim');

        $result = my_model('Index', 'logic', 'admin')->mapIntegration($code);

        ajax_return_ok($result);
    }

    public function mapPositioning()
    {
        
        if ($this->request->isPost()) {

            $id   = input('id', '', 'trim');
            $lng  = input('lng', '', 'trim');
            $lat  = input('lat', '', 'trim');
            $zoom = input('zoom', '', 'trim');

            $result = my_model('Index', 'logic', 'admin')->mapPositioning($id,$lng,$lat,$zoom);

            ajax_return_ok($result);
        }
    
    }

    public function getMapPositioning()
    {
        
        if ($this->request->isPost()) {

            $id   = input('id', '', 'trim');

            $result = my_model('Index', 'logic', 'admin')->getMapPositioning($id);

            ajax_return_ok($result);
        }
    
    }

    public function updateMapPg()
    {
        
        if ($this->request->isPost()) {

            $id   = input('id', '', 'trim');

            $result = my_model('Index', 'logic', 'admin')->updateMapPg($id);

            ajax_return_ok($result);
        }
    
    }


    public function dateCallsList()
    {
        if ($this->request->isPost()) {
            //搜索参数
            $jdno = input('jdno', '', 'trim');
            $id = input('id', '', 'trim');
            $oldmanname = input('oldmanname', '', 'trim');
            $calltime = input('calltime', '', 'trim');
            $endcalltime = input('endcalltime', '', 'trim');
            $sort = input('sort', '', 'trim');
            $page = input('page', 1, 'intval');
            $psize = input('psize', 10, 'intval');

            $lists  = my_model('Index', 'logic', 'admin')->dateCallsList($jdno, $id, $oldmanname, $calltime, $endcalltime, $sort, $page, $psize);
            
            $result['total'] = my_model('Index', 'logic', 'admin')->dateCallsListTotal($jdno, $id, $oldmanname, $calltime, $endcalltime);
            $result['data']  = $lists;
            ajax_return_ok($result);
        }
    }

    public function historyCallsList() 
    {
        if ($this->request->isPost()) {
            //搜索参数
            $jdno = input('jdno', '', 'trim');
            $id = input('id', '', 'trim');
            $oldmanname = input('oldmanname', '', 'trim');
            $calltime = input('calltime', '', 'trim');
            $endTime   = input('endtime', '', 'trim');
            $page = input('page', 1, 'intval');
            $psize = input('psize', 10, 'intval');

            $lists  = my_model('Index', 'logic', 'admin')->historyCallsList($jdno, $id, $oldmanname, $calltime, $endTime, $page, $psize);
            $result['total'] = my_model('Index', 'logic', 'admin')->historyCallsListTotal($jdno, $id, $oldmanname, $calltime, $endTime);
            $result['data']  = $lists;
            ajax_return_ok($result);
        }
    }

    //用户user
    public function getPeopleList()
    {
        if ($this->request->isPost()) {
            //搜索参数
            $code        = input('code', '', 'trim');
            $deviceno    = input('deviceno', '', 'trim');
            $oldmanname  = input('oldmanname', '', 'trim');
            $contact    = input('Contact', '', 'trim');
            $identityCard  = input('identity_card', '', 'trim');
            $sort      = input('sort', '', 'trim');
            $sort == "-deviceno" ? $order = input('order/a', 'deviceno asc') : $order = input('order/a', 'deviceno desc');
            $page      = input('page', 1, 'intval');
            $psize     = input('psize', 10, 'intval');
            $lists           = my_model('Index', 'logic', 'admin')->getPeopleList($code, $deviceno, $oldmanname, $contact, $identityCard, $order, $page, $psize);
            $result['total'] = my_model('Index', 'logic', 'admin')->getPeopleListTotal($code,$deviceno, $oldmanname, $contact, $identityCard);
            $result['data'] = $lists;
            ajax_return_ok($result);
        }
    }
    
    //用户have
    public function havePeopleList()
    {
        if ($this->request->isPost()) {
            //搜索参数
            $code        = input('code', '', 'trim');
            $lists       = my_model('Index', 'logic', 'admin')->havePeopleList($code);
            $result['data'] = $lists;
            ajax_return_ok($result);
        }
    }

    //刷新token
    public function refesh()
    {
        //接收数据
        $data  = ['id' => input('id', '', 'trim')];
        // 获取包含访问令牌的用户
        $result = model('Admin', 'logic')->refeshTpken($data['id']);
        ajax_return_ok($result, '刷新token成功');
    }
}
