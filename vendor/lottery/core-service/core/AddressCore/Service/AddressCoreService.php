<?php
namespace Core\AddressCore\Service;
use Libs\DataSource\Interfaces\SearchInfo;
use Libs\DataSource\Model\DataBaseEvent;
use Manage\CoreManage;
use Core\AddressCore\Data\AddressCoreData;
use Core\AddressCore\Field\AddressCoreField;
use Core\AddressCore\Model\AddressCoreModel;

class AddressCoreService extends DataBaseEvent {
    static AddressCoreField $field;

    static function init()
    {
        parent::init();
        self::$field = new AddressCoreField();
    }

    static function insertBatch($data)
    {
        self::getOnInsertBatchBefore()->run($data);
        $result = AddressCoreData::insertBatch($data);
        self::getOnInsertBatchLater()->run($result);
        return $result;
    }


    static function insert($data)
    {
        self::getOnInsertBefore()->run($data);
        $result = AddressCoreData::insert($data);
        self::getOnInsertLater()->run($result);
        return $result;
    }


    /**
     * @param $data
     * @param SearchInfo $list
     * @return int
     */
    static function update($data, array $list)
    {
        return AddressCoreData::update($data,$list);
    }


    /**
     * @param array|null $list
     * @return int
     */
    static function count(array $list = null): int
    {
        return AddressCoreData::count($list);
    }


    /**
     * @param int $page
     * @param int $count
     * @param array|null $list
     * @param array $filedList
     * @return AddressCoreModel[]
     */
    static function search(int $page, int $count, array $list = null, array $filedList = [])
    {
        self::getOnSearchBefore()->run($filedList);
        $result = AddressCoreData::search($page, $count, $list, $filedList);
        self::getOnSearchLater()->run($filedList);
        return $result;
    }


    static function delete(array $list = null): int
    {
        return AddressCoreData::delete($list);
    }


    static function searchInfo($data): SearchInfo
    {
        return CoreManage::$dataSource->searchInfo()->setList($data);
    }


    /**
     * @param array|null $list
     * @param array $filedList
     * @return AddressCoreModel
     */
    static function getOne(array $list = null, array $filedList = [])
    {
        self::getOnGetOneBefore()->run($filedList);
        $result = AddressCoreData::getOne($list, $filedList);
        self::getOnGetOneLater()->run($result);
        return $result;
    }


    static function field(): AddressCoreField
    {
        return self::$field;
    }
}
AddressCoreService::init();
