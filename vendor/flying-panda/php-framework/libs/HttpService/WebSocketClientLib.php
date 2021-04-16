<?php

namespace Libs\HttpService;

use Libs\Client\ClientLib;
use Swoole\Http\Request;
use Swoole\Http\Response;

class WebSocketClientLib extends ClientLib
{
    public $service;
    public string $clientID;

    function __construct($clientID, $service)
    {
        $this->clientID = $clientID;
        $this->service = $service;
    }

    function sendMessage($message)
    {
        $this->service->push($this->clientID, $message);
    }
} 