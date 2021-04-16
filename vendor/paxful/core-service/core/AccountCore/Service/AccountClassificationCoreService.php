<?php
namespace Core\AccountCore\Service;
use Libs\DataSource\Interfaces\SearchInfo;
use Libs\DataSource\Model\DataBaseEvent;
use Manage\CoreManage;
use Core\AccountCore\Data\AccountClassificationCoreData;
use Core\AccountCore\Field\AccountClassificationCoreField;
use Core\AccountCore\Model\AccountClassificationCoreModel;
class AccountClassificationCoreService extends DataBaseEvent {
static AccountClassificationCoreField $field;
	
	static function init()
	{
		parent::init(); 
		self::$field = new AccountClassificationCoreField();
	}

    static function insertBatch($data)
    {
        self::getOnInsertBatchBefore()->run($data);
        $result = AccountClassificationCoreData::insertBatch($data);
        self::getOnInsertBatchLater()->run($result);
        return $result;
    }


 	static function insert($data)
    {
        self::getOnInsertBefore()->run($data);
        $result = AccountClassificationCoreData::insert($data);
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
		return AccountClassificationCoreData::update($data,$list);
    }


	/**
	 * @param array|null $list
	 * @return int
	 */
	static function count(array $list = null): int
    {
        return AccountClassificationCoreData::count($list);
    }


    /**
     * @param int $page
     * @param int $count
     * @param array|null $list
     * @param array $filedList
     * @return AccountClassificationCoreModel[]
     */
	static function search(int $page, int $count, array $list = null, array $filedList = [])
    {
        self::getOnSearchBefore()->run($filedList);
        $result = AccountClassificationCoreData::search($page, $count, $list, $filedList);
        self::getOnSearchLater()->run($filedList);
        return $result;
    }


    static function delete(array $list = null): int
    {
        return AccountClassificationCoreData::delete($list);
    }


    static function searchInfo($data): SearchInfo
    {
        return CoreManage::$dataSource->searchInfo()->setList($data);
    }


	/**
	 * @param array|null $list
	 * @param array $filedList
	 * @return AccountClassificationCoreModel
	 */
	static function getOne(array $list = null, array $filedList = [])
    {
        self::getOnGetOneBefore()->run($filedList);
        $result = AccountClassificationCoreData::getOne($list, $filedList);
        self::getOnGetOneLater()->run($result);
        return $result;
    }


	static function field(): AccountClassificationCoreField
    {
        return self::$field;
    }
}
 AccountClassificationCoreService::init();
