<?php

namespace Libs\WebSocketService;

use Libs\HttpService\HttpClientLib;
use Manage\CoreManage;

class WebSocketServiceLib
{
    function __construct($url, $port)
    {
        $ws = new Swoole\WebSocket\Server('0.0.0.0', 9502);
        $ws->on('open', function ($server, $req) {
            echo "connection open: {$req->fd}\n";
        });

        $ws->on('message', function ($server, $frame) {
            echo "received message: {$frame->data}\n";
            $this->Service($server, $frame, json_decode($frame->data));
        });

        $ws->on('close', function ($server, $fd) {
            echo "connection close: {$fd}\n";
        });

        $ws->start();
    }

    function Service($server, $frame, $data)
    {
        $service = CoreManage::$ServiceEvent[$data['service']];
        $service->setClient(new WebSocketClientLib($frame, $server));
        $service->getAuthAction()->Run($service);
        $service->runAction($data['service'], $data);
    }
}