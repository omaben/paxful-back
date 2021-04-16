<?php


namespace Libs\DataSource\Interfaces;


interface InsertBatch
{
    /**
     * @param Insert $v
     * @return InsertBatch
     */
    function addInsertList(Insert $v): InsertBatch;

    /**
     * @return array<Insert>
     */
    function getInsertList(): array;

    /**
     * @param array<Insert> $list
     * @return InsertBatch
     */
    function setInsertList(array $list): InsertBatch;

    /**
     * @return int
     */
    function execute(): int;

    /**
     * @return mixed
     */
    function executeCache();

    /**
     * @param SearchInfo $v
     * @return InsertBatch
     */
    function setSearchInfo(SearchInfo $v): InsertBatch;
}