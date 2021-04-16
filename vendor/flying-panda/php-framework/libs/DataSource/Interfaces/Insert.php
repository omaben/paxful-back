<?php


namespace Libs\DataSource\Interfaces;


use Closure;

interface Insert
{
    /**
     * @return Closure
     */
    public function getSucceedEvent();

    /**
     * @param Closure $succeedEvent
     * @return Insert
     */
    public function setSucceedEvent(Closure $succeedEvent):Insert;

    /**
     * @return Closure
     */
    public function getFailEvent(): Closure;

    /**
     * @param Closure $failEvent
     * @return Insert
     */
    public function setFailEvent(Closure $failEvent): Insert;

    /**
     * @return SearchInfo
     */
    public function getSearchInfo(): SearchInfo;

    /**
     * @param SearchInfo $searchInfo
     * @return Insert
     */
    public function setSearchInfo(SearchInfo $searchInfo): Insert;

    /**
     * @param $event
     * @return Insert
     */
    function succeed($event): Insert;

    /**
     * @param $event
     * @return Insert
     */
    function fail($event): Insert;

    /**
     * @param string $name
     * @param $v
     * @return $this
     */
    function addFieldList(string $name, $v): Insert;

    /**
     * @param array $fieldList
     * @return $this|Insert
     */
    function setFieldList(array $fieldList): Insert;

    /**
     * @return array<Field>
     */
    function getFieldList(): array;

    /**
     * @return int
     */
    function execute(): int;

    /**
     * @return mixed|void
     */
    function executeCache(): int;

    function from($table): Insert;
}