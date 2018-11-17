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
//    异步文件写入
        $file_content = [
            'data' => date('Y-m-d H:i:s'),
            'get' => $request->get,
            'post' => $request->post,
            'header' => $request->header,
        ];
        swoole_async_writefile(__DIR__.'/access.log', json_encode($file_content).PHP_EOL, function($filename) {
            echo $filename.":wirte ok.\n";
        }, FILE_APPEND);

    $response->end("love".json_encode($request->get));
});
$http->start();