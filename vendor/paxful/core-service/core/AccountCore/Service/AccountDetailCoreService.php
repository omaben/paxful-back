<?php
namespace Core\AccountCore\Service;
use Libs\DataSource\Interfaces\SearchInfo;
use Libs\DataSource\Model\DataBaseEvent;
use Manage\CoreManage;
use Core\AccountCore\Data\AccountDetailCoreData;
use Core\AccountCore\Field\AccountDetailCoreField;
use Core\AccountCore\Model\AccountDetailCoreModel;
class AccountDetailCoreService extends DataBaseEvent {
static AccountDetailCoreField $field;
	
	static function init()
	{
		parent::init(); 
		self::$field = new AccountDetailCoreField();
	}

    static function insertBatch($data)
    {
        self::getOnInsertBatchBefore()->run($data);
        $result = AccountDetailCoreData::insertBatch($data);
        self::getOnInsertBatchLater()->run($result);
        return $result;
    }


 	static function insert($data)
    {
        self::getOnInsertBefore()->run($data);
        $result = AccountDetailCoreData::insert($data);
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
		return AccountDetailCoreData::update($data,$list);
    }


	/**
	 * @param array|null $list
	 * @return int
	 */
	static function count(array $list = null): int
    {
        return AccountDetailCoreData::count($list);
    }


    /**
     * @param int $page
     * @param int $count
     * @param array|null $list
     * @param array $filedList
     * @return AccountDetailCoreModel[]
     */
	static function search(int $page, int $count, array $list = null, array $filedList = [])
    {
        self::getOnSearchBefore()->run($filedList);
        $result = AccountDetailCoreData::search($page, $count, $list, $filedList);
        self::getOnSearchLater()->run($filedList);
        return $result;
    }


    static function delete(array $list = null): int
    {
        return AccountDetailCoreData::delete($list);
    }


    static function searchInfo($data): SearchInfo
    {
        return CoreManage::$dataSource->searchInfo()->setList($data);
    }


	/**
	 * @param array|null $list
	 * @param array $filedList
	 * @return AccountDetailCoreModel
	 */
	static function getOne(array $list = null, array $filedList = [])
    {
        self::getOnGetOneBefore()->run($filedList);
        $result = AccountDetailCoreData::getOne($list, $filedList);
        self::getOnGetOneLater()->run($result);
        return $result;
    }


	static function field(): AccountDetailCoreField
    {
        return self::$field;
    }
}
 AccountDetailCoreService::init();
