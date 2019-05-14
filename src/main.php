<?php

namespace Pim;

use Swoole\Websocket\Server;
use Pim\Helper\Config;
use Pim\Base\Protocol;
use Pim\Enums\PushType;
use Pim\Table\OnlineTable;

class Main
{
    private static $server;

    public static function run()
    {
        $host = Config::get('host');
        $port = Config::get('port');

        if (is_null(self::$server)) {
            self::$server = new Server($host, $port);
        }
        /* 
        self::$server->set([
            'worker_num' => 4,
            'backlog' => 128,
            'max_request' => 50,
            'dispatch_mode'=> 1,
            'log_file' => ''
        ]);
         */
        self::$server->on('open', ['Pim\Main', 'onOpen']);
        self::$server->on('message', ['Pim\Main', 'onMessage']);
        self::$server->on('close', ['Pim\Main', 'onClose']);

        OnlineTable::init();

        self::$server->start();
    }

    public function onOpen(Server $server, $request)
    {

        echo "server: handshake success with fd{$request->fd}\n";

        echo json_encode($request); 

        // 连接成功时 需要生成客户端ID  并保存在内存表中 然后返回给客户端 客户端每次发送消息的时候需要携带token
    
        // 将生成好的ID 保存在内存表中
    
        // 返回给连接成功的客户端 每个token

        // 检查是否有未推送的消息, 如果有的话即按时间顺序逐条推送， 适用于single group
    
    }

    /* 
        $message_data = [
            'from_id' => 1,
            'target_id' => 2,
            'type' => 'single',
            'data' => 'asdasdsad',
        ] 
    */
    public function onMessage(Server $server, $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

        // 每次接收到客户端消息时 需要校验是否传递了token 并且在内存表中是否有token

        // 

        $data = new Protocal($frame->data);

        switch ($protocol->getType()) {
            case 'login':
                if (empty(OnlineTable::get($data['target_id'])) {
                    OnlineTable::set($data['target_id'], [
                        'target_id' => $data['target_id'],
                        'fd' => $frame->fd;
                    ]);
                };
            break;
            case PushType::Single:
                $target = OnlineTable::findTarget($data['target_id']);
                if ($server->exist($target['fd'])) {
                    $server->push($target['fd'], $protocol->getData());
                }
            break;
            case PushType::Group:
                $group = Table::findGroup($protocol['to_id']);

                $targets = $group['targets'];

                foreach ($targets as $target) {
                    
                }
                
                new GroupPush();
            break;
            case PushType::Broadcast:
                new BroadcastPush();
            break;
        }


        // 单推送
        // $server->push($frame->fd, "this is server");

        // 群推送
        foreach ($server->connections as $fd) {
            if ($server->isEstablished($fd)) {
                $server->push($fd, $frame->data);
            }
        }
    }

    public function onClose(Server $server, $frame)
    {
        echo "client {$fd} closed\n";
    }
}
   