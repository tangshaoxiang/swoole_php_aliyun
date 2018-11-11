<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/11
 * Time: 22:48
 */
$server = new swoole_websocket_server("0.0.0.0", 8812);

$server->set(
    [
        'enable_static_handler'=>true,
        'document_root'=>"/home/wwwroot/www.darian.xin/swoole_php_aliyun/data"
    ]
);

$server->on('open', function (swoole_websocket_server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});

$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();