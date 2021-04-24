<?php
use Core\AddressCore\Control\AddressCoreControl;

use Manage\ApplicationManage;

ApplicationManage::$onStartEvent->addEvent(function () {
    AddressCoreControl::getUserRegister();
});