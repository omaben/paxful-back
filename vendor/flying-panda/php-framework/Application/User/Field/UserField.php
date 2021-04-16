<?php

use Libs\DataSource\Model\FieldInfo;

class UserField
{
    public FieldInfo $Id;
    public FieldInfo $Name;
    public FieldInfo $Password;

    public function __construct()
    {
        $this->Name = new FieldInfo("Id");
        $this->Name = new FieldInfo("Name");
        $this->Password = new FieldInfo("Password");
    }


    public function searchTransform(array $data)
    { 
        $searchList = [];
        foreach ($this as $key => $value) {
            if ($value instanceof FieldInfo) {
                $searchList = array_merge($searchList, $value->searchTransform($data));
            }
        }
        return $searchList;
    }

    public function fieldTransform(array $data)
    {
        $fieldList = [];
        foreach ($this as $key => $value) {
            if ($value instanceof FieldInfo && isset($data[$value->name])) {
                $searchList[] = $value->set($data[$value->name]);
            }
        }
        return $fieldList;
    }
}