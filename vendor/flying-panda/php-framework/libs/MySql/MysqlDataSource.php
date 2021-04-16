<?php


namespace Libs\MySql;


use Libs\DataSource\Interfaces\DataSource;
use Libs\DataSource\Interfaces\Delete;
use Libs\DataSource\Interfaces\Insert;
use Libs\DataSource\Interfaces\InsertBatch;
use Libs\DataSource\Interfaces\Search;
use Libs\DataSource\Interfaces\SearchInfo;
use Libs\DataSource\Interfaces\Update;

class MysqlDataSource implements DataSource
{
    /**
     * @return Insert
     */
    function insert(): Insert
    {
        return new \Libs\MySql\Insert();
    }

    /**
     * @return InsertBatch
     */
    function insertBatch(): InsertBatch
    {
        return new \Libs\MySql\InsertBatch();
    }

    /**
     * @return Update
     */
    function update(): Update
    {
        return new \Libs\MySql\Update();
    }

    /**
     * @param array $list
     * @return SearchInfo
     */
    function searchInfo(array $list = []): SearchInfo
    {
        return new \Libs\MySql\SearchInfo($list);
    }

    /**
     * @return Search
     */
    function search(): Search
    {
        return new \Libs\MySql\Search();
    }

    /**
     * @return Search
     */
    function delete(): Delete
    {
        return new \Libs\MySql\Delete();
    }
}