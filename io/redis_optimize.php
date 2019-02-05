<?php

class AysRedis
{
    const HOST = '127.0.0.1';
    const PORT = 6379;
    public $redis_client = null;

    function __construct()
    {
        $this->redis_client = new swoole_redis;
    }

    /**
     * 闭包里不好直接用变量,要用use
     * @return bool
     */
    public function execute($id, $username)
    {
        $this->redis_client->connect(self::HOST, self::PORT, function ($redis_client, $result) use ($id, $username) {
            if ($result === false) {
                var_dump($redis_client->connect_errno, $redis_client->connect_error);
                die;
            }
            var_dump('wawa');
            //设置值
            $redis_client->set('wawa', time(), function (swoole_redis $redis_client, $result){
                //设置是否成功的返回值
                var_dump($result);
            });
            //取值
            $redis_client->get('wawa', function (swoole_redis $redis_client, $result){
                var_dump($result);
            });
            //取所有值
            $redis_client->keys('*', function (swoole_redis $redis_client, $result){
                var_dump($result);
            });
            //模糊匹配KEY
            $redis_client->keys('*l*', function (swoole_redis $redis_client, $result){
                var_dump($result);
            });
            $redis_client->close();

        });
        return true;
    }

}

$ws = new AysRedis();
$result = $ws->execute(1, 'test');
print_r($result.PHP_EOL);
echo 'start:'.PHP_EOL;
