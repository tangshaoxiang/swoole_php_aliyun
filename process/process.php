<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/18
 * Time: 22:51
 */
$process = new swoole_process(function (swoole_process $process) {
    echo 'hello';
    $process->exec('/usr/local/php/bin/php',[__DIR__.'/../serve/http_server.php']);
}, false);
$pid = $process->start();
echo 'pid:'.$pid.PHP_EOL;
$process->wait();


