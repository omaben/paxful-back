<?php

namespace Libs\Control;

use Inhere\Validate\Validation;
use Libs\Auth\AuthLib;
use Libs\Client\ClientLib;
use Libs\Event\EventLib;
use Manage\CoreManage;

class ControlLib
{
    //请求前
    public EventLib $beforeEvent;
    //请求后
    public EventLib $laterEvent;
    //请求中
    public EventLib $actionEvent;

    public array $rule = [];

    public array $permission = [];

    public ?\Closure $auth = null;
    public bool $login;

    function __construct()
    {
        $this->actionEvent = new EventLib();
        $this->laterEvent = new EventLib();
        $this->beforeEvent = new EventLib();
    }

    /**
     * @return bool
     */
    public function isLogin(): bool
    {
        return $this->login;
    }

    /**
     * @param bool $login
     * @return ControlLib
     */
    public function setLogin(bool $login): ControlLib
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return \Closure
     */
    public function getAuth(): \Closure
    {
        return $this->auth;
    }

    /**
     * @param \Closure $auth
     * @return ControlLib
     */
    public function setAuth(\Closure $auth): ControlLib
    {
        $this->auth = $auth;
        return $this;
    }

    /**
     * @return array
     */
    public function getRule(): array
    {
        return $this->rule;
    }

    /**
     * @param array $rule
     */
    public function setRule(array $rule): ControlLib
    {
        $this->rule = $rule;
        return $this;
    }

    /**
     * @return array
     */
    public function getPermission(): array
    {
        return $this->permission;
    }

    /**
     * @param array $permission
     */
    public function setPermission(array $permission): void
    {
        $this->permission = $permission;
    }


    function addAction($fun)
    {
        $this->actionEvent->addEvent($fun);
        return $this;
    }

    function addBefore($fun)
    {
        $this->beforeEvent->addEvent($fun);
        return $this;
    }

    function addLater($fun)
    {
        $this->laterEvent->addEvent($fun);
        return $this;
    }

    public function register(string $path)
    {
        CoreManage::$serviceEvent[$path] = $this;
    }

    public function runAction(ClientLib $client, $parameters)
    {
        $checkParameters = Validation::check($parameters, $this->getRule());
        if ($checkParameters->isFail()) {
            $client->Send((new ControlResultLib(false, "IncorrectParameter"))->setData($checkParameters->getErrors()));
            return;
        }
        // if (!$this->getPermission()) {
        // $client->Send((new ControlResultLib(false, "IncorrectParameter"))->setData($checkParameters->getErrors()));
        // }
        $data = json_decode(json_encode($parameters), false);
        //var_dump($this->auth);
        $auth = $this->auth != null ? $this->getAuth()($client->getClientID()) : null;
        if (!empty($this->auth) && $auth == null) {
            $client->Send((new ControlResultLib(false, "NotLogin"))->setData($checkParameters->getErrors()));
            return;
        }
        $this->beforeEvent->Run($data, $auth, $client);
        $this->actionEvent->Run($data, $auth, $client);
        $this->laterEvent->Run($data, $auth, $client);
    }
}