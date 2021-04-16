<?php
namespace Core\AccountCore\Data;
use Libs\DataSource\Interfaces\SearchInfo;
use Manage\CoreManage;
use Libs\ArrayUtil\ArrayUtilLib;
use Core\UserCore\Service\UserInfoCoreService;
class AccountInfoCoreData{

	static function insertBatch($data)
    {
        return CoreManage::$dataSource->insertBatch()->from("AccountInfo")->setInsertList($data)->execute();
    }


	static function insert($data)
	{
		return CoreManage::$dataSource->insert()->from("AccountInfo")->setFieldList($data)->execute();
	}

    
	static function update($data, array $list=null)
    {
		$searchInfo = AccountInfoCoreData::searchInfo($list);
        return CoreManage::$dataSource->update()->setFieldList($data)->from("AccountInfo")->setSearchInfo($searchInfo)->execute();
    }


	static function count(array $list = null)
	{
		$searchInfo = AccountInfoCoreData::searchInfo($list);
		$result =  CoreManage::$dataSource->search()->addFieldList("count(1) as count")->from("AccountInfo")->setSearchInfo($searchInfo)->getOne();
		return $result ? $result->count : 0;
	}


	static function setData(&$result)
	{
		  if ($result) {
            $allId = [];
            $allResult = [];
            foreach ($result as $item) {
				if(!empty($item->userInfo)){$allId["userInfo"][] = $item->userInfo;}
            }
			$userInfo = ArrayUtilLib::KeyToMap('id',UserInfoCoreService::search(1,100,[UserInfoCoreService::field()->id->in(!empty($allId['userInfo'])&&count($allId['userInfo'])>0?array_unique($allId['userInfo']):[])]));
            foreach ($result as &$item) {
                if (!empty($userInfo)&&!empty($userInfo[$item->userInfo])) {
				$item->userInfoModel = $userInfo[$item->userInfo];
			}
            }
        }
	}

	static function search(int $page, int $count, array $list = null, array $filedList = [])
	{
		$searchInfo = AccountInfoCoreData::searchInfo($list);
		$result = CoreManage::$dataSource->search()->setFieldList($filedList)->from("AccountInfo")->setSearchInfo($searchInfo)->execute($page, $count);
      	self::setData($result);
		return $result;
	}


    static function delete($data): int
    {
        $searchInfo = AccountInfoCoreData::searchInfo($data);
        return CoreManage::$dataSource->delete()->from('AccountInfo')->setSearchInfo($searchInfo)->execute();
    }


    static function searchInfo($data): SearchInfo
    {
		if ($data != null) {
            return CoreManage::$dataSource->searchInfo()->setList($data);
        } else {
            return CoreManage::$dataSource->searchInfo();
        }
    }


	static function getOne(array $list = null, array $filedList = [])
	{
		$searchInfo = null;
        if ($list != null) {
            $searchInfo = AccountInfoCoreData::searchInfo($list);
        }
		$Result=CoreManage::$dataSource->search()->setFieldList($filedList)->from("AccountInfo")->setSearchInfo($searchInfo)->getOne();
  		if (empty($Result)) {
            return null;
        } else {
            $Result = [$Result]; 
            self::setData($Result);
            return $Result[0];
        }
	}

}
