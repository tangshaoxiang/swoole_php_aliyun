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



/**
 * 读取文件
 * __DIR__
 */
//$result = Swoole\Async::readfile(__DIR__."/1.txt", function($filename, $fileContent) {
//    echo "filename:".$filename.PHP_EOL;  // \n \r\n
//    echo "content:".$fileContent.PHP_EOL;
//});
//
//var_dump($result);
//echo "start".PHP_EOL;