<?php


namespace Libs\Client;


use Libs\Auth\AuthLib;

abstract class ClientLib
{
    public string $clientID = "";

    abstract function sendMessage($message);

    function send($message)
    {
        $this->SendMessage(json_encode($message));
    }

    /**
     * @return string
     */
    public function getClientID(): string
    {
        return $this->clientID;
    }


    public function setClientID(string $clientID)
    {
        $this->clientID = $clientID;
        return $this;
    }
}