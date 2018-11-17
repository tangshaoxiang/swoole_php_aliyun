<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/17
 * Time: 16:39
 */
//        异步读取文件内容
swoole_async_readfile(__DIR__."/1.txt", function($filename, $content) {
    echo "$filename: $content";
});