<?php


namespace Libs\DataSource\Model;

use Libs\Event\EventLib;

class DataBaseEvent
{
    private static EventLib $onInsertBefore;
    private static EventLib $onInsertLater;
    private static EventLib $onUpdateBefore;
    private static EventLib $onUpdateLater;
    private static EventLib $onInsertBatchBefore;
    private static EventLib $onInsertBatchLater;
    private static EventLib $onGetOneBefore;
    private static EventLib $onGetOneLater;

    private static EventLib $onSearchBefore;
    private static EventLib $onSearchLater;

    public static function init()
    {
        self::$onInsertBefore = new EventLib();
        self::$onInsertLater = new EventLib();

        self::$onUpdateBefore = new EventLib();
        self::$onUpdateLater = new EventLib();

        self::$onInsertBatchBefore = new EventLib();
        self::$onInsertBatchLater = new EventLib();

        self::$onGetOneBefore = new EventLib();
        self::$onGetOneLater = new EventLib();

        self::$onSearchBefore = new EventLib();
        self::$onSearchLater = new EventLib();
    }

    /**
     * @return EventLib
     */
    public static function getOnSearchBefore(): EventLib
    {
        return self::$onSearchBefore;
    }

    /**
     * @param EventLib $onSearchBefore
     */
    public static function setOnSearchBefore(EventLib $onSearchBefore): void
    {
        self::$onSearchBefore = $onSearchBefore;
    }

    /**
     * @return EventLib
     */
    public static function getOnSearchLater(): EventLib
    {
        return self::$onSearchLater;
    }

    /**
     * @param EventLib $onSearchLater
     */
    public static function setOnSearchLater(EventLib $onSearchLater): void
    {
        self::$onSearchLater = $onSearchLater;
    }

    /**
     * @return EventLib
     */
    public static function getOnInsertBefore(): EventLib
    {
        return self::$onInsertBefore;
    }

    /**
     * @param EventLib $onInsertBefore
     */
    public static function setOnInsertBefore(EventLib $onInsertBefore): void
    {
        self::$onInsertBefore = $onInsertBefore;
    }

    /**
     * @return EventLib
     */
    public static function getOnInsertLater(): EventLib
    {
        return self::$onInsertLater;
    }

    /**
     * @param EventLib $onInsertLater
     */
    public static function setOnInsertLater(EventLib $onInsertLater): void
    {
        self::$onInsertLater = $onInsertLater;
    }

    /**
     * @return EventLib
     */
    public static function getOnUpdateBefore(): EventLib
    {
        return self::$onUpdateBefore;
    }

    /**
     * @param EventLib $onUpdateBefore
     */
    public static function setOnUpdateBefore(EventLib $onUpdateBefore): void
    {
        self::$onUpdateBefore = $onUpdateBefore;
    }

    /**
     * @return EventLib
     */
    public static function getOnUpdateLater(): EventLib
    {
        return self::$onUpdateLater;
    }

    /**
     * @param EventLib $onUpdateLater
     */
    public static function setOnUpdateLater(EventLib $onUpdateLater): void
    {
        self::$onUpdateLater = $onUpdateLater;
    }

    /**
     * @return EventLib
     */
    public static function getOnInsertBatchBefore(): EventLib
    {
        return self::$onInsertBatchBefore;
    }

    /**
     * @param EventLib $onInsertBatchBefore
     */
    public static function setOnInsertBatchBefore(EventLib $onInsertBatchBefore): void
    {
        self::$onInsertBatchBefore = $onInsertBatchBefore;
    }

    /**
     * @return EventLib
     */
    public static function getOnInsertBatchLater(): EventLib
    {
        return self::$onInsertBatchLater;
    }

    /**
     * @param EventLib $onInsertBatchLater
     */
    public static function setOnInsertBatchLater(EventLib $onInsertBatchLater): void
    {
        self::$onInsertBatchLater = $onInsertBatchLater;
    }

    /**
     * @return EventLib
     */
    public static function getOnGetOneBefore(): EventLib
    {
        return self::$onGetOneBefore;
    }

    /**
     * @param EventLib $onGetOneBefore
     */
    public static function setOnGetOneBefore(EventLib $onGetOneBefore): void
    {
        self::$onGetOneBefore = $onGetOneBefore;
    }

    /**
     * @return EventLib
     */
    public static function getOnGetOneLater(): EventLib
    {
        return self::$onGetOneLater;
    }

    /**
     * @param EventLib $onGetOneLater
     */
    public static function setOnGetOneLater(EventLib $onGetOneLater): void
    {
        self::$onGetOneLater = $onGetOneLater;
    }


}