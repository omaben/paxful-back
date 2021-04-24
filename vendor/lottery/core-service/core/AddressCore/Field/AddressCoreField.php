<?php
namespace Core\AddressCore\Field;
use Libs\DataSource\Enum\FieldTypeEnum;
use Libs\DataSource\Model\Field;
use Libs\DataSource\Model\FieldInfoBasics;

class AddressCoreField{
    public FieldInfoBasics $id;
    public FieldInfoBasics $user_id;
    public FieldInfoBasics $crypto_currency_code;
    public FieldInfoBasics $address;
    public FieldInfoBasics $insertTime;
    public FieldInfoBasics $updateTime;
    public function __construct(){
        $this->id = new FieldInfoBasics('id','Address');
        $this->user_id = new FieldInfoBasics('user_id','Address');
        $this->crypto_currency_code = new FieldInfoBasics('crypto_currency_code','Address');
        $this->address = new FieldInfoBasics('address','Address');
        $this->insertTime = new FieldInfoBasics('insertTime','Address');
        $this->updateTime = new FieldInfoBasics('updateTime','Address');
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
        if(isset($data->crypto_currency_code)){ $fieldList[] = $this->crypto_currency_code->set($data->crypto_currency_code); }
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