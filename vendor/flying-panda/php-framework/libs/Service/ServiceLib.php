<?php

namespace Libs\Service;

class ServiceLib
{
    private array $config = [];

    function __construct()
    {
    }

    function GetDataBase()
    {
        return 'live';
    }
}
