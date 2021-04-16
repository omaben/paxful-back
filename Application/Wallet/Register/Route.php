<?php


use Manage\ApplicationManage;

ApplicationManage::$onStartEvent->addEvent(function () {
    return 'hello';
});