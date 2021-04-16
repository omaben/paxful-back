<?php


use Libs\Auth\AuthManageLib;

class UserAuthManage extends AuthManageLib
{

    function register($data = [])
    {
        UserService::insert([
            UserService::field()->Name->set($data['name']),
            UserService::field()->Password->set($data['password'])
        ]);
    }

    function getUserInfo($data = [])
    {
        // TODO: Implement getUserInfo() method.
    }

    function checkName(\Libs\Auth\AuthUserLib $user)
    {
        // TODO: Implement checkName() method.
    }
}