<?php


namespace Libs\DataSource\Interfaces;


interface Update
{
    /**
     * @param string $name
     * @param $v
     * @return Update
     */
    function addFieldList(string $name, $v): Update;

    /**
     * @param array<Field> $FieldList
     * @return Update
     */
    function setFieldList(array $FieldList): Update;

    /**
     * @return array<Field>
     */
    function getFieldList(): array;

    /**
     * @return SearchInfo
     */
    function getSearchInfo(): SearchInfo;

    /**
     * @param SearchInfo $v
     * @return Update
     */
    function setSearchInfo(SearchInfo $v): Update;

    /**
     * @return int
     */
    function execute(): int;

    /**
     * @return mixed
     */
    function executeCache();

    /**
     * @param $event
     * @return Update
     */
    function succeed($event): Update;

    /**
     * @param $event
     * @return Update
     */
    function fail($event): Update;

    function from($table): Update;
}