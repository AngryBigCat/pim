<?php

namespace Pim;

use Swoole\Websocket\Server;
use Pim\Helper\Config;

class Main {
    private static $server;

    public static function run()
    {
        $host = Config::get('host');
        $port = Config::get('port');

        if (is_null(self::$server)) {
            self::$server = new Server($host, $port);
        }

        self::$server->set([
            'worker_num' => 4,
            'backlog' => 128,
            'max_request' => 50,
            'dispatch_mode'=> 1,
            'log_file' => ''
        ]);

        self::$server->on('open', [self::$server, 'onOpen']);
        self::$server->on('message', [self::$server, 'onMessage']);
        self::$server->on('close', [self::$server, 'onClose']);

        self::$server->start();
    }

    private function onOpen(Server $server, $request)
    {

        echo "server: handshake success with fd{$request->fd}\n";

        // 连接成功时 需要生成客户端ID  并保存在内存表中 然后返回给客户端 客户端每次发送消息的时候需要携带token
    
        // 将生成好的ID 保存在内存表中
    
        // 返回给连接成功的客户端 每个token
    
        if ($server->isEstablishd($request->fd)) {
            
        }
    }

    /* 
        $message_data = [
            'type' => 'single',
            'to_id' => 'token'
            'data' => 'asdasdsad',
        ] 
    */
    private function onMessage(Server $server, $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

        // 每次接收到客户端消息时 需要校验是否传递了token 并且在内存表中是否有token

        // 

        $data = $frame->data;


        $format_data = json_decode($data, true);

        $type = $data['type'];

        $protocol = new DataProtocol();

        switch ($protocol->getType();) {
            case PUSH_TYPE_SINGLE:
                new SinglePush();
            break;
            case PUSH_TYPE_GROUP:
                new GroupPush();
            break;
            case PUSH_TYPE_BROADCAST:
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

    private function onClose(Server $server, $frame)
    {
        echo "client {$fd} closed\n";
    }
}
   