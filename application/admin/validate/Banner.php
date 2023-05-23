<?php

namespace app\admin\validate;

use \think\Validate;

/**
 * 规则
 */
class AuthRule extends Validate
{
    //验证规则
    protected $rule = [
        'img'     => ['require']
    ];

    //提示信息
    protected $message = [
        'img'     => 1,
    ];

    //验证场景
    protected $scene = [
        'save'  => ['img']
    ];

}
