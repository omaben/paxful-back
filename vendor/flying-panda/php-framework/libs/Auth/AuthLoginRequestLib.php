<?php

namespace Libs\Auth;

use Libs\Control\ControlResultDataLib;
use Libs\Control\ControlResultLib;

class AuthLoginRequestLib
{
    //用户名
    public string $userName;
    //密码
    public string $userPassword;


    static function loginSuccess($user): ControlResultLib
    {
        return (new ControlResultLib(
            true,
            'LoginSuccess',
        ))->setData($user);
    }

    static function NameDoesNotExist(): ControlResultLib
    {
        return new ControlResultLib(
            false,
            'NameDoesNotExist'
        );
    }

    static function PasswordError(): ControlResultLib
    {
        return new ControlResultLib(
            false,
            'PasswordError'
        );
    }

    static function LoginDisallowed(): ControlResultLib
    {
        return new ControlResultLib(
            false,
            'LoginDisallowed'
        );
    }

}
