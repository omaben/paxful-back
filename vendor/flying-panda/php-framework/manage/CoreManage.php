<?php

namespace Manage;

use Libs\Auth\AuthManageLib;
use Libs\Control\ControlLib;
use Libs\DataSource\Interfaces\DataSource;
use Libs\Event\EventLib;
use Libs\HttpService\HttpServiceLib;
use Libs\MySql\MySqlLib;
use Libs\Redis\RedisLib;
use Libs\Service\ServiceLib;
use Logger;

class CoreManage
{
    public static HttpServiceLib $service;
    /**
     * @var MySqlLib
     */
    public static MySqlLib $coreDataBase;
    /**
     * @var ControlLib[]
     */
    public static array $serviceEvent = [];
    /**
     * @var RedisLib
     */
    public static RedisLib $redis;
    /**
     * @var Logger
     */
    public static Logger $log;

    public static DataSource $dataSource;

    public static array $config = [];

    /**
     * @var AuthManageLib[]
     */
    public static array $authManageLib;

    /**
     * @return array<AuthManageLib>
     */
    public static function getAuthManageLib(): array
    {

        return self::$authManageLib;

    }

    /**
     * @param array $authManageLib
     */
    public static function setAuthManageLib(array $authManageLib): void
    {
        self::$authManageLib = $authManageLib;
    }

    public static function addAuthManageLib(AuthManageLib $authManageLib): void
    {
        self::$authManageLib[$authManageLib->getPre()] = $authManageLib;
    }

    static function init()
    {
        self::$log = Logger::getLogger('main');
        self::$log->info('CoreManage：加载成功');
    }

    public static function push($list, $message)
    {
        self::$service->push($list, $message);
    }
}

CoreManage::init();
