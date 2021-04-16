<?php

namespace Libs\Queue;

use Manage\CoreManage;
use Swoole\Runtime;

class QueueListen
{
    public string $name = "";
    public int $maxCount = 100;
    public int $lastTime = 0;
    public int $maxTime = 0;
    public $fun;
    public array $list;
    public bool $close = false;

    /**
     * QueueListen constructor.
     * @param string $name
     * @param int $maxCount
     * @param int $maxtime
     * @param $fun
     */
    public function __construct(string $name, int $maxCount, int $maxtime, $fun)
    {
        $this->name = $name;
        $this->maxCount = $maxCount;
        $this->maxTime = $maxtime;
        $this->fun = $fun;
        $this->list = array();
        $this->lastTime = time();

        //Runtime::enableCoroutine();
        go(function () {
            $this->listen();
        });
    }

    public function flush()
    {
        $this->close = false;
        $func = $this->fun;
        $func($this->list);
        $this->list = [];
    }

    public function listen()
    {

        $this->list = [];
        while (true && !$this->close) {

            $value = CoreManage::$redis->pop($this->name);
            if (!empty($value)) {
                $this->list[] = $value;
            }

            if (count($this->list) >= $this->maxCount ||
                (time() - $this->lastTime > $this->maxTime &&
                    count($this->list) > 0)) {
                $func = $this->fun;
                $func($this->list);
                $this->list = [];
            }
        }
    }
}