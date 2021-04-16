<?php


namespace Libs\Redis;


use Manage\CoreManage;

class RedisManageLib
{
    public string $pre = "";

    function __construct($pre)
    {
        $this->pre = $pre;
    }

    function get($name)
    {
        return CoreManage::$redis->get($this->pre . '.' . $name);
    }

    function set($name, $val)
    {
        CoreManage::$redis->set($this->pre . '.' . $name, $val);
    }

    public function push($name, $value)
    {
        CoreManage::$redis->push($this->pre . '.' . $name, $value);
    }

    public function del($name)
    {
        CoreManage::$redis->del($this->pre . '.' . $name);
    }

    public function lpop($name)
    {
        CoreManage::$redis->lpop($this->pre . '.' . $name);
    }

    public function pop($name)
    {
        CoreManage::$redis->pop($this->pre . '.' . $name);
    }

    public function lrange($name, $start = 0, $end = -1)
    {
        CoreManage::$redis->lrange($this->pre . '.' . $name, $start, $end);
    }

    public function incr($name)
    {
        CoreManage::$redis->incr($this->pre . '.' . $name);
    }

    public function lRem($name, $value, $index = -1)
    {
        CoreManage::$redis->lRem($name, $value, $index);
    }
}