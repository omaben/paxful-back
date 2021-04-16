<?php


namespace Libs\MySql;


use Libs\DataSource\Interfaces\Field;
use Libs\DataSource\Interfaces\SearchInfo;
use Manage\CoreManage;

class Search implements \Libs\DataSource\Interfaces\Search
{
    private array $fieldList = [];
    private array $table;
    private SearchInfo $searchInfo;

    function addFieldList(string $val): \Libs\DataSource\Interfaces\Search
    {
        $this->fieldList[] = $val;
        return $this;
    }

    function getFieldList(): array
    {
        return $this->fieldList;
    }

    function setFieldList(array $fieldList): \Libs\DataSource\Interfaces\Search
    {
        $this->fieldList = $fieldList;
        return $this;
    }

    function succeed($event): \Libs\DataSource\Interfaces\Search
    {
        return $this;
    }

    function succeedItem($event): \Libs\DataSource\Interfaces\Search
    {
        return $this;
    }

    function fail($event): \Libs\DataSource\Interfaces\Search
    {
        return $this;
    }

    function from(string $name): \Libs\DataSource\Interfaces\Search
    {
        $this->table[] = $name;
        return $this;
    }

    function getSearchInfo(): SearchInfo
    {
        return $this->searchInfo;
    }

    function setSearchInfo(SearchInfo $v): \Libs\DataSource\Interfaces\Search
    {
        $this->searchInfo = $v;
        return $this;
    }

    function execute(int $page, int $count)
    {
        $sqlInfo = $this->getSqlInfo();
        return CoreManage::$coreDataBase->Search($sqlInfo[0], $sqlInfo[1]);
    }

    function getSqlInfo(): array
    {
        $fieldList = [];
        $parameterList = [];
        foreach ($this->fieldList as $item) {
            $fieldList[] =  $item ;
        }
        $sql = "select " . (count($this->fieldList) == 0 ? "*" : implode(",", $this->fieldList)) . " from " . implode(",", $this->table);
        if ($this->getSearchInfo() != null) {
            $searchInfo = $this->getSearchInfo()->execute();
            $sql .= $searchInfo[0];
            $parameterList = $searchInfo[1];
        }
        return [$sql, $parameterList];
    }

    function getOne()
    {
        $sqlInfo = $this->getSqlInfo();
        $ret = CoreManage::$coreDataBase->Search($sqlInfo[0], $sqlInfo[1]);
        return count($ret) == 0 ? null : $ret[0];
    }
}