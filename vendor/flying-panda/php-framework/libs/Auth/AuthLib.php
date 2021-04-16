<?php


namespace Libs\Auth;

class AuthLib
{
    private array $permission = [];
    /**
     * @var object|null|AuthUserLib
     */
    private ?object $user;
    private bool $isLogin;

    /**
     * AuthLib constructor.
     * @param object|null|AuthUserLib $user
     * @param bool $isLogin
     * @param array $permission
     */
    public function __construct($user, bool $isLogin = true, array $permission = [])
    {
        $this->permission = $permission;
        $this->user = $user;
        $this->isLogin = $isLogin;
    }

    public function getUser()
    {
        if (empty($this->user)) {
            return null;
        }
        return $this->user;
    }

    public function setUser(AuthUserLib $user): AuthLib
    {
        $this->user = $user;
        return $this;
    }


    public function getPermission(): array
    {
        return $this->permission;
    }

    public function setPermission(array $permission): AuthLib
    {
        $this->permission = $permission;
        return $this;
    }

    function checkPermission(): bool
    {
        if ($this->isLogin && empty($user)) {
            return false;
        }
        foreach ($this->permission as $item) {
            if (in_array($item, $this->user->getPermissionList())) {
                return false;
            }
        }
        return true;
    }
}