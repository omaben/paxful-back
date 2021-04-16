<?php
namespace Core\AccountCore\Model;
use Core\UserCore\Model\UserInfoCoreModel;
class AccountInfoCoreModel{
public int $id = 0;
public string $bankCardNum = "";
public string $name = "";
public string $bankAddress = "";
public string $bankName = "";
public string $path = "";
public string $mark = "";
public string $inserTime = "";
public string $updateTime = "";
public int $userInfo = 0;
public ?UserInfoCoreModel $userInfoModel;
}
