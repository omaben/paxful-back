<?php

namespace Libs\Auth;

use Libs\Control\ControlResultDataLib;
use Libs\Control\ControlResultLib;

class AuthRegisterRequestLib
{
    //用户名
    public string $userName;
    //密码
    public string $userPassword;
    //代理
    public string $agency;
    //代理用户
    public string $agencyUser;


    static function registrationSuccess(): ControlResultLib
    {
        return new ControlResultLib(
            true,
            'RegistrationSuccess'
        );
    }

    static function UserNameAlreadyExists(): ControlResultLib
    {
        return new ControlResultLib(
            true,
            'UserNameAlreadyExists'
        );
    }
}
