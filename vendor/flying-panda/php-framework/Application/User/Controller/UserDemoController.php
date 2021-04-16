<?php


use Libs\Control\ControlLib;

class UserDemoController
{
    function aaa()
    {
        return (new ControlLib())->addAction(function (ControlLib $control) {
            return UserResult::LoginSuccess();
        })->setRule([])->setIsLogin(true)->addBefore(function (ControlLib $control) {
            $control->addParameters("Id", $control->getAuth()->getUser()->getId());
        });
    }
}