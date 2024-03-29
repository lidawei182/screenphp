<?php

namespace app\admin\validate;

use \think\Validate;

/**
 * 管理员
 */
class User extends Validate
{
    //验证规则
    protected $rule = [
        'userName' => ['require'],
        'password' => ['require'],
        'phone'    => ['regex' => '/1[3458]{1}\d{9}$/'],
        'verify'   => ['require', 'captcha']
    ];

    //提示信息
    protected $message = [
        'userName.require' => '账号必须',
        'userName.max'     => '账号最多不能超过25个字符',
        'userName.alpha'   => '账号必须是字母',
        'password'         => '密码必须',
        'phone.regex'      => '手机格式错误',
        'email'            => '邮箱格式错误',
        'verify.require'   => '验证码必须',
        'verify.captcha'   => '验证码错误'
    ];

    //验证场景
    protected $scene = [
        'login' => ['userName', 'password'],
        'save'  => ['userName', 'phone'],
        'modify'  => ['phone', 'email'],
    ];


}
