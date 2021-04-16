<?php
namespace Core\AccountCore\Data;
use Libs\DataSource\Interfaces\SearchInfo;
use Manage\CoreManage;
use Libs\ArrayUtil\ArrayUtilLib;

class AccountClassificationCoreData{

	static function insertBatch($data)
    {
        return CoreManage::$dataSource->insertBatch()->from("AccountClassification")->setInsertList($data)->execute();
    }


	static function insert($data)
	{
		return CoreManage::$dataSource->insert()->from("AccountClassification")->setFieldList($data)->execute();
	}

    
	static function update($data, array $list=null)
    {
		$searchInfo = AccountClassificationCoreData::searchInfo($list);
        return CoreManage::$dataSource->update()->setFieldList($data)->from("AccountClassification")->setSearchInfo($searchInfo)->execute();
    }


	static function count(array $list = null)
	{
		$searchInfo = AccountClassificationCoreData::searchInfo($list);
		$result =  CoreManage::$dataSource->search()->addFieldList("count(1) as count")->from("AccountClassification")->setSearchInfo($searchInfo)->getOne();
		return $result ? $result->count : 0;
	}


	static function setData(&$result)
	{
	}
		

	static function search(int $page, int $count, array $list = null, array $filedList = [])
	{
		$searchInfo = AccountClassificationCoreData::searchInfo($list);
		$result = CoreManage::$dataSource->search()->setFieldList($filedList)->from("AccountClassification")->setSearchInfo($searchInfo)->execute($page, $count);
      	self::setData($result);
		return $result;
	}


    static function delete($data): int
    {
        $searchInfo = AccountClassificationCoreData::searchInfo($data);
        return CoreManage::$dataSource->delete()->from('AccountClassification')->setSearchInfo($searchInfo)->execute();
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
            $searchInfo = AccountClassificationCoreData::searchInfo($list);
        }
		$Result=CoreManage::$dataSource->search()->setFieldList($filedList)->from("AccountClassification")->setSearchInfo($searchInfo)->getOne();
  		if (empty($Result)) {
            return null;
        } else {
            $Result = [$Result]; 
            self::setData($Result);
            return $Result[0];
        }
	}

}
