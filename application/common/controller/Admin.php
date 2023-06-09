<?php

namespace app\common\controller;
use app\common\controller\Api;
use app\common\util\AuthUtil;

/**
 * 后台接口基类
 * @author hardphp@163.com
 *
 */
class Admin extends Api
{
    //用户信息
    protected $user = [];
    protected $uid = 0;
    public function _initialize()
    {
        parent::_initialize();
        //身份验证
        $result = AuthUtil::checkUser('admin');
        if ($result['status']) {
            $this->user = $result['msg'];
            $this->uid  = $result['msg']['id'];
        }

        //权限验证
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        //当前模块名称是 request()->module()
        //当前控制器名称是 request()->controller();
        //当前操作名称是 request()->action();
        $nowUrl     = $module . '/' . $controller . '/' . $action;

        $access     = my_model('AuthRule', 'logic', 'admin')->hasAccessByName($nowUrl,  $result['msg']['UnitNo']);
        //返回 true || false
        if (!$access) {
            ajax_return_error('无权访问！');
        }

    }

}
