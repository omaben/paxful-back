<?php


namespace Libs\MySql;


use Closure;
use Libs\DataSource\Interfaces\Field;
use Libs\DataSource\Interfaces\SearchInfo;
use Manage\CoreManage;

class Update implements \Libs\DataSource\Interfaces\Update
{
    /**
     * @var array<Field>
     */
    private array $fieldList;

    /**
     * @var SearchInfo
     */
    private SearchInfo $searchInfo;
    private array  $table;
    /**
     * @var Closure
     */
    private Closure $succeedEvent;
    /**
     * @var Closure
     */
    private Closure $failEvent;


    public function from($table): \Libs\DataSource\Interfaces\Update
    {
        $this->table[] = $table;
        return $this;
    }

    function addFieldList(string $name, $v): \Libs\DataSource\Interfaces\Update
    {
        $this->fieldList[] = new \Libs\DataSource\Model\Field(false, $name, $v, "?");
        return $this;
    }

    function setFieldList(array $FieldList): \Libs\DataSource\Interfaces\Update
    {
        $this->fieldList = $FieldList;
        return $this;
    }

    function getFieldList(): array
    {
        return $this->fieldList;
    }

    function getSearchInfo(): \Libs\DataSource\Interfaces\SearchInfo
    {
        return $this->searchInfo;
    }

    function setSearchInfo(SearchInfo $v): \Libs\DataSource\Interfaces\Update
    {
        $this->searchInfo = $v;
        return $this;
    }

    function execute(): int
    {
        $sql = "update " . implode(",", $this->table) . " set ";
        $valueList = [];
        $parameterList = [];
        foreach ($this->fieldList as $item) {
            $valueList[] = "`" . $item->getName() . "`=" . $item->getCompile();
            if (!$item->isCompileType()) {
                $parameterList[] = $item->getValue();
            }
        }
        $sql .= implode(",", $valueList);
        if ($this->getSearchInfo() != null) {
            $searchInfo = $this->getSearchInfo()->execute();
            $sql .= $searchInfo[0];
            $parameterList = array_merge($parameterList, $searchInfo[1]);
        }
        $count = CoreManage::$coreDataBase->Update($sql, $parameterList);
//        if ($count > 0) {
//            $succeed = $this->succeedEvent;
//            $succeed($count);
//        } else {
//            $failEvent = $this->failEvent;
//            $failEvent();
//        }
        return $count;
    }

    function executeCache()
    {
        // TODO: Implement executeCache() method.
    }

    function succeed($event): \Libs\DataSource\Interfaces\Update
    {
        $this->succeedEvent = $event;
        return $this;
    }

    function fail($event): \Libs\DataSource\Interfaces\Update
    {
        $this->succeedEvent = $event;
        return $this;
    }
}