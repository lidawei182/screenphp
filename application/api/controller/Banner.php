<?php

namespace app\api\controller;
/**
 * 登陆
 * @author hardphp@163.com
 */
class Banner extends Base
{
    /**
     * 手机号登录
     */
    public function index()
    {
        if ($this->request->isPost()) {

           $result = my_model('Banner', 'logic', 'user')->getBanner();

            ajax_return_ok($result, '登录成功');
        }
    }

}
