<?php

use Libs\Control\ControlLib;

class UserController
{
//    static function getGuestRegister()
//    {
//        self::getAdminCount()->register("/GuestService/User/UserInfo/Count.action");
//        self::getAdminInsert()->register("/GuestService/User/UserInfo/Insert.action");
//        self::getAdminInsertBatch()->register("/GuestService/User/UserInfo/InsertBatch.action");
//        self::getAdminUpdate()->register("/GuestService/User/UserInfo/Update.action");
//        self::getAdminSearch()->register("/GuestService/User/UserInfo/Search.action");
//        self::getAdminDelete()->register("/GuestService/User/UserInfo/Delete.action");
//    }

    static function getUserRegister()
    {
        self::getUserCount()->register("/UserService/User/UserInfo/Count.action");
        self::getUserInsert()->register("/UserService/User/UserInfo/Insert.action");
        self::getUserInsertBatch()->register("/UserService/User/UserInfo/InsertBatch.action");
        self::getUserUpdate()->register("/UserService/User/UserInfo/Update.action");
        self::getUserSearch()->register("/UserService/User/UserInfo/Search.action");
        self::getUserDelete()->register("/UserService/User/UserInfo/Delete.action");
    }

//    static function getAdminRegister()
//    {
//        self::getAdminCount()->register("/AdminService/User/UserInfo/Count.action");
//        self::getAdminInsert()->register("/AdminService/User/UserInfo/Insert.action");
//        self::getAdminInsertBatch()->register("/AdminService/User/UserInfo/InsertBatch.action");
//        self::getAdminUpdate()->register("/AdminService/User/UserInfo/Update.action");
//        self::getAdminSearch()->register("/AdminService/User/UserInfo/Search.action");
//        self::getAdminDelete()->register("/AdminService/User/UserInfo/Delete.action");
//    }

    static function getUserInsert()
    {
        return (new ControlLib())->addAction(function (ControlLib $control) {
            $Parameters = $control->getParameters();
            UserService::insert(UserService::Field()->fieldTransform($Parameters));
        })->setRule([])->setIsLogin(true)->addBefore(function (ControlLib $control) {
            $control->addParameters("Id", $control->getAuth()->getUser()->getId());
        });
    }

    static function getUserInsertBatch()
    {
        return (new ControlLib())->addAction(function (ControlLib $control) {
            $requestList = json_decode($control->getParameters()['Data'], true);
            if ($requestList == null) {
                return;
            }
            $insertList = [];
            foreach ($requestList as $Item) {
                $insertList[] = UserService::Field()->fieldTransform($Item);
            }
            UserService::insertBatch($insertList);
        })->setRule([])->setIsLogin(true)->addBefore(function (ControlLib $control) {
            $control->addParameters("Id", $control->getAuth()->getUser()->getId());
        });
    }

    static function getUserUpdate()
    {
        return (new ControlLib())->addAction(function (ControlLib $control) {
            $Parameters = $control->getParameters();
            $InfoList = UserService::Field()->searchTransform($Parameters);
            if (count($InfoList) == 0) {
                $control->getClient()->Send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            UserService::update(
                UserService::Field()->fieldTransform($Parameters),
                UserService::searchInfo($InfoList)
            );
        })->setRule([])->setIsLogin(true)->addBefore(function (ControlLib $control) {
            $control->addParameters("Id", $control->getAuth()->getUser()->getId());
        });
    }

    static function getUserSearch()
    {
        return (new ControlLib())->addAction(function (ControlLib $control) {
            $Parameters = $control->getParameters();
            UserService::search(
                empty($Parameters['Page']) ? 1 : $Parameters['Page'],
                empty($Parameters['Count']) ? 10 : $Parameters['Count'],
                UserService::searchInfo(UserService::Field()->searchTransform($Parameters))
            );
        })->setRule([])->setIsLogin(true)->addBefore(function (ControlLib $control) {
            $control->addParameters("Id", $control->getAuth()->getUser()->getId());
        });
    }

    static function getUserGetOne()
    {
        return (new ControlLib())->addAction(function (ControlLib $control) {
            $Parameters = $control->getParameters();
            UserService::getOne(
                UserService::searchInfo(UserService::Field()->searchTransform($Parameters)),
                []
            );
        })->setRule([])->setIsLogin(true)->addBefore(function (ControlLib $control) {
            $control->addParameters("Id", $control->getAuth()->getUser()->getId());
        });
    }

    static function getUserDelete()
    {
        return (new ControlLib())->addAction(function (ControlLib $control) {
            $Parameters = $control->getParameters();
            $InfoList = UserService::Field()->searchTransform($Parameters);
            if (count($InfoList) == 0) {
                $control->getClient()->Send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            UserService::delete(
                UserService::searchInfo(UserService::Field()->searchTransform($Parameters))
            );
        })->setRule([])->setIsLogin(true)->addBefore(function (ControlLib $control) {
            $control->addParameters("Id", $control->getAuth()->getUser()->getId());
        });
    }

    static function getUserCount()
    {
        return (new ControlLib())->addAction(function (ControlLib $control) {
            $Parameters = $control->getParameters();
            UserService::count(UserService::searchInfo(
                UserService::Field()->searchTransform($Parameters)
            ));
        })->setRule([])->setIsLogin(true)->addBefore(function (ControlLib $control) {
            $control->addParameters("Id", $control->getAuth()->getUser()->getId());
        });
    }
}