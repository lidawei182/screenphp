<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use \think\Db;

/**
 * 管理员管理
 * @author hardphp@163.com
 */
class Banner extends Base
{
    /**
     * 列表
     */
    public function index(){}

    /** 详情
     * @return mixed
     */
    public function getbanner()
    {
        $Banner = model('Banner', 'logic')->getbanner();
        
        ajax_return_ok($Banner);
    }

    /**
     * 保存
     */
    public function save()
    {

        $id = input('id', '0', 'int');
        $url = input('url', '', 'trim');

        $arr = json_decode($url,true); 

        //接收数据
        if($arr){
          for ($i=0; $i < count($arr); $i++) { 
             $data[$i]['url'] = $arr[$i]['url'];
             $data[$i]['createtime'] = $arr[$i]['createtime'];
             $data[$i]['updateTime'] = time();
             $data[$i]['status'] = $arr[$i]['status'];
          }
        }

        $Banner = model('Banner', 'logic')->getbanner();

        if ($Banner) {
           $res = model('Banner', 'logic')->modify($id, $data);
            if ($res == false) {
                ajax_return_error('保存失败！');
            } else {
                ajax_return_ok(['id' => $res], '保存成功！');
            }
        }else{

            $res = model('Banner', 'logic')->modify('', $data);

            ajax_return_ok($res, '保存成功！');
        }

    }

    /**
     * 删除
     */
    public function del()
    {
        $id = input('id', '0', 'int');
        if ($id == 0) {
            ajax_return_error('参数有误！');
        } else {
            if (model('Banner', 'logic')->del($id)) {
                ajax_return_ok([], '删除成功！');
            } else {
                ajax_return_error('删除失败！');
            }
        }
    }

    /**
     * 批量删除
     */
    public function delall()
    {
        $ids = input('ids', '', 'trim');
        if (empty($ids)) {
            ajax_return_error('参数有误！');
        } else {
            $ids = explode(',', $ids);
            model('Banner', 'logic')->delall($ids);
            ajax_return_ok([], '删除成功！');
        }
    }

    public function change()
    {

        $val   = input('val', '', 'int');
        $field = input('field', '', 'trim');
        $value = input('value', '', 'int');
        if (empty($field)) {
            ajax_return_error('参数有误！');
        }
        $res = model('Admin', 'logic')->change($val, $field, $value);
        if ($res) {
            ajax_return_ok([], '修改成功！');
        } else {
            ajax_return_error('修改失败！');
        }

    }

}
