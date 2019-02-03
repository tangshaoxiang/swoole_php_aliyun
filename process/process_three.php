<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2019/2/4
 * Time: 0:50
 */
$workers = [];
$worker_num = 2;

for ($i=0;$i<$worker_num;$i++){
    $process = new swoole_process('doProcess',false,false); //进程间通讯，第三个参数需要设为flase;创建子进程完成
    $process->useQueue(); //开启队列，类似于全局函数
    $pid = $process->start();
    $workers[$pid] = $process;
}

function doProcess(swoole_process $process){
    $recv = $process->pop();
    echo "从主进程获取数据：$recv \n";
    sleep(5);
    $process->exit(0);
}

//主进程  向子进程添加数据
foreach ($workers as $pid => $process){
    $process->push("Hello 子进程 $pid \n");
}

//等待 子进程结束 回收资源
for($i=0;$i<$worker_num;$i++){
    $ret = swoole_process::wait(); //等待执行完成
    $pid = $ret['pid'];
    unset($workers[$pid]);
    echo "子进程退出 $pid \n";
}