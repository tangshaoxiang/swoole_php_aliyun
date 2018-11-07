<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/8
 * Time: 0:09
 */
$http = new swoole_http_server("0.0.0.0",8811);
//$http->set(
//    [
//        'enable_static_handler'=>true,
//        'document_root'=>"/home/wwwroot/default/swoole_thinkphp5/swoole_php_aliyun/data"
//    ]
//);
$http->on('request', function ($request, $response) {
    $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
});
$http->start();