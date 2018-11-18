<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/18
 * Time: 17:21
 */
$db = new swoole_mysql();
$server = array(
    'host' => '192.168.56.102',
    'port' => 3306,
    'user' => 'test',
    'password' => 'test',
    'database' => 'test',
    'charset' => 'utf8', //指定字符集
    'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
);

$db->connect($server, function ($db, $r) {
    if ($r === false) {
        var_dump($db->connect_errno, $db->connect_error);
        die;
    }
    $sql = 'show tables';
    $db->query($sql, function(swoole_mysql $db, $r) {
        if ($r === false)
        {
            var_dump($db->error, $db->errno);
        }
        elseif ($r === true )
        {
            var_dump($db->affected_rows, $db->insert_id);
        }
        var_dump($r);
        $db->close();
    });
});

class mysql{
    public $mysql = '';
    public $config = '';
    public function __construct()
    {
        $this->mysql = new swoole_mysql();
        $this->config = array(
            'host' => '106.14.14.231',
            'port' => 3306,
            'user' => 'root',
            'password' => 'root',
            'database' => 'swoole',
            'charset' => 'utf8', //指定字符集
        );
    }

    public function add(){

    }

    public function del(){

    }

    public function update(){

    }

    /**
     * mysql 执行逻辑
     * @param $id
     */
    public function execute($id,$username){
        $this->mysql->connect($this->config,function ($mysql,$result){
            if($result===false){
                var_dump($mysql->connect_errno);
                die;
            }
        });

        $sql = 'select * from test where id = '.$id;
        $this->mysql->query($sql,function ($db,$res){
            //$res   当为select时返回结果集，当为add,del,update时返回bool
            if($res==true){
                //todo
            }elseif($res==false){
                //todo
            }else{
                var_dump($res);
            }
        });

        return true;
    }


}

$dbsource = new mysql();
$dbsource->execute(1,'tang');
