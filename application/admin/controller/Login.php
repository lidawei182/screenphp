<?php

namespace app\admin\controller;

use app\common\controller\Api;
use app\common\util\AuthUtil;

/**
 * 后台登陆
 * @author hardphp@163.com
 */
class Login extends Api
{
    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 登录
     */
    public function index()
    {
        if ($this->request->isPost()) {
            //接收数据
            $data = [
                'userName' => input('userName', '', 'trim'),
                'password' => input('password', '', 'trim'),
            ];
            $validate = validate('Admin');
            $result = $validate->scene('login')->check($data);
            if (!$result) {
                $error = $validate->getError();
                ajax_return_error($error);
            }
            // 登录验证并获取包含访问令牌的用户
            $result = model('Admin', 'logic')->login($data['userName'], $data['password']);
            ajax_return_ok($result, '登录成功');
        }
    }

    /**
     * 保存
     */
    public function saveLogin()
    {
        if ($this->request->isPost()) {
            //接收数据
            $data     = [
                'userName'  => input('userName', '', 'trim'),
                'realName'  => input('realName', '', 'trim'),
                'img'       => input('img', '', 'trim'),
                'phone'     => input('phone', '', 'trim'),
                'email'     => input('email', '', 'trim'),
                'password'  => input('password', '', 'trim'),
                'regTime'   => input('regTime', 0, 'int'),
                'isEnabled' => input('isEnabled', 0, 'int'),
                'UnitNo'    => input('UnitNo', '', 'trim'),
            ];

            $validate = validate('Admin');
            $result   = $validate->scene('saveLogin')->check($data); 
            if (!$result) {
                $error = $validate->getError();
                ajax_return_error($error);
            }
            $res = model('Admin', 'logic')->modifyLogin($data);  
            if ($res == false) {
                ajax_return_error('保存失败！');
            } else {
                ajax_return_ok(['id' => $res], '保存成功！');
            }
        }
    
    }


    /**
     * 保存
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $id = input('id', '0', 'int');
            //接收数据
            $data     = [
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
    
    /**
     * 删除图片
     */
    public function delfile()
    {
        $img = input('img', '', 'trim');

        $UnitNo = input('UnitNo', '', 'trim');

        if (empty($img)) {
            ajax_return_error('参数错误');
        }

        $filename = substr($img, 27);

        if(file_exists($filename)){

            $u = unlink($filename);

            if($u){

                if($UnitNo){
                    $res = model('Admin', 'logic')->delfile($UnitNo);
                }

                ajax_return_ok(['filename' => $img,'unlink' => $u], '删除成功！');
            }else{
                ajax_return_ok(['filename' => $img,'unlink' => $u], '删除失败！');
            }

        }else{

            ajax_return_ok(['filename' => $img, 'unlink' => false ], '图片不存在');

        }
    }

    /**
     * 退出
     */
    public function logout($result = [])
    {
        $result['data'] = true;
        ajax_return_ok($result, '退出成功');
    }

}
