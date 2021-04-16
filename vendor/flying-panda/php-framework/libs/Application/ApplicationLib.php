<?php

namespace Libs\Application;

use Libs\Auth\AuthManageLib;
use Libs\Event\EventLib;
use Libs\File\FileLib;
use Libs\HttpService\HttpServiceLib;
use Libs\MySql\MysqlDataSource;
use Libs\MySql\MySqlLib;
use Libs\Redis\RedisLib;
use Libs\Service\ServiceLib;
use Manage\CoreManage;

class ApplicationLib
{
    public static string $config = 'default';
    /**
     * 启动事件
     * @var EventLib
     */
    public static EventLib $onStartEvent;

    public static EventLib $onBeforeStartEvent;

    /**
     * @var EventLib[]
     */

    public static function init()
    {
        self::$onStartEvent = new EventLib();
        self::$onBeforeStartEvent = new EventLib();
    }
    /**
     * 启动
     */
    public static function start()
    {
        self::load();
        $Service = new HttpServiceLib(CoreManage::$config['http']['host'], CoreManage::$config['http']['port']);
        CoreManage::$dataSource = new MysqlDataSource();
        CoreManage::$service = $Service;
        $Service->Start(function () {
            self::$onBeforeStartEvent->Run([]);
            CoreManage::$redis = new RedisLib(CoreManage::$config['redis']);
            CoreManage::$coreDataBase = new MySqlLib(CoreManage::$config['dataBase']);
            self::$onStartEvent->Run([]);
            CoreManage::$log->info('线程启动成功');
        });
    }

    public static function load()
    {
        $ModuleList = FileLib::getDirList(
            dirname(get_included_files()[0]) . '/../Application'
        );

        foreach ($ModuleList as $Module) {
            if (file_exists($Module . '/Register')) {
                $FileList = FileLib::getFileList($Module . '/Register');
                foreach ($FileList as $File) {
                    require_once $File;
                }
            }
        }

        $FileList = FileLib::getFileList(dirname(get_included_files()[0]) . '/../Config');
        foreach ($FileList as $File) {
            $result = yaml_parse_file($File);
            if (is_array($result)) {
                CoreManage::$config = array_merge_recursive(CoreManage::$config, $result);
            }
        }
    }
}
