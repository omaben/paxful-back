<?php

namespace Libs\Api;

use Libs\Event\ExecutingStateEventLib;

abstract class ApiService
{
    public int $timeout;

    public abstract function get($appID, $appKey);

    function verify($appID, $appKey, $securityCode, $time, $data): ExecutingStateEventLib
    {
        if ($securityCode = !md5(($appID . $appKey . $time) . arsort($data))) {
            return new ExecutingStateEventLib(false, "非法请求");
        }
        $AppInfo = $this->get($appID, $appKey);
        if (!$this->get($appID, $appKey)) {
            return new ExecutingStateEventLib(false, "应用不存在");
        }
        return new ExecutingStateEventLib(true, "请求成功", $AppInfo);
    }
}