<?php


namespace Libs\Redis;

use Logger;
use Manage\CoreManage;
use Swoole\Coroutine\Redis;
use Swoole\Database\RedisConfig;
use Swoole\Database\RedisPool;

class RedisLib
{
    public RedisPool $read;
    public RedisPool $write;

    public function __construct($config)
    {
        $this->read = new RedisPool((new RedisConfig)
            ->withHost($config['read']['host'])
            ->withPort($config['read']['port'])
            ->withAuth($config['read']['auth'])
            ->withDbIndex(0)
            ->withTimeout(1)
        );
        $this->write = new RedisPool((new RedisConfig)
            ->withHost($config['write']['host'])
            ->withPort($config['write']['port'])
            ->withAuth($config['write']['auth'])
            ->withDbIndex(0)
            ->withTimeout(1)
        );
        CoreManage::$log->info("Redis:连接{$config['read']['host']}成功");
        CoreManage::$log->info("Redis:连接{$config['write']['host']}成功");
    }

    public function get($key)
    {
        $redis = $this->read->get();
        $result = $redis->get($key);
        //var_dump($result);
        if (!empty($result)) {
            $result = json_decode($result);
        }
        $this->read->put($redis);
        return $result == false ? null : $result;
    }

    public function set($key, $value)
    {
        $redis = $this->write->get();
        $redis->set($key, json_encode($value));
        $this->write->put($redis);
    }

    public function push($key, $value)
    {
//        var_dump("lPush  ".$key);
        $redis = $this->write->get();
        $redis->lPush($key, json_encode($value));
        $this->write->put($redis);
        return true;
    }

    public function del($key)
    {
        $redis = $this->write->get();
        $redis->del($key);
        $this->write->put($redis);
    }

    public function lpop($key)
    {
        $redis = $this->read->get();
        $result = $redis->lpop($key);
        if (!empty($result))
            $result = json_decode($result[1]);
        $this->read->put($redis);
        return $result;
    }

    public function pop($key)
    {
        $redis = $this->read->get();
        $result = $redis->blPop($key, 10);
        if (!empty($result))
            $result = json_decode($result[1]);
        $this->read->put($redis);
        return $result;
    }

    public function lrange($key, $start = 0, $end = -1)
    {
        $redis = $this->read->get();
        $result = $redis->lrange($key, $start, $end);
        $this->read->put($redis);
        return $result;
    }

    public function incr($key)
    {
        $redis = $this->write->get();
        $redis->INCR($key);
        $this->write->put($redis);
    }

    public function lRem($key, $value, $index = -1)
    {
        $redis = $this->write->get();
        $redis->lRem($key, $value, 2);
        $this->write->put($redis);
    }
}