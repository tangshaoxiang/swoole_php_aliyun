<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501, -1))
{
    exit("connect failed. Error: {$client->errCode}\n");
}
//php cli����
fwrite(STDOUT,"��������Ϣ:");
$msg = trim(fgets(STDIN));
$client->send($msg);
echo $client->recv();
//$client->close();