<?php

namespace app\user\logic;

use think\Model;
use think\Db;
use app\common\CommonConstant;
use app\common\util\JwtUtil;

/**
 * Class user 
 * xiegaolei
 * @package app\user\model
 */
class Banner extends Model
{

    /** 显示banner图
     * 没有参数
     */
    public function getBanner()
    {
        return my_model('Banner', 'model', 'user')->getBanner();
    }


}