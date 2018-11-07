<?php
//$client = new swoole_client(SWOOLE_SOCK_UDP);
//if (!$client->connect('127.0.0.1', 9502, -1))
//{
//    exit("connect failed. Error: {$client->errCode}\n");
//}
////php cli常量
//fwrite(STDOUT,"请输入消息:");
//$msg = trim(fgets(STDIN));
//$client->send($msg);
//echo $client->recv();
//$client->close();

$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on("connect", function($cli) {
    $cli->send("hello world\n");
});
$client->on("receive", function($cli, $data){
    echo "received: {$data}\n";
});
$client->on("error", function($cli){
    echo "connect failed\n";
});
$client->on("close", function($cli){
    echo "connection close\n";
});
$client->connect("127.0.0.1", 9502, 0.5);