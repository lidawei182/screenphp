<?php

namespace app\push\controller;

use think\worker\Server;

use Workerman\Worker;
use Workerman\Lib\Timer;

require_once("Connection.php");

class Push extends Server
{
    protected $socket = 'websocket://127.0.0.1:2346';

    /**
     * @param $connection
     * @param $data
     * @throws \Exception
     */
    public function onMessage($connection, $data)
    {
        // 客户端传递的是json数据
        $message_data = json_decode($data, true);
        if(!$message_data)
        {
            return ;
        }
        // 根据类型执行不同的业务
        switch($message_data['type'])
        {
            // 客户端回应服务端的心跳
            case 'pong':
                $worker = $this->worker;
                    foreach($worker->connections as $conn)
                    {
            $message_data['text'] ? $message_type['data']['text'] = $message_data['text'] : $message_type['data']['text'] = '';
                        $message_type['data']['client_name'] = $message_data['client_name'];
                        $message_type['data']['room_id'] = $message_data['room_id'];
                        $message_type['data']['avatar'] = $message_data['avatar'];
                        $message_type['type'] = 'pong';
                        $message_type['status'] = "ok";
                        $message_type['list'] = [];
                        $message_type['msg'] = "成功";
                        $conn->send(json_encode($message_type));
                    }
                return ;        
            
            // 客户端登录 message格式: {type:login, name:xx, room_id:1} ，添加到客户端，广播给所有客户端xx进入聊天室
            case 'login':
            	if(!isset($message_data['room_id']))
                {
                    throw new \Exception("\$message_data['room_id'] not set. client_ip:{$_SERVER['REMOTE_ADDR']} \$message:$message");
                }
                // 判断当前客户端是否已经验证,即是否设置了uid
                if(!isset($connection->uid))
			    {
			       // 没验证的话把第一个包当做uid（这里为了方便演示，没做真正的验证）
			       $connection->uid = $message_data['client_name'];
			       /* 保存uid到connection的映射，这样可以方便的通过uid查找connection，
			        * 实现针对特定uid推送数据
			        */
			    	$worker = $this->worker;
			    	foreach($worker->connections as $conn)
				    {
                        if($message_data['text']){
                            $message_type['text'] = $message_data['text'];
                        }
                        $message_type['type'] = 'login';
                        $message_type['status'] = "ok";
                        $message_type['list'] = [];
                        $message_type['msg'] = $message_data['client_name']."登陆成功";
				        $conn->send(json_encode($message_type));
				    }
			    }

            case 'say':
               
               	return;
        }
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {

    }
    /**
	 * 向所有验证的用户发送消息
     */
    public function sendAllMessage(){
    	global $worker;
	   	foreach($worker->uidConnections as $connection)
	   	{

	    	$connection->send($message);
	   	}
    }
    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     * https://www.workerman.net/doc/workerman/components/workerman-mysql.html
     */
    public function onWorkerStart()
    {

        $worker = $this->worker;
        Timer::add(2,function()use($worker){
            foreach($worker->connections as $conn)
            {
                global $db;

                $db = new \Workerman\MySQL\Connection('127.0.0.1', '3306', 'root', 'root', 'tp5qpi');

                $result = $db->select('*')->from('tp_user')->query();

                if($result){
                    $obj_data['list'] = $result;
                    $obj_data['type'] = "push";
                    $obj_data['status'] = "ok"; 
                    $obj_data['msg'] = "成功";                  
                }else{
                    $obj_data['status'] = "on";
                    $obj_data['msg'] = "加载失败";
                }

                $conn->send(json_encode($obj_data));
            }
        });
    }
}