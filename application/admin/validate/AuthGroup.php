<?php

namespace app\admin\validate;

use \think\Validate;

/**
 * 规则
 */
class AuthGroup extends Validate
{
    //验证规则
    protected $rule = [
        'jdName' => ['require'],
    ];

    //提示信息
    protected $message = [
        'jdName' => '名称必填',
    ];


}
