<?php
namespace Core\AddressCore\Control;

use Core\AddressCore\Message\AddressInsertCoreMessage;
use Libs\Control\ControlLib;
use Libs\Auth\AuthLib;
use Libs\Client\ClientLib;
use Core\AddressCore\Service\AddressCoreService;
use Manage\CoreManage;

    class AddressCoreControl{

    static function getUserRegister()
    {
        (new ControlLib())->addAction(self::getAddressInsert())->register("/UserService/Address/Insert.action");
        (new ControlLib())->addAction(self::getAddressInsertBatch())->register("/UserService/Address/InsertBatch.action");
        (new ControlLib())->addAction(self::getAddressUpdate())->register("/UserService/Address/Update.action");
        (new ControlLib())->addAction(self::getAddressSearch())->register("/UserService/Address/Search.action");
        (new ControlLib())->addAction(self::getAddressDelete())->register("/UserService/Address/Delete.action");
    }

    static function getAddressInsert()
    {
        /**
         * @param object|AddressInsertCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            AddressCoreService::insert(AddressCoreService::Field()->fieldTransform($data));
        };
    }


    static function getAddressInsertBatch()
    {
        /**
         * @param object|AddressInsertCoreMessage[] $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $insertList = [];
            foreach ($data as $Item) {
                $insertList[] = AddressCoreService::Field()->fieldTransform($Item);
            }
            AddressCoreService::insertBatch($insertList);
        };
    }


    static function getAddressUpdate()
    {
        /**
         * @param object|AddressUpdateCoreMessage $data
         * @param object|null  $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList =  AddressCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            AddressCoreService::update(
                AddressCoreService::Field()->fieldTransform($data),
                $InfoList
            );
        };
    }


    static function getAddressSearch()
    {
        /**
         * @param object|AddressSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(AddressCoreService::search(
                empty($Parameters['Page']) ? 1 : $Parameters['Page'],
                empty($Parameters['Count']) ? 10 : $Parameters['Count'],
                AddressCoreService::Field()->searchTransform($data)
            ));
        };
    }


    static function getAddressCount()
    {
        /**
         * @param object|AddressSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(AddressCoreService::count(AddressCoreService::Field()->searchTransform($data)));
        };
    }


    static function getAddressGetOne()
    {
        /**
         * @param object|AddressSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            AddressCoreService::getOne(
                AddressCoreService::Field()->searchTransform($data),
                []
            );
        };
    }


    static function getAddressDelete()
    {
        /**
         * @param object|AddressSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList = AddressCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            AddressCoreService::delete(
                AddressCoreService::Field()->searchTransform($data)
            );
        };
    }
}