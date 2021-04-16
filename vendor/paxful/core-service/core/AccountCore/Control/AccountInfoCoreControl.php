<?php
namespace Core\AccountCore\Control;
use Core\AccountCore\Message\AccountInfoInsertCoreMessage;
use Core\AccountCore\Message\AccountInfoSearchCoreMessage;
use Core\AccountCore\Message\AccountInfoUpdateCoreMessage;
use Libs\Control\ControlLib;
use Libs\Auth\AuthLib;
use Libs\Client\ClientLib;
use Core\AccountCore\Service\AccountInfoCoreService;
use Manage\CoreManage;
	class AccountInfoCoreControl{

    static function getUserRegister()
    {
		(new ControlLib())->addAction(self::getAccountInfoCount())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountInfo_accountInfo = $auth->id;
			$data->equal_userInfo_accountInfo= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Game/GameBet/count.action");
		(new ControlLib())->addAction(self::getAccountInfoInsert())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountInfo_accountInfo = $auth->id;
			$data->equal_userInfo_accountInfo= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountInfo/Insert.action");
		(new ControlLib())->addAction(self::getAccountInfoInsertBatch())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountInfo_accountInfo = $auth->id;
			$data->equal_userInfo_accountInfo= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountInfo/InsertBatch.action");
		(new ControlLib())->addAction(self::getAccountInfoUpdate())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountInfo_accountInfo = $auth->id;
			$data->equal_userInfo_accountInfo= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountInfo/Update.action");
		(new ControlLib())->addAction(self::getAccountInfoSearch())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountInfo_accountInfo = $auth->id;
			$data->equal_userInfo_accountInfo= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountInfo/Search.action");
		(new ControlLib())->addAction(self::getAccountInfoDelete())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountInfo_accountInfo = $auth->id;
			$data->equal_userInfo_accountInfo= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountInfo/Delete.action");
    }
	

	static function getAccountInfoInsert()
    {
		/**
         * @param object|AccountInfoInsertCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            AccountInfoCoreService::insert(AccountInfoCoreService::Field()->fieldTransform($data));
        };
    }
	

	static function getAccountInfoInsertBatch()
    {
       /**
         * @param object|AccountInfoInsertCoreMessage[] $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $insertList = [];
            foreach ($data as $Item) {
                $insertList[] = AccountInfoCoreService::Field()->fieldTransform($Item);
            }
            AccountInfoCoreService::insertBatch($insertList);
        };
    }
	

	 static function getAccountInfoUpdate()
    {
        /**
         * @param object|AccountInfoUpdateCoreMessage $data
         * @param object|null  $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList =  AccountInfoCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
             AccountInfoCoreService::update(
                 AccountInfoCoreService::Field()->fieldTransform($data),
                $InfoList
            );
        };
    }
	

	static function getAccountInfoSearch()
    {
		/**
         * @param object|AccountInfoSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(AccountInfoCoreService::search(
                empty($Parameters['Page']) ? 1 : $Parameters['Page'],
                empty($Parameters['Count']) ? 10 : $Parameters['Count'],
                AccountInfoCoreService::Field()->searchTransform($data)
            ));
        };
    }
	

	static function getAccountInfoCount()
    {
		/**
         * @param object|AccountInfoSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(AccountInfoCoreService::count(AccountInfoCoreService::Field()->searchTransform($data)));
        };
	}
	

	static function getAccountInfoGetOne()
    {
		/**
         * @param object|AccountInfoSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
             AccountInfoCoreService::getOne(
                 AccountInfoCoreService::Field()->searchTransform($data),
                []
            );
        };
    }
	

	static function getAccountInfoDelete()
    {
        /**
         * @param object|AccountInfoSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList = AccountInfoCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            AccountInfoCoreService::delete(
                AccountInfoCoreService::Field()->searchTransform($data)
            );
        };
    }
	
}
