<?php
namespace Core\WalletCore\Field;
use Libs\DataSource\Enum\FieldTypeEnum;
use Libs\DataSource\Model\Field;
use Libs\DataSource\Model\FieldInfoBasics;

class WalletBalanceCoreField{
    public FieldInfoBasics $id;
    public FieldInfoBasics $user_id;
    public FieldInfoBasics $balance;
    public FieldInfoBasics $address;
    public FieldInfoBasics $incoming_amount;
    public FieldInfoBasics $balance_escrow;
    public FieldInfoBasics $insertTime;
    public FieldInfoBasics $updateTime;
    public function __construct(){
        $this->id = new FieldInfoBasics('id','WalletBalance');
        $this->user_id = new FieldInfoBasics('user_id','WalletBalance');
        $this->balance = new FieldInfoBasics('balance','WalletBalance');
        $this->address = new FieldInfoBasics('address','WalletBalance');
        $this->balance_escrow = new FieldInfoBasics('balance_escrow','WalletBalance');
        $this->incoming_amount = new FieldInfoBasics('incoming_amount','WalletBalance');
        $this->insertTime = new FieldInfoBasics('insertTime','WalletBalance');
        $this->updateTime = new FieldInfoBasics('updateTime','WalletBalance');
    }

    public function searchTransform(object $data)
    {
        $searchList = [];
        foreach ($this as $key => $value) {
            if ($value instanceof FieldInfoBasics) {
                $searchList = array_merge($searchList, $value->searchTransform($data));
            }
        }
        return $searchList;
    }

    public function fieldTransform(object $data)
    {
        $fieldList = [];
        if(isset($data->user_id)){ $fieldList[] = $this->user_id->set($data->user_id); }
        if(isset($data->balance)){ $fieldList[] = $this->balance->set($data->balance); }
        if(isset($data->balance_escrow)){ $fieldList[] = $this->balance_escrow->set($data->balance_escrow); }
        if(isset($data->incoming_amount)){ $fieldList[] = $this->incoming_amount->set($data->incoming_amount); }
        if(isset($data->insertTime)){ $fieldList[] = $this->insertTime->set($data->insertTime); }
        if(isset($data->updateTime)){ $fieldList[] = $this->updateTime->set($data->updateTime); }
        if(isset($data->address)){ $fieldList[] = $this->address->set($data->address); }
        return $fieldList;
    }

    public function where($expression)
    {
        return new Field(FieldTypeEnum::WHERE, '', null, true, " {$expression} ");
    }
}