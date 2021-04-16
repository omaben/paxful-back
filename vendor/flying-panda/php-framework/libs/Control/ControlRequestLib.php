<?php


namespace Libs\Control;


use Libs\Auth\AuthUserLib;
use Libs\Client\ClientLib;

class ControlRequestLib
{
    //url地址
    private string $requestService = "";
    //结果地址
    private string $resultService = "";
    //客户端识别
    private ClientLib $client;
    //授权用户
    private AuthUserLib $user;
    //是否登录
    private AuthUserLib $isLogin;
    //结果代码
    private AuthUserLib $resultCode;

    /**
     * ControlRequestLib constructor.
     * @param string $requestService
     * @param string $resultService
     * @param ClientLib $client
     * @param AuthUserLib $user
     * @param AuthUserLib $isLogin
     */
    public function __construct(string $requestService, string $resultService, ClientLib $client, AuthUserLib $user, AuthUserLib $isLogin)
    {
        $this->requestService = $requestService;
        $this->resultService = $resultService;
        $this->client = $client;
        $this->user = $user;
        $this->isLogin = $isLogin;
    }

    /**
     * @return AuthUserLib
     */
    public function getResultCode(): AuthUserLib
    {
        return $this->resultCode;
    }

    /**
     * @param AuthUserLib $resultCode
     */
    public function setResultCode(AuthUserLib $resultCode): void
    {
        $this->resultCode = $resultCode;
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
     * @return ClientLib
     */
    public function getClient(): ClientLib
    {
        return $this->client;
    }

    /**
     * @param ClientLib $client
     */
    public function setClient(ClientLib $client): void
    {
        $this->client = $client;
    }

    /**
     * @return AuthUserLib
     */
    public function getUser(): AuthUserLib
    {
        return $this->user;
    }

    /**
     * @param AuthUserLib $user
     */
    public function setUser(AuthUserLib $user): void
    {
        $this->user = $user;
    }

    /**
     * @return AuthUserLib
     */
    public function getIsLogin(): AuthUserLib
    {
        return $this->isLogin;
    }

    /**
     * @param AuthUserLib $isLogin
     */
    public function setIsLogin(AuthUserLib $isLogin): void
    {
        $this->isLogin = $isLogin;
    }

}


