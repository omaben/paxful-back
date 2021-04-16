<?php


use Libs\Control\ControlRequestLib;
use Libs\Control\ControlResultLib;

class UserResult
{
    static function loginSuccess(ControlRequestLib $request): ControlResultLib
    {
        return new ControlResultLib(
            $request->getRequestService(),
            $request->getRequestService(),
            $request->getResultCode(),
            true,
            'LoginSuccess'
        );
    }

    static function loginNameDoesNotExist(ControlRequestLib $request): ControlResultLib
    {
        return new ControlResultLib(
            $request->getRequestService(),
            $request->getRequestService(),
            $request->getResultCode(),
            false,
            'LoginNameDoesNotExist'
        );
    }

    static function loginPasswordError(ControlRequestLib $request): ControlResultLib
    {
        return new ControlResultLib(
            $request->getRequestService(),
            $request->getRequestService(),
            $request->getResultCode(),
            false,
            'LoginPasswordError'
        );
    }

    static function loginUserNotAllOwe(ControlRequestLib $request): ControlResultLib
    {
        return new ControlResultLib(
            $request->getRequestService(),
            $request->getRequestService(),
            $request->getResultCode(),
            false,
            'LoginUserNotAllOwe'
        );
    }
}

