<?php
namespace Core\AccountCore\Service;
use Libs\DataSource\Interfaces\SearchInfo;
use Libs\DataSource\Model\DataBaseEvent;
use Manage\CoreManage;
use Core\AccountCore\Data\AccountInfoCoreData;
use Core\AccountCore\Field\AccountInfoCoreField;
use Core\AccountCore\Model\AccountInfoCoreModel;
class AccountInfoCoreService extends DataBaseEvent {
static AccountInfoCoreField $field;
	
	static function init()
	{
		parent::init(); 
		self::$field = new AccountInfoCoreField();
	}

    static function insertBatch($data)
    {
        self::getOnInsertBatchBefore()->run($data);
        $result = AccountInfoCoreData::insertBatch($data);
        self::getOnInsertBatchLater()->run($result);
        return $result;
    }


 	static function insert($data)
    {
        self::getOnInsertBefore()->run($data);
        $result = AccountInfoCoreData::insert($data);
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
		return AccountInfoCoreData::update($data,$list);
    }


	/**
	 * @param array|null $list
	 * @return int
	 */
	static function count(array $list = null): int
    {
        return AccountInfoCoreData::count($list);
    }


    /**
     * @param int $page
     * @param int $count
     * @param array|null $list
     * @param array $filedList
     * @return AccountInfoCoreModel[]
     */
	static function search(int $page, int $count, array $list = null, array $filedList = [])
    {
        self::getOnSearchBefore()->run($filedList);
        $result = AccountInfoCoreData::search($page, $count, $list, $filedList);
        self::getOnSearchLater()->run($filedList);
        return $result;
    }


    static function delete(array $list = null): int
    {
        return AccountInfoCoreData::delete($list);
    }


    static function searchInfo($data): SearchInfo
    {
        return CoreManage::$dataSource->searchInfo()->setList($data);
    }


	/**
	 * @param array|null $list
	 * @param array $filedList
	 * @return AccountInfoCoreModel
	 */
	static function getOne(array $list = null, array $filedList = [])
    {
        self::getOnGetOneBefore()->run($filedList);
        $result = AccountInfoCoreData::getOne($list, $filedList);
        self::getOnGetOneLater()->run($result);
        return $result;
    }


	static function field(): AccountInfoCoreField
    {
        return self::$field;
    }
}
 AccountInfoCoreService::init();
