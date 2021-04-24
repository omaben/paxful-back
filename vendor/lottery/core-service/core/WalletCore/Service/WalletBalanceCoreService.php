<?php
namespace Core\WalletCore\Service;
use Libs\DataSource\Interfaces\SearchInfo;
use Libs\DataSource\Model\DataBaseEvent;
use Manage\CoreManage;
use Core\WalletCore\Data\WalletBalanceCoreData;
use Core\WalletCore\Field\WalletBalanceCoreField;
use Core\WalletCore\Model\WalletBalanceCoreModel;

class WalletBalanceCoreService extends DataBaseEvent {
    static WalletBalanceCoreField $field;

    static function init()
    {
        parent::init();
        self::$field = new WalletBalanceCoreField();
    }

    static function insertBatch($data)
    {
        self::getOnInsertBatchBefore()->run($data);
        $result = WalletBalanceCoreData::insertBatch($data);
        self::getOnInsertBatchLater()->run($result);
        return $result;
    }


    static function insert($data)
    {
        self::getOnInsertBefore()->run($data);
        $result = WalletBalanceCoreData::insert($data);
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
        return WalletBalanceCoreData::update($data,$list);
    }


    /**
     * @param array|null $list
     * @return int
     */
    static function count(array $list = null): int
    {
        return WalletBalanceCoreData::count($list);
    }


    /**
     * @param int $page
     * @param int $count
     * @param array|null $list
     * @param array $filedList
     * @return WalletBalanceCoreModel[]
     */
    static function search(int $page, int $count, array $list = null, array $filedList = [])
    {
        self::getOnSearchBefore()->run($filedList);
        $result = WalletBalanceCoreData::search($page, $count, $list, $filedList);
        self::getOnSearchLater()->run($filedList);
        return $result;
    }


    static function delete(array $list = null): int
    {
        return WalletBalanceCoreData::delete($list);
    }


    static function searchInfo($data): SearchInfo
    {
        return CoreManage::$dataSource->searchInfo()->setList($data);
    }


    /**
     * @param array|null $list
     * @param array $filedList
     * @return WalletBalanceCoreModel
     */
    static function getOne(array $list = null, array $filedList = [])
    {
        self::getOnGetOneBefore()->run($filedList);
        $result = WalletBalanceCoreData::getOne($list, $filedList);
        self::getOnGetOneLater()->run($result);
        return $result;
    }


    static function field(): WalletBalanceCoreField
    {
        return self::$field;
    }
}
WalletBalanceCoreService::init();
