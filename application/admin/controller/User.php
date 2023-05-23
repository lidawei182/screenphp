<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use \think\Db;

/**
 * 管理员登录日志管理
 * @author hardphp@163.com
 */
class User extends Base
{
    /**
     * 列表
     */
    public function index()
    {
        if ($this->request->isPost()) {
            //搜索参数
            $userName  = input('userName', '', 'trim');
            $id       = input('id', '', 'trim');
            $realName   = input('realName', '', 'trim');
            $startTime = input('startTime', '', 'strtotime');
            $endTime   = input('endTime', '', 'strtotime');
            $sort      = input('sort', '', 'trim');
            $sort == "-id" ? $order = input('order/a', 'a.id asc') : $order = input('order/a', 'a.id desc');
            $page      = input('page', 1, 'intval');
            $psize     = input('psize', 10, 'intval');

            $lists           = model('User', 'logic')->getLists($id, $userName, $realName, $startTime, $endTime, $order, $page, $psize);
            $result['total'] = model('User', 'logic')->getTotal($id, $userName, $realName, $startTime, $endTime);
            $result['data']  = $lists;
            ajax_return_ok($result);
        }
    }
    /**
     * 添加和修改
     */
    public function save()
    {
        $id = input('id', '0', 'int');
        //接收数据
        $data     = [
            'userName'  => input('userName', '', 'trim'),
            'realName'  => input('realName', '', 'trim'),
            'img'       => input('img', '', 'trim'),
            'phone'     => input('phone', '', 'trim'),
            'password'  => input('password', '', 'trim'),
            'regTime'   => input('regTime', 0, 'int'),
            'isEnabled' => input('isEnabled', 0, 'int'),
            'descript' => input('descript', 0, 'trim'),
        ];
        $validate = validate('User');
        $result   = $validate->scene('save')->check($data);
        if (!$result) {
            $error = $validate->getError();
            ajax_return_error($error);
        }
        $res = model('User', 'logic')->modify($id, $data);
        if ($res == false) {
            ajax_return_error('保存失败！');
        } else {
            ajax_return_ok(['id' => $res], '保存成功！');
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
            if ($id == 1) {
                ajax_return_error('该记录不能删除！');
            }
            if (model('User', 'logic')->del($id)) {
                ajax_return_ok([], '删除成功！');
            } else {
                ajax_return_error('删除失败！');
            }
        }
    }
    /** 显示编辑详情
     * @return mixed
     */
    public function getinfo()
    {
        $id = input('id', '0', 'int');
        if ($id == 0) {
            ajax_return_error('参数有误！');
        }
        $info = model('User', 'logic')->getUserById($id);
        ajax_return_ok($info);
    }
    /** 修改状态
     * @return mixed
     */
    public function change()
    {

        $val   = input('val', '', 'int');
        $field = input('field', '', 'trim');
        $value = input('value', '', 'int');
        if (empty($field)) {
            ajax_return_error('参数有误！');
        }
        $res = model('User', 'logic')->change($val, $field, $value);
        if ($res) {
            ajax_return_ok([], '修改成功！');
        } else {
            ajax_return_error('修改失败！');
        }

    }

}
