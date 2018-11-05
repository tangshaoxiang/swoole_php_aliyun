<?php
//����Server���󣬼��� 127.0.0.1:9501�˿�
$serv = new swoole_server("127.0.0.1", 9501); 

$serv->set([
    'worker_num' => 4,    //worker������   һ����cpu�ı���
    'max_request' => 1000      //���������
]);

//�������ӽ����¼�
//$fd  �ͻ������ӵ�Ψһ��ʶ
//$reactor_id   �߳�
$serv->on('connect', function ($serv, $fd,$reactor_id) {  
    echo "Client:{$reactor_id}-{$fd}-Connect.\n";
});

//�������ݽ����¼�
$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {
    $serv->send($fd, "Server: {$reactor_id}-{$fd}-".$data);
});

//�������ӹر��¼�
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//����������
$serv->start(); 