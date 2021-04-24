<?php
namespace Core\AccountCore\Control;
use Core\AccountCore\Message\AccountDetailInsertCoreMessage;
use Core\AccountCore\Message\AccountDetailSearchCoreMessage;
use Core\AccountCore\Message\AccountDetailUpdateCoreMessage;
use Libs\Control\ControlLib;
use Libs\Auth\AuthLib;
use Libs\Client\ClientLib;
use Core\AccountCore\Service\AccountDetailCoreService;
use Manage\CoreManage;
	class AccountDetailCoreControl{

    static function getUserRegister()
    {
		(new ControlLib())->addAction(self::getAccountDetailCount())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountDetail_accountDetail = $auth->id;
			$data->equal_userInfo_accountDetail= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Game/GameBet/count.action");
		(new ControlLib())->addAction(self::getAccountDetailInsert())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountDetail_accountDetail = $auth->id;
			$data->equal_userInfo_accountDetail= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountDetail/Insert.action");
		(new ControlLib())->addAction(self::getAccountDetailInsertBatch())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountDetail_accountDetail = $auth->id;
			$data->equal_userInfo_accountDetail= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountDetail/InsertBatch.action");
		(new ControlLib())->addAction(self::getAccountDetailUpdate())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountDetail_accountDetail = $auth->id;
			$data->equal_userInfo_accountDetail= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountDetail/Update.action");
		(new ControlLib())->addAction(self::getAccountDetailSearch())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountDetail_accountDetail = $auth->id;
			$data->equal_userInfo_accountDetail= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountDetail/Search.action");
		(new ControlLib())->addAction(self::getAccountDetailDelete())->setRule([])->setLogin(true)->addBefore(function (object &$data, ?object $auth, ClientLib $client) {
            $data->equal_equal_userInfo_accountDetail_accountDetail = $auth->id;
			$data->equal_userInfo_accountDetail= $auth->id;
        })->setAuth(CoreManage::getAuthManageLib()[USER_MANAGE]->Auth())->register("/UserService/Account/AccountDetail/Delete.action");
    }
	

	static function getAccountDetailInsert()
    {
		/**
         * @param object|AccountDetailInsertCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            AccountDetailCoreService::insert(AccountDetailCoreService::Field()->fieldTransform($data));
        };
    }
	

	static function getAccountDetailInsertBatch()
    {
       /**
         * @param object|AccountDetailInsertCoreMessage[] $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $insertList = [];
            foreach ($data as $Item) {
                $insertList[] = AccountDetailCoreService::Field()->fieldTransform($Item);
            }
            AccountDetailCoreService::insertBatch($insertList);
        };
    }
	

	 static function getAccountDetailUpdate()
    {
        /**
         * @param object|AccountDetailUpdateCoreMessage $data
         * @param object|null  $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList =  AccountDetailCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
             AccountDetailCoreService::update(
                 AccountDetailCoreService::Field()->fieldTransform($data),
                $InfoList
            );
        };
    }
	

	static function getAccountDetailSearch()
    {
		/**
         * @param object|AccountDetailSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(AccountDetailCoreService::search(
                empty($Parameters['Page']) ? 1 : $Parameters['Page'],
                empty($Parameters['Count']) ? 10 : $Parameters['Count'],
                AccountDetailCoreService::Field()->searchTransform($data)
            ));
        };
    }
	

	static function getAccountDetailCount()
    {
		/**
         * @param object|AccountDetailSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $client->send(AccountDetailCoreService::count(AccountDetailCoreService::Field()->searchTransform($data)));
        };
	}
	

	static function getAccountDetailGetOne()
    {
		/**
         * @param object|AccountDetailSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
             AccountDetailCoreService::getOne(
                 AccountDetailCoreService::Field()->searchTransform($data),
                []
            );
        };
    }
	

	static function getAccountDetailDelete()
    {
        /**
         * @param object|AccountDetailSearchCoreMessage $data
         * @param object|null $auth
         * @param ClientLib $client
         */
        return function (object $data, ?object $auth, ClientLib $client) {
            $InfoList = AccountDetailCoreService::Field()->searchTransform($data);
            if (count($InfoList) == 0) {
                $client->send(["state" => 1, "message" => "Permission Denied"]);
                return;
            }
            AccountDetailCoreService::delete(
                AccountDetailCoreService::Field()->searchTransform($data)
            );
        };
    }
	
}
