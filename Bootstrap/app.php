<?php

use Manage\ApplicationManage;

require __DIR__ . '/../vendor/autoload.php';

if (!empty($argv[1])) {
    ApplicationManage::$config = $argv[1];
}

ApplicationManage::start();
