<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/18
 * Time: 19:19
 */
$client = new swoole_redis;
$client->connect('127.0.0.1', 6379, function (swoole_redis $client, $result) {
    if ($result === false) {
        echo "connect to redis server failed.\n";
        return;
    }
    $client->set('key', 'swoole', function (swoole_redis $client, $result) {
        var_dump($result);
    });
});