<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use \think\Db;

/**
 * 管理员管理
 * @author hardphp@163.com
 */
class Binding extends Base
{
    /**
     * 保存
     */
    public function save()
    {
        $id = input('id', '0', 'int');
        //接收数据
        $data     = [
            'groupId'   => input('groupId', '', 'trim'),
            'userName'  => input('userName', '', 'trim'),
            'realName'  => input('realName', '', 'trim'),
            'img'       => input('img', '', 'trim'),
            'phone'     => input('phone', '', 'trim'),
            'email'     => input('email', '', 'trim'),
            'password'  => input('password', '', 'trim'),
            'regTime'   => input('regTime', 0, 'int'),
            'isEnabled' => input('isEnabled', 0, 'int'),
            'code'      => input('code', '', 'trim'),
        ];
        $validate = validate('Admin');
        $result   = $validate->scene('save')->check($data);
        if (!$result) {
            $error = $validate->getError();
            ajax_return_error($error);
        }
        $res = model('Admin', 'logic')->modify($id, $data);
        if ($res == false) {
            ajax_return_error('保存失败！');
        } else {
            ajax_return_ok(['id' => $res], '保存成功！');
        }
    }
}
