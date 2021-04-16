<?php


namespace Libs\Control;


class ControlResultLib
{
    public string $requestService = "";
    public string $resultService = "";
    public string $resultCode = "";
    public bool $status = false;
    public string $message = "";
    public $data;

    /**
     * ControlResultLib constructor.
     * @param bool $status
     * @param string $message
     * @param string $resultCode
     * @param string $requestService
     * @param string $resultService
     */
    public function __construct(bool $status, string $message, string $resultCode = "", string $requestService = "", string $resultService = "")
    {
        $this->requestService = $requestService;
        $this->resultService = $resultService;
        $this->resultCode = $resultCode;
        $this->status = $status;
        $this->message = $message;
    }


    /**
     * @return string
     */
    public function getRequestService(): string
    {
        return $this->requestService;
    }

    /**
     * @param string $requestService
     */
    public function setRequestService(string $requestService): void
    {
        $this->requestService = $requestService;
    }

    /**
     * @return string
     */
    public function getResultService(): string
    {
        return $this->resultService;
    }

    /**
     * @param string $resultService
     */
    public function setResultService(string $resultService): void
    {
        $this->resultService = $resultService;
    }

    /**
     * @return string
     */
    public function getResultCode(): string
    {
        return $this->resultCode;
    }

    /**
     * @param string $resultCode
     */
    public function setResultCode(string $resultCode): void
    {
        $this->resultCode = $resultCode;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function getMessage(): bool
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return object
     */
    public function getData(): object
    {
        return $this->data;
    }

    /**
     * @param $data
     * @return ControlResultLib
     */
    public function setData($data): ControlResultLib
    {
        $this->data = $data;
        return $this;
    }
}