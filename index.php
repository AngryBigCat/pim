<?php

/* 
require_once __DIR__.'./vendor/autoload.php';

$im = new Pim\Base\IMWebSocket();

$im::run();
*/

class Factory
{
    private static $instance;

    public static function create($type)
    {
        if (is_null(self::$instance)) {
            switch ($type) {
                case 'websocket':
                    self::$instance = new Swoole\WebSocket\Server("0.0.0.0", 9501);
                    break;
                default:
                    throw new Exception('connetion failed...');
            }
        }

        return self::$instance;
    }
}


$server = Factory::create('websocket');
/* 
$server->set([
    'worker_num' => 4,    // worker process num
    'backlog' => 128,     // listen backlog
    'max_request' => 50,
    'dispatch_mode'=> 1,
    'log_file' => ''
]);
 */

$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});


$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();

