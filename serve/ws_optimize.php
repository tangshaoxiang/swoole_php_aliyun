<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/11
 * Time: 23:19
 */
/**
 * ws的优化
 */

class Ws_optimize{
    const HOST = '0.0.0.0';
    const PORT = '8812';
    public $ws = null;
    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST,self::PORT);
        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('close',[$this,'onClose']);
    }

    /**
     * 监听连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws,$request){
        var_dump($request->fd);
    }

    /**
     * 监听message消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws,$frame){
        echo $frame->data;
        $ws->push($frame->fd,'I love you');
    }

    public function onClose($ws,$fd){
        echo 'close:'.$fd;
    }
}

new Ws_optimize();