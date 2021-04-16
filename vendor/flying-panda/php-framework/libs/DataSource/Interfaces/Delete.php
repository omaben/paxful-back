<?php


namespace Libs\DataSource\Interfaces;


interface Delete
{
    /**
     * @return SearchInfo
     */
    function getSearchInfo(): SearchInfo;

    /**
     * @param SearchInfo $v
     * @return Delete
     */
    function setSearchInfo(SearchInfo $v): Delete;

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
     * @return Delete
     */
    function succeed($event): Delete;

    /**
     * @param $event
     * @return Delete
     */
    function fail($event): Delete;

    /**
     * @param $table
     * @return Delete
     */
    function from($table): Delete;
}