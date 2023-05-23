<?php

namespace app\admin\controller;

use app\common\util\UploadUtil;

/**
 * 上传
 * @author hardphp@163.com
 */
class Upload extends \think\Controller
{
    public function _initialize()
    {
        //跨域访问
        if (config('app_debug') == true) {
            header("Access-Control-Allow-Origin:*");
            // 响应类型
            header("Access-Control-Allow-Methods:GET,POST");
            // 响应头设置
            header("Access-Control-Allow-Headers:x-requested-with,content-type,x-access-token,x-access-appid");
        }
    }

    //上传图片
    public function upimage()
    {
        $filename = input('filename', '', 'trim');
        if (empty($filename)) {
            ajax_return_error('参数错误');
        }
        $url = uploadUtil::upimage($filename);
        $url = request()->domain().$url;
        ajax_return_ok(['url' => $url]);
    }

    //上传图片
    public function upimageavue()
    {
        $post = request()->file();
        if (empty($post)) {
            ajax_return_error('参数错误');
        }
        $url = uploadUtil::avueupimage();
        $url = request()->domain().$url;
        ajax_return_ok(['url' => $url]);
    }

    //上传文件
    public function upfile()
    {
        $filename = input('filename', '', 'trim');
        if (empty($filename)) {
            ajax_return_error('参数错误');
        }
        $url = uploadUtil::upfile($filename);
        $url = request()->domain().$url;
        ajax_return_ok(['url' => $url]);
    }

    //富文本上传图
    public function upimageWangeditor($result = [], $urleditor = [])
    {
        $post = request()->file('file');
        if (empty($post)) {
            ajax_return_error('参数错误');
        }
        $url = uploadUtil::upimageWangeditor();
        // 图片地址
        $urleditor = request()->domain().$url['url'];
        // {
        //     "errno": 0, // 注意：值是数字，不能是字符串
        //     "data": {
        //         "url": "xxx", // 图片 src ，必须
        //         "alt": "yyy", // 图片描述文字，非必须
        //         "href": "zzz" // 图片的链接，非必须
        //     }
        // }
        $result['errno'] = 0;
        $result['data']   = array('url'=>$urleditor, 'alt'=>$url['img'], 'href'=> $urleditor);
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($result));
    }
}
