<?php


namespace Libs\DataSource\Interfaces;


interface SearchInfo
{
    /**
     * @param array $field
     * @return SearchInfo
     */
    function setList(array $field): SearchInfo;

    /**
     * @param string $field
     * @param $v
     * @return SearchInfo
     */
    function equal(string $field, $v): SearchInfo;

    /**
     * @param string $field
     * @param $v
     * @return SearchInfo
     */
    function noEqual(string $field, $v): SearchInfo;

    /**
     * @param string $field
     * @param $v
     * @return SearchInfo
     */
    function greater(string $field, $v): SearchInfo;

    /**
     * @param string $field
     * @param $v
     * @return SearchInfo
     */
    function less(string $field, $v): SearchInfo;

    /**
     * @param string $field
     * @param $v
     * @return SearchInfo
     */
    function like(string $field, $v): SearchInfo;

    /**
     * @param string $field
     * @param $v
     * @return SearchInfo
     */
    function in(string $field, $v): SearchInfo;

    /**
     * @param string $field
     * @param $v
     * @return SearchInfo
     */
    function notIn(string $field, $v): SearchInfo;

    function addOrderByList(string $name, bool $sort);

    function setOrderByList(array $orderBy): SearchInfo;

    function getOrderByList(): array;

    function addGroupByList(string $name);

    function setGroupByList(array $orderBy): SearchInfo;

    function getGroupByList(): array;

    function execute(): array;
}