<?php


namespace Libs\DataSource\Interfaces;


interface Search
{
    /**
     * @param string $val
     * @return Search
     */
    function addFieldList(string $val): Search;

    /**
     * @return array<string>
     */
    function getFieldList(): array;

    /**
     * @param array<Field> $fieldList
     * @return Search
     */
    function setFieldList(array $fieldList): Search;

    /**
     * @param $event
     * @return Search
     */
    function succeed($event): Search;

    /**
     * @param $event
     * @return Search
     */
    function succeedItem($event): Search;

    /**
     * @param $event
     * @return Search
     */
    function fail($event): Search;

    /**
     * @param string $name
     * @return Search
     */
    function from(string $name) :Search;

    /**
     * @param SearchInfo $v
     * @return SearchInfo
     */
	function getSearchInfo(): SearchInfo;

    /**
     * @param SearchInfo $v
     * @return Search
     */
	function setSearchInfo(SearchInfo $v): Search;

    /**
     * @param int $page
     * @param int $count
     * @return mixed
     */
	function execute(int $page, int $count);

    /**
     * @return mixed
     */
	function getOne();
}