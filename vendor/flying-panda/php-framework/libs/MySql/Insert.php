<?php


namespace Libs\MySql;


use Closure;
use Libs\DataSource\Enum\FieldTypeEnum;
use Libs\DataSource\Interfaces\Field;
use Libs\DataSource\Interfaces\SearchInfo;
use Manage\CoreManage;

class Insert implements \Libs\DataSource\Interfaces\Insert
{
    /**
     * @var array<Field>
     */
    private array $fieldList;
    /**
     * @var string
     */
    private string $table;
    /**
     * @var Closure
     */
    private Closure $succeedEvent;
    /**
     * @var Closure
     */
    private Closure $failEvent;
    /**
     * @var SearchInfo
     */
    private SearchInfo $searchInfo;

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    public function from($table): Insert
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param string $table
     * @return Insert
     */
    public function setTable(string $table): Insert
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return Closure
     */
    public function getSucceedEvent(): Closure
    {
        return $this->succeedEvent;
    }

    /**
     * @param Closure $succeedEvent
     * @return \Libs\DataSource\Interfaces\Insert
     */
    public function setSucceedEvent(Closure $succeedEvent): \Libs\DataSource\Interfaces\Insert
    {
        $this->succeedEvent = $succeedEvent;
        return $this;
    }

    /**
     * @return Closure
     */
    public function getFailEvent(): Closure
    {
        return $this->failEvent;
    }

    /**
     * @param Closure $failEvent
     * @return \Libs\DataSource\Interfaces\Insert
     */
    public function setFailEvent(Closure $failEvent): \Libs\DataSource\Interfaces\Insert
    {
        $this->failEvent = $failEvent;
        return $this;
    }

    /**
     * @return SearchInfo
     */
    public function getSearchInfo(): SearchInfo
    {
        return $this->searchInfo;
    }

    /**
     * @param SearchInfo $searchInfo
     * @return \Libs\DataSource\Interfaces\Insert
     */
    public function setSearchInfo(SearchInfo $searchInfo): \Libs\DataSource\Interfaces\Insert
    {
        $this->searchInfo = $searchInfo;
        return $this;
    }

    /**
     * @param $event
     * @return  \Libs\DataSource\Interfaces\Insert
     */
    function succeed($event): \Libs\DataSource\Interfaces\Insert
    {
        $this->succeedEvent = $event;
        return $this;
    }

    /**
     * @param $event
     * @return  \Libs\DataSource\Interfaces\Insert
     */
    function fail($event): \Libs\DataSource\Interfaces\Insert
    {
        $this->failEvent = $event;
        return $this;
    }

    /**
     * @param string $name
     * @param $v
     * @return  \Libs\DataSource\Interfaces\Insert
     */
    function addFieldList(string $name, $v): \Libs\DataSource\Interfaces\Insert
    {
        $this->fieldList[] = new \Libs\DataSource\Model\Field(FieldTypeEnum::FIELD, false, $name, $v, "?");
        return $this;
    }

    /**
     * @param array $fieldList
     * @return $this|\Libs\DataSource\Interfaces\Insert
     */
    function setFieldList(array $fieldList): \Libs\DataSource\Interfaces\Insert
    {
        $this->fieldList = $fieldList;
        return $this;
    }

    /**
     * @return array
     */
    function getFieldList(): array
    {
        return $this->fieldList;
    }

    /**
     * @return int
     */
    function execute(): int
    {
        $sql = "insert into " . $this->getTable();
        $fieldList = [];
        $valueList = [];
        $Param = [];
        foreach ($this->fieldList as $item) {
            $fieldList[] = "`" . $item->getName() . "`";
            $valueList[] = $item->getCompile();
            if (!$item->isCompileType()) {
                $Param[] = $item->getValue();
            }
        }
        $sql .= '(' . implode(",", $fieldList) . ') values ';
        $sql .= '(' . implode(",", $valueList) . ')';
        $count = CoreManage::$coreDataBase->Insert($sql, $Param);
//        if ($count > 0) {
//            $succeed = $this->succeedEvent;
//            $succeed($count);
//        } else {
//            $failEvent = $this->failEvent;
//            $failEvent();
//        }
        return $count;
    }

    /**
     * @return mixed|void
     */
    function executeCache(): int
    {
        return $this->execute();
    }
}