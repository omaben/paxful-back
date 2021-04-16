<?php

use Application\User\Result\UserLoginRequest;
use Libs\Control\ControlRequestLib;
use Libs\Control\ControlResultLib;

class UserService
{
    static function login(UserLoginRequest $data, ControlRequestLib $request): ControlResultLib
    {
        if ($data->userName == "") {
            return UserResult::LoginNameDoesNotExist($request);
        }
        return UserResult::LoginSuccess($request);
    }
}