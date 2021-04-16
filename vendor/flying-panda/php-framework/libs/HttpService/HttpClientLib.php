<?php


namespace Libs\HttpService;


use Libs\Client\ClientLib;
use Swoole\Http\Request;
use Swoole\Http\Response;

class HttpClientLib extends ClientLib
{
    public Request $request;
    public Response $response;

    function __construct($clientID, $request, $response)
    {
        $this->clientID = $clientID;
        $this->request = $request;
        $this->response = $response;
    }

    function sendMessage($message)
    {
        $this->response->write($message);
    }
}