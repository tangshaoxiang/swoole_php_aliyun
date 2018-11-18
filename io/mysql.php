<?php
/**
 * Created by PhpStorm.
 * User: Ty_Ro
 * Date: 2018/11/18
 * Time: 17:21
 */
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
     *  mysql 执行逻辑
     * @param $id
     * @param $username
     * @return bool
     */
    public function execute($id,$username){
        $this->mysql->connect($this->config,function ($mysql,$result){
            if($result===false){
                var_dump($mysql->connect_errno);
                die;
            }
        });

        $sql = 'select * from test where id = '.$id;
        return $sql;
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
