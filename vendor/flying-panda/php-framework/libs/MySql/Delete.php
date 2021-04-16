<?php


namespace Libs\MySql;


use Closure;
use Libs\DataSource\Interfaces\SearchInfo;
use Libs\DataSource\Interfaces\Update;
use Manage\CoreManage;

class Delete implements \Libs\DataSource\Interfaces\Delete
{
    /**
     * @var SearchInfo
     */
    private SearchInfo $searchInfo;
    /**
     * @var string
     */
    private string  $table;
    /**
     * @var Closure
     */
    private Closure $succeedEvent;
    /**
     * @var Closure
     */
    private Closure $failEvent;

    /**
     * @return SearchInfo
     */
    function getSearchInfo(): SearchInfo
    {
        return $this->searchInfo;
    }

    /**
     * @param SearchInfo $v
     * @return Delete
     */
    function setSearchInfo(SearchInfo $v): Delete
    {
        $this->searchInfo = $v;
        return $this;
    }

    /**
     * @return int
     */
    function execute(): int
    {
        $sql = "delete from " . $this->table;
        if ($this->getSearchInfo() != null) {
            $searchInfo = $this->getSearchInfo()->execute();
            $sql .= $searchInfo[0];
            $parameterList = $searchInfo[1];
        }
        $count = CoreManage::$coreDataBase->Update($sql, $parameterList);
        return $count;
    }

    /**
     * @return mixed
     */
    function executeCache()
    {
        return [];
    }

    /**
     * @param $event
     * @return Delete
     */
    function succeed($event): Delete
    {
        return $this;
    }

    /**
     * @param $event
     * @return Delete
     */
    function fail($event): Delete
    {
        return $this;
    }

    /**
     * @param $table
     * @return Delete
     */
    function from($table): Delete
    {
        $this->table = $table;
        return $this;
    }
}