<?php

namespace Libs\Event;

class EventLib
{
    private array $eventList = [];

    function addEvent($event): int
    {
        $this->eventList[] = $event;
        return count($this->eventList);
    }

    function run(...$arg)
    {
        foreach ($this->eventList as $event) {
            $event(...$arg);
        }
    }
}
