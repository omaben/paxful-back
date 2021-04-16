<?php


namespace Libs\Control;


use Libs\Event\EventLib;

abstract class ControlResultDataLib
{
    private ControlRequestLib $_result;

    /**
     * @return ControlRequestLib
     */
    public function getResult(): ControlRequestLib
    {
        return $this->_result;
    }

    /**
     * @param ControlRequestLib $result
     */
    public function setResult(ControlRequestLib $result): void
    {
        $this->_result = $result;
    }


    abstract function getRule(): array;

    abstract function getPermission(): array;

    abstract function action(): ControlResultLib;
}