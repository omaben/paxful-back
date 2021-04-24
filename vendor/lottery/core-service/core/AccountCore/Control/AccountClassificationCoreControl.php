<?php
namespace Core\AccountCore\Control;
use Core\AccountCore\Message\AccountClassificationInsertCoreMessage;
use Core\AccountCore\Message\AccountClassificationSearchCoreMessage;
use Core\AccountCore\Message\AccountClassificationUpdateCoreMessage;
use Libs\Control\ControlLib;
use Libs\Auth\AuthLib;
use Libs\Client\ClientLib;
use Core\AccountCore\Service\AccountClassificationCoreService;
use Manage\CoreManage;
	class AccountClassificationCoreControl{

    static function getUserRegister()
    {
		(new ControlLib())->addAction(self::getAccountClassificationCount())->register("/UserService/Game/GameBet/count.action");
		(new ControlLib())->addAction(self::getAccountClassificationInsert())->register("/UserService/Account/AccountClassification/Insert.action");
		(new ControlLib())->addAction(self::getAccountClassificationInsertBatch())->register("/UserService/Account/AccountClassification/InsertBatch.action");
		(new ControlLib())->addAction(self::getAccountClassificationUpdate())->register("/UserService/Account/AccountClassification/Update.action");
		(new ControlLib())->addAction(self::getAccountClassificationSearch())->register("/UserService/Account/AccountClassification/Search.action");
		(new ControlLib())->addAction(self::getAccountClassificationDelete())->register("/UserService/Account/AccountClassification/Delete.action");
    }
	

	static function getAccountClassificationInsert()
    {
		/**
         * @param object|AccountClassificationInsertCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            AccountClassificationCoreService::insert(AccountClassificationCoreService::Field()->fieldTransform($data));
        };
    }
	

	static function getAccountClassificationInsertBatch()
    {
       /**
         * @param object|AccountClassificationInsertCoreMessage[] $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $insertList = [];
            foreach ($data as $Item) {
                $insertList[] = AccountClassificationCoreService::Field()->fieldTransform($Item);
            }
            AccountClassificationCoreService::insertBatch($insertList);
        };
    }
	

	 static function getAccountClassificationUpdate()
    {
        /**
         * @param object|AccountClassificationUpdateCoreMessage $data
         * @param object|null  $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList =  AccountClassificationCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
             AccountClassificationCoreService::update(
                 AccountClassificationCoreService::Field()->fieldTransform($data),
                $InfoList
            );
        };
    }
	

	static function getAccountClassificationSearch()
    {
		/**
         * @param object|AccountClassificationSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(AccountClassificationCoreService::search(
                empty($Parameters['Page']) ? 1 : $Parameters['Page'],
                empty($Parameters['Count']) ? 10 : $Parameters['Count'],
                AccountClassificationCoreService::Field()->searchTransform($data)
            ));
        };
    }
	

	static function getAccountClassificationCount()
    {
		/**
         * @param object|AccountClassificationSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(AccountClassificationCoreService::count(AccountClassificationCoreService::Field()->searchTransform($data)));
        };
	}
	

	static function getAccountClassificationGetOne()
    {
		/**
         * @param object|AccountClassificationSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
             AccountClassificationCoreService::getOne(
                 AccountClassificationCoreService::Field()->searchTransform($data),
                []
            );
        };
    }
	

	static function getAccountClassificationDelete()
    {
        /**
         * @param object|AccountClassificationSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList = AccountClassificationCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            AccountClassificationCoreService::delete(
                AccountClassificationCoreService::Field()->searchTransform($data)
            );
        };
    }
	
}
