<?php


namespace Libs\Auth;


use Application\User\Result\UserLoginRequest;
use Libs\Client\ClientLib;
use Libs\DataSource\Model\FieldInfoBasics;
use Libs\Event\ExecutingStateEventLib;
use Libs\Redis\RedisManageLib;

abstract class AuthManageLib
{
    public RedisManageLib $userManage;
    public RedisManageLib $tokenManage;
    public FieldInfoBasics $name;
    public FieldInfoBasics $password;
    public FieldInfoBasics $tel;
    public FieldInfoBasics $code;
    public FieldInfoBasics $token;
    public string $pre;

    function __construct($pre)
    {
        $this->userManage = new RedisManageLib('Auth.' . $pre);
        $this->setPre($pre);
        $this->name = new FieldInfoBasics("name", $pre);
        $this->password = new FieldInfoBasics("password", $pre);
        $this->tel = new FieldInfoBasics("tel", $pre);
        $this->code = new FieldInfoBasics("code", $pre);
        $this->token = new FieldInfoBasics("token", $pre);
    }

    /**
     * @return string
     */
    public function getPre(): string
    {
        return $this->pre;
    }

    /**
     * @param string $pre
     * @return AuthManageLib
     */
    public function setPre(string $pre): AuthManageLib
    {
        $this->pre = $pre;
        return $this;
    }

    abstract function register(object $data, object $auth, ClientLib $client);

    abstract function getUserInfo($data = []);

    function getOnlineUserInfo($client)
    {
        return $this->userManage->get($client);
    }

    function loginWithName($client, $name): \Libs\Control\ControlResultLib
    {
        $user = $this->getUserInfo(['name' => $name]);

        if ($user == null) {
            return AuthLoginRequestLib::NameDoesNotExist();
        }

        if ($user->state != 1) {
            return AuthLoginRequestLib::LoginDisallowed();
        }

        $this->userManage->set($user->Id, $user);
        return AuthLoginRequestLib::loginSuccess();
    }

    function loginWithMobile($client, $name): \Libs\Control\ControlResultLib
    {
        $user = $this->getUserInfo(['mobile' => $name]);

        if ($user == null) {
            return AuthLoginRequestLib::NameDoesNotExist();
        }

        if ($user->state != 1) {
            return AuthLoginRequestLib::LoginDisallowed();
        }

        $this->userManage->set($user->Id, $user);
        return AuthLoginRequestLib::loginSuccess();
    }

    function loginWithNameAndPassword($client, $name, $password): \Libs\Control\ControlResultLib
    {
        $user = $this->getUserInfo([
            $this->name->equal($name),
        ]);
        if ($user == null) {
            return AuthLoginRequestLib::NameDoesNotExist();
        }
        if ($user->password != md5(md5($password) . $user->salt)) {
            return AuthLoginRequestLib::PasswordError();
        }
        if ($user->state) {
            return AuthLoginRequestLib::LoginDisallowed();
        }
        $this->userManage->set($client, $user);
        return AuthLoginRequestLib::loginSuccess($user);
    }


    function loginWithNameAndCode($client, $name, $code): \Libs\Control\ControlResultLib
    {
        $user = $this->getUserInfo(['name' => $name, 'code' => $code]);

        if ($user == null) {
            return AuthLoginRequestLib::NameDoesNotExist();
        }

        if ($user->state) {
            return AuthLoginRequestLib::LoginDisallowed();
        }

        $this->userManage->set($user->Id, $user);
        return AuthLoginRequestLib::loginSuccess();
    }

    function loginWithMobileAndPassword($client, $name, $password): \Libs\Control\ControlResultLib
    {
        $user = $this->getUserInfo(['tel' => $name, 'password' => $password]);

        if ($user == null) {
            return AuthLoginRequestLib::NameDoesNotExist();
        }

        if ($user->state) {
            return AuthLoginRequestLib::LoginDisallowed();
        }

        $this->userManage->set($user->Id, $user);
        return AuthLoginRequestLib::loginSuccess();
    }

    function loginWithMobileAndCode($client, $name, $password): \Libs\Control\ControlResultLib
    {
        $user = $this->getUserInfo(['tel' => $name, 'code' => $password]);

        if ($user == null) {
            return AuthLoginRequestLib::NameDoesNotExist();
        }

        if ($user->state) {
            return AuthLoginRequestLib::LoginDisallowed();
        }

        $this->userManage->set($user->Id, $user);
        return AuthLoginRequestLib::loginSuccess();
    }

    function loginWithToken($client, $name, $token): \Libs\Control\ControlResultLib
    {
        $user = $this->getUserInfo(['name' => $name, 'token' => $token]);

        if ($user == null) {
            return AuthLoginRequestLib::NameDoesNotExist();
        }

        if ($user->state) {
            return AuthLoginRequestLib::LoginDisallowed();
        }

        $this->userManage->set($user->Id, $user);
        return AuthLoginRequestLib::loginSuccess();
    }

    function Auth(): \Closure
    {
        return function ($client) {
            return $this->checkLogin($client);
        };
    }

    function checkLogin($client)
    {
        return $this->userManage->get($client);
    }

    function logout($client)
    {
        $this->userManage->del($client);
        return new ExecutingStateEventLib(true, "ExitSuccess");
    }
}