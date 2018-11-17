<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/17
 * Time: 16:42
 */
$file_content = '佛冷';
swoole_async_writefile(__DIR__.'/test.log', $file_content.PHP_EOL, function($filename) {
    echo $filename."wirte ok.\n";
}, FILE_APPEND);