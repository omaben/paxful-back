<?php


namespace Libs\Log;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogLib
{
    static function debug(string $name, $content)
    {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));
    }

    static function info(string $name, $content)
    {

    }

    static function error(string $name, $content)
    {

    }

    static function warning(string $name, $content)
    {

    }

    static function write(string $url, string $content)
    {
    }
}