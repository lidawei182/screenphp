<?php

namespace app\push\controller;

use think\worker\Server;

use Workerman\Worker;
use Workerman\Lib\Timer;

require_once("Connection.php");

class Push extends Server
{

    //protected $socket = 'websocket://www.mmcall.test.net:7003';

    //protected $socket = 'websocket://www.mmcall.net:7003';
    
    protected $socket = 'websocket://0.0.0.0:7003';

    public $messagepush = '';

    /**
     * @param $connection
     * @param $data
     * @throws \Exception
     */
    public function onMessage($connection, $data)
    {
        // 客户端传递的是json数据
        $message_data = json_decode($data, true);

        $this->messagepush = json_decode($data, true);

        if(!$message_data)
        {
            return ;
        }
        // 根据类型执行不同的业务
        switch($message_data['type'])
        {        
            // 客户端登录 message格式: {type:login, name:xx, room_id:1}
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
                        $message_type['type'] = $this->messagepush;
                        $message_type['room_id'] = $message_data['room_id'];
                        $message_type['client_name'] = $message_data['client_name'];
                        $message_type['status'] = "ok";
                        $message_type['list'] = [];
                        $message_type['msg'] = $message_data['client_name']."登陆成功";
				        $conn->send(json_encode($message_type));
				    }
			    }

            break;

            case 'push':

                $worker = $this->worker;

                Timer::add(2,function()use($worker){
                    foreach($worker->connections as $conn)
                    {

                        global $db;

                        $calllist = $db->query(
                            "SELECT c.*,d.No,d.oldmanname,d.Address FROM `t_tree` AS a
                            LEFT JOIN `t_tree_device` AS b
                            ON a.`jdno` = b.`jdParent`
                            LEFT JOIN `t_calllist_voice` AS c
                            ON b.`deviceid` = c.`deviceid`
                            LEFT JOIN `t_people` AS d
                            ON c.`deviceid` = d.`deviceno`
                            WHERE a.`jdno` = ".$this->messagepush['room_id']." AND c.status <> '挂断' AND d.oldmanname <> '' order by c.`calltime` DESC"
                        );

                        $calllistTotal = $db->query(
                            "SELECT COUNT(*) total FROM `t_tree` AS a
                            LEFT JOIN `t_tree_device` AS b
                            ON a.`jdno` = b.`jdParent`
                            LEFT JOIN `t_calllist_voice` AS c
                            ON b.`deviceid` = c.`deviceid`
                            LEFT JOIN `t_people` AS d
                            ON c.`deviceid` = d.`deviceno`
                            WHERE a.`jdno` = ".$this->messagepush['room_id']." AND c.status <> '挂断' AND d.oldmanname <> ''"
                        );

                        if($calllist){
                            $obj_data['list'] = $calllist;
                            $obj_data['total'] = $calllistTotal;
                            $obj_data['type'] = "push";
                            $obj_data['status'] = "ok";
                            $obj_data['msg'] = "成功";                  
                        }else{
                            $obj_data['type'] = "push";
                            $obj_data['status'] = "on";
                            $obj_data['msg'] = "加载失败";
                        }

                        $conn->send(json_encode($obj_data));
                    }
                });

            break;
             
            default:
        }

    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {
        global $db; 

        //$db = new \Workerman\MySQL\Connection('127.0.0.1', '3306', 'root', 'root', 'yunmmcall_big');
        $db = new \Workerman\MySQL\Connection('47.104.10.49', '3306', 'root', '3a1A2110-AcDe+4C3a-944e?3fe4af7fabD2', 'yunmmcall_big');
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


    }
}