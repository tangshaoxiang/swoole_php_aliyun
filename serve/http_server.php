<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/8
 * Time: 0:09
 */
$http = new swoole_http_server("0.0.0.0",8811);
$http->set(
    [
        'enable_static_handler'=>true,
        'document_root'=>"/home/wwwroot/www.darian.xin/swoole_php_aliyun/data"
    ]
);
$http->on('request', function ($request, $response) {
    $response->end("love");
});
$http->start();