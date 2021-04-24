<?php
namespace Core\WalletCore\Message;

class WalletBalanceInsertCoreMessage{
    public int $id = 0;
    public int $user_id=0;
    public string $balance = "";
    public string $incoming_amount = "";
    public string $address = "";
    public string $balance_escrow = "";
    public string $insertTime = "";
    public string $updateTime = "";
}
