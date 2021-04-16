<?php

namespace Application\User\Result;

use Libs\Control\ControlResultDataLib;
use Libs\Control\ControlResultLib;

class UserLoginRequest extends ControlResultDataLib
{
    //用户名
    public string $userName;
    //密码
    public string $userPassword;

    /**
     * @return array
     */
    function getRule(): array
    {
        return [];
    }

    function getPermission(): array
    {
        return [];
    }

    function action(): ControlResultLib
    {
        return \UserResult::loginSuccess($this->getResult());
    }
}
