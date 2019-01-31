<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2019/1/31
 * Time: 16:03
 */
$serv = new swoole_http_server("0.0.0.0",9501);

$serv->on('request',function ($request,$response){
    var_dump($request);
    $response->header("Content-Type","text/html; charset=utf-8");
    $response->end("hello world".rand(100,999));
});
$serv->start();