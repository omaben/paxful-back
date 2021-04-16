<?php
namespace Core\AccountCore\Model;
use Core\UserCore\Model\UserInfoCoreModel;
use Core\AccountCore\Model\AccountClassificationCoreModel;
class AccountDetailCoreModel{
public int $id = 0;
public float $money = 0;
public string $notes = "";
public string $picture = "";
public int $userInfo = 0;
public ?UserInfoCoreModel $userInfoModel;
public int $classification = 0;
public ?AccountClassificationCoreModel $classificationModel;
public string $path = "";
public string $transactionNumber = "";
public string $insertTime = "";
public string $updateTime = "";
public string $mark = "";
public int $status = 0;
}
