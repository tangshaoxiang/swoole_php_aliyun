<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('192.168.16.123', 9501, -1))
{
    exit("connect failed. Error: {$client->errCode}\n");
}
//php cli常量
fwrite(STDOUT,"请输入消息:");
$msg = trim(fgets(STDIN));
$client->send($msg);
echo $client->recv();
//$client->close();