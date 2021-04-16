<?php


namespace Libs\DataSource\Interfaces;


interface DataSource
{
    /**
     * @return Insert
     */
    function insert(): Insert;

    /**
     * @return InsertBatch
     */
    function insertBatch(): InsertBatch;

    /**
     * @return Update
     */
    function update(): Update;

    /**
     * @param array $list
     * @return SearchInfo
     */
    function searchInfo(array $list = []): SearchInfo;

    /**
     * @return Search
     */
    function search(): Search;

    /**
     * @return Delete
     */
    function delete(): Delete;
}