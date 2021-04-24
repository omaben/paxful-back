<?php
namespace Core\AddressCore\Message;

class AddressInsertCoreMessage{
    public int $id = 0;
    public int $user_id=null;
    public int $crypto_currency_code=null;
    public string $address = "";
    public string $insertTime = "";
    public string $updateTime = "";
}
