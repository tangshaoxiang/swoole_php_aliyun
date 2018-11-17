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

        $this->ws->set(
            [
                'worker_num'=>2,
                'task_worker_num'=>2
            ]
        );

        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('task',[$this,'onTask']);
        $this->ws->on('finish',[$this,'onFinish']);
        $this->ws->on('close',[$this,'onClose']);

        $this->ws->start();
    }

    /**
     * 监听连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws,$request){

        var_dump($request->fd);

//        定时任务
        $timer = swoole_timer_tick(2000, function($timer_id){
            echo "timeout:".$timer_id.PHP_EOL;
        });
        swoole_timer_after(10000,function () use ($timer) {
            echo '10s之后清除';
            swoole_timer_clear($timer);
        });

    }

    /**
     * 监听message消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws,$frame){
        echo $frame->data;
        $data =[
          'task' => 'task',
          'fd' =>$frame->fd
        ];
//        task任务
//        $ws->task($data);

//        定时任务
        swoole_timer_after(5000, function() use ($ws,$frame) {
            echo "fd:".$frame->fd.PHP_EOL;
            $ws->push($frame->fd,'5秒之后');
//            swoole_timer_clear(1);
        });
        $ws->push($frame->fd,'I love you');
    }

    public function onTask($ws, $task_id, $from_id, $data){
        echo "Tasker进程接收到数据";
        echo "#{$ws->worker_id}\nonTask: [PID={$ws->worker_pid}]: task_id=$task_id, data_len=".json_encode($data).".".PHP_EOL;
        sleep(10);
        return 'on task finish';

    }

    public function onFinish($ws, $task_id, $data){
        echo "Task#$task_id finished, data_len=".strlen($data).PHP_EOL;
        echo "{$data}";
    }

    public function onClose($ws,$fd){
        echo 'close:'.$fd;
    }
}

new Ws_optimize();