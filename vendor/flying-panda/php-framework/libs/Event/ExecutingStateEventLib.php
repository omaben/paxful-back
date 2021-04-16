<?php


namespace Libs\Event;


class ExecutingStateEventLib
{
    public string $message;
    public bool $succeed;
    public $data;

    /**
     * ExecutingStateEventLib constructor.
     * @param bool $succeed
     * @param string $message
     * @param array $data
     */
    public function __construct(bool $succeed, string $message, $data = [])
    {
        $this->succeed = $succeed;
        $this->message = $message;
        $this->data = $data;
    }

}