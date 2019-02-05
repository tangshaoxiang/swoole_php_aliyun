<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2019/2/5
 * Time: 15:56
 */
$ws =  new swoole_websocket_server("0.0.0.0",9502);

$ws->on('open',function ($ws,$request){
   echo "新用户 $request->fd 加入.\n";
   $GLOBALS['fd'][$request->fd]['id']=$request->fd;
   $GLOBALS['fd'][$request->fd]['name'] = '用户';
});

$ws->on('message',function ($ws,$request){
   $msg = $GLOBALS['fd'][$request->fd]['name'].":".$request->data."\n";
   if(strstr($request->data,"#name#")){
       $GLOBALS['fd'][$request->fd]['name'] = str_replace("#name#",'',$request->data);
   }else{
       foreach ($GLOBALS['fd'] as $i){
           $ws->push($i['id'],$msg);
       }
   }
});

$ws->on('close',function ($ws,$request){
   echo "客户端-{$request} 断开连接\n";
   unset($GLOBALS['fd'][$request]);
});

$ws->start();