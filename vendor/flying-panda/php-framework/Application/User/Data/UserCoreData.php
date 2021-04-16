<?php

use Libs\DataSource\Interfaces\SearchInfo;
use Manage\CoreManage;

class UserCoreData
{

    /**
     * 获取单个用户
     * @param SearchInfo|null $searchInfo
     * @param array $filedList
     * @return mixed
     */
    static function getOne(SearchInfo $searchInfo = null, array $filedList = [])
    {
        return CoreManage::$dataSource->search()->setFieldList($filedList)->from("user")->setSearchInfo($searchInfo)->getOne();
    }

    /**
     * 获取全部用户
     * @param int $page
     * @param int $count
     * @param SearchInfo|null $searchInfo
     * @param array $filedList
     * @return mixed
     */
    static function search(int $page, int $count, SearchInfo $searchInfo = null, array $filedList = [])
    {
        return CoreManage::$dataSource->search()->setFieldList($filedList)->from("user")->setSearchInfo($searchInfo)->execute($page, $count);
    }

    /**
     * 获取插入
     * @param $data
     * @return int
     */
    static function insert($data)
    {
        return CoreManage::$dataSource->insert()->setFieldList($data)->execute();
    }

    /**
     * 批量插入
     * @param $data
     * @return int
     */
    static function insertBatch($data)
    {
        return CoreManage::$dataSource->insertBatch()->setInsertList($data)->execute();
    }

    /**
     * 搜索信息
     * @param $data
     * @return SearchInfo
     */
    static function searchInfo($data): SearchInfo
    {
        return CoreManage::$dataSource->searchInfo();
    }

    /**
     * 执行更新
     * @param $data
     * @param SearchInfo $searchInfo
     * @return int
     */
    static function update($data, SearchInfo $searchInfo)
    {
        return CoreManage::$dataSource->update()->setFieldList($data)->setSearchInfo($searchInfo)->execute();
    }

    /**
     * 获取用户数量
     * @param SearchInfo|null $searchInfo
     * @return int
     */
    static function count(SearchInfo $searchInfo = null): int
    {
        return CoreManage::$dataSource->search()->addFieldList("count(1)")->from("user")->setSearchInfo($searchInfo)->getOne();
    }

    /**
     * @param SearchInfo|null $searchInfo
     * @return int
     */
    static function delete(SearchInfo $searchInfo = null): int
    {
        return 0;
    }
}
