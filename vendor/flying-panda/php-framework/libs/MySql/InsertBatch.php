<?php


namespace Libs\MySql;

use Closure;
use Libs\DataSource\Interfaces\SearchInfo;
use Libs\Queue\QueueListen;
use Manage\CoreManage;

class InsertBatch implements \Libs\DataSource\Interfaces\InsertBatch
{
    private array $insertList;
    private SearchInfo $searchInfo;
    private Closure $succeedEvent;
    private Closure $failEvent;

    /**
     * @param \Libs\DataSource\Interfaces\Insert $insert
     * @return InsertBatch
     */
    public function addInsertList(\Libs\DataSource\Interfaces\Insert $insert): InsertBatch
    {
        $this->insertList[] = $insert;
        return $this;
    }

    /**
     * @return array
     */
    public function getInsertList(): array
    {
        return $this->insertList;
    }

    /**
     * @param array $InsertList
     * @return InsertBatch
     */
    public function setInsertList(array $InsertList): InsertBatch
    {
        $this->InsertList = $InsertList;
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
     * @param SearchInfo $SearchInfo
     * @return InsertBatch
     */
    public function setSearchInfo(SearchInfo $SearchInfo): InsertBatch
    {
        $this->searchInfo = $SearchInfo;
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
     * @return \Libs\DataSource\Interfaces\InsertBatch
     */
    public function setSucceedEvent(Closure $succeedEvent): \Libs\DataSource\Interfaces\InsertBatch
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
     * @return \Libs\DataSource\Interfaces\InsertBatch
     */
    public function setFailEvent(Closure $failEvent): \Libs\DataSource\Interfaces\InsertBatch
    {
        $this->failEvent = $failEvent;
        return $this;
    }

    function execute(): int
    {
        $sql = "insert into " . $this->getTable();
        $fieldList = [];

        foreach ($this->insertList[0]->getFieldList() as $item) {
            $fieldList[] = "`" . $item->getName() . "`";
        }
        $sql .= '(' . implode(",", $fieldList) . ') values ';
        $parameterList = [];
        foreach ($this->insertList as $item) {
            $itemList = $item->getFieldList();
            $valueList = [];
            foreach ($itemList as $fieldItem) {
                $valueList[] = $fieldItem->getCompile();
                if (!$fieldItem->getType()) {
                    $parameterList[] = $fieldItem->getValue();
                }
            }
            $sql .= implode(",", $valueList);
        }
//        $count = CoreManage::$CoreDataBase->Insert($sql, $parameterList);
//        if ($count > 0) {
//            $succeed = $this->succeedEvent;
//            $succeed($count);
//        } else {
//            $failEvent = $this->failEvent;
//            $failEvent();
//        }
    }

    function executeCache()
    {

    }
}