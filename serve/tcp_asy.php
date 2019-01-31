<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2019/1/31
 * Time: 16:58
 */
$serv = new swoole_server("0.0.0.0",9501);

$serv->set(array('task_worker_num'=>4));

//投递异步任务
$serv->on("receive",function ($serv,$fd,$from_id,$data){
    $task_id = $serv->task($data);
    echo "异步 ID：　$task_id\n";
});

//处理异步任务
$serv->on('task',function ($serv,$task_id,$from_id,$data){
   echo "执行 异步ID： $task_id";
   $serv->finish("$data -> OK");
});


//处理结果
$serv->on('finish',function ($serv,$task_id,$data){
    echo "执行成功";
});

$serv->start();