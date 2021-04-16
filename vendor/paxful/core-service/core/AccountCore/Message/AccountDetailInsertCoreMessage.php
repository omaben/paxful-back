<?php
namespace Core\AccountCore\Message;
use Core\UserCore\Model\UserInfoCoreModel;
use Core\AccountCore\Model\AccountClassificationCoreModel;
class AccountDetailInsertCoreMessage{
public int $id = 0;
public float $money = 0;
public string $notes = "";
public string $picture = "";
public int $userInfo = 0;
public ?object $userInfoModel;
public int $classification = 0;
public ?object $classificationModel;
public string $path = "";
public string $transactionNumber = "";
public string $insertTime = "";
public string $updateTime = "";
public string $mark = "";
public int $status = 0;
}
