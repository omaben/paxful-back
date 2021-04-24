<?php
namespace Core\AddressCore\Data;
use Libs\DataSource\Interfaces\SearchInfo;
use Manage\CoreManage;
use Libs\ArrayUtil\ArrayUtilLib;

class AddressCoreData{
    static function insertBatch($data)
    {
        return CoreManage::$dataSource->insertBatch()->from("Address")->setInsertList($data)->execute();
    }


    static function insert($data)
    {
        return CoreManage::$dataSource->insert()->from("Address")->setFieldList($data)->execute();
    }


    static function update($data, array $list=null)
    {
        $searchInfo = AddressCoreData::searchInfo($list);
        return CoreManage::$dataSource->update()->setFieldList($data)->from("Address")->setSearchInfo($searchInfo)->execute();
    }


    static function count(array $list = null)
    {
        $searchInfo = AddressCoreData::searchInfo($list);
        $result =  CoreManage::$dataSource->search()->addFieldList("count(1) as count")->from("Address")->setSearchInfo($searchInfo)->getOne();
        return $result ? $result->count : 0;
    }


    static function setData(&$result)
    {
    }


    static function search(int $page, int $count, array $list = null, array $filedList = [])
    {
        $searchInfo = AddressCoreData::searchInfo($list);
        $result = CoreManage::$dataSource->search()->setFieldList($filedList)->from("Address")->setSearchInfo($searchInfo)->execute($page, $count);
        self::setData($result);
        return $result;
    }


    static function delete($data): int
    {
        $searchInfo = AddressCoreData::searchInfo($data);
        return CoreManage::$dataSource->delete()->from('Address')->setSearchInfo($searchInfo)->execute();
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
            $searchInfo = AddressCoreData::searchInfo($list);
        }
        $Result=CoreManage::$dataSource->search()->setFieldList($filedList)->from("Address")->setSearchInfo($searchInfo)->getOne();
        if (empty($Result)) {
            return null;
        } else {
            $Result = [$Result];
            self::setData($Result);
            return $Result[0];
        }
    }
}