<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/8
 * Time: 0:09
 */
$http = new swoole_http_server("0.0.0.0",8811);
$http->on('request', function ($request, $response) {
    $response->end("ssss");
});
$http->start();