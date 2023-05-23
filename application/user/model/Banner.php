<?php

namespace app\user\model;

use \think\Model;
use \think\Db;

/**
 * 管理员相关操作
 */
class Banner extends Model
{
    /** banner
     * @没有参数
     */
    public function getBanner()
    {
        return Db::name('banner')->select();
    }

}
