<?php
namespace Core\WalletCore\Control;

use Core\WalletCore\Message\WalletBalanceInsertCoreMessage;
use Libs\Control\ControlLib;
use Libs\Auth\AuthLib;
use Libs\Client\ClientLib;
use Core\WalletCore\Service\WalletBalanceCoreService;
use Manage\CoreManage;

class WalletBalanceCoreControl{
    static function getUserRegister()
    {
        (new ControlLib())->addAction(self::getWalletBalanceInsert())->register("/UserService/WalletBalance/Insert.action");
        (new ControlLib())->addAction(self::getWalletBalanceInsertBatch())->register("/UserService/WalletBalance/InsertBatch.action");
        (new ControlLib())->addAction(self::getWalletBalanceUpdate())->register("/UserService/WalletBalance/Update.action");
        (new ControlLib())->addAction(self::getWalletBalanceSearch())->register("/UserService/WalletBalance/Search.action");
        (new ControlLib())->addAction(self::getWalletBalanceDelete())->register("/UserService/WalletBalance/Delete.action");
    }

    static function getWalletBalanceInsert()
    {
        /**
         * @param object|WalletBalanceInsertCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            WalletBalanceCoreService::insert(WalletBalanceCoreService::Field()->fieldTransform($data));
        };
    }


    static function getWalletBalanceInsertBatch()
    {
        /**
         * @param object|WalletBalanceInsertCoreMessage[] $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $insertList = [];
            foreach ($data as $Item) {
                $insertList[] = WalletBalanceCoreService::Field()->fieldTransform($Item);
            }
            WalletBalanceCoreService::insertBatch($insertList);
        };
    }


    static function getWalletBalanceUpdate()
    {
        /**
         * @param object|WalletBalanceUpdateCoreMessage $data
         * @param object|null  $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList =  WalletBalanceCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            WalletBalanceCoreService::update(
                WalletBalanceCoreService::Field()->fieldTransform($data),
                $InfoList
            );
        };
    }


    static function getWalletBalanceSearch()
    {
        /**
         * @param object|WalletBalanceSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(WalletBalanceCoreService::search(
                empty($Parameters['Page']) ? 1 : $Parameters['Page'],
                empty($Parameters['Count']) ? 10 : $Parameters['Count'],
                WalletBalanceCoreService::Field()->searchTransform($data)
            ));
        };
    }


    static function getWalletBalanceCount()
    {
        /**
         * @param object|WalletBalanceSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(WalletBalanceCoreService::count(WalletBalanceCoreService::Field()->searchTransform($data)));
        };
    }


    static function getWalletBalanceGetOne()
    {
        /**
         * @param object|WalletBalanceSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            WalletBalanceCoreService::getOne(
                WalletBalanceCoreService::Field()->searchTransform($data),
                []
            );
        };
    }


    static function getWalletBalanceDelete()
    {
        /**
         * @param object|WalletBalanceSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList = WalletBalanceCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            WalletBalanceCoreService::delete(
                WalletBalanceCoreService::Field()->searchTransform($data)
            );
        };
    }
}