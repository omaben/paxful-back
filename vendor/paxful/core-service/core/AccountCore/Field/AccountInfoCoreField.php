<?php
namespace Core\AccountCore\Field;
use Libs\DataSource\Enum\FieldTypeEnum;
use Libs\DataSource\Model\Field;
use Libs\DataSource\Model\FieldInfoBasics;
class AccountInfoCoreField{
 public FieldInfoBasics $id;
 public FieldInfoBasics $bankCardNum;
 public FieldInfoBasics $name;
 public FieldInfoBasics $bankAddress;
 public FieldInfoBasics $bankName;
 public FieldInfoBasics $path;
 public FieldInfoBasics $mark;
 public FieldInfoBasics $inserTime;
 public FieldInfoBasics $updateTime;
 public FieldInfoBasics $userInfo;
	public function __construct(){
		$this->id = new FieldInfoBasics('id','AccountInfo');
		$this->bankCardNum = new FieldInfoBasics('bankCardNum','AccountInfo');
		$this->name = new FieldInfoBasics('name','AccountInfo');
		$this->bankAddress = new FieldInfoBasics('bankAddress','AccountInfo');
		$this->bankName = new FieldInfoBasics('bankName','AccountInfo');
		$this->path = new FieldInfoBasics('path','AccountInfo');
		$this->mark = new FieldInfoBasics('mark','AccountInfo');
		$this->inserTime = new FieldInfoBasics('inserTime','AccountInfo');
		$this->updateTime = new FieldInfoBasics('updateTime','AccountInfo');
		$this->userInfo = new FieldInfoBasics('userInfo','AccountInfo');
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
		if(isset($data->bankCardNum)){ $fieldList[] = $this->bankCardNum->set($data->bankCardNum); }
		if(isset($data->name)){ $fieldList[] = $this->name->set($data->name); }
		if(isset($data->bankAddress)){ $fieldList[] = $this->bankAddress->set($data->bankAddress); }
		if(isset($data->bankName)){ $fieldList[] = $this->bankName->set($data->bankName); }
		if(isset($data->path)){ $fieldList[] = $this->path->set($data->path); }
		if(isset($data->mark)){ $fieldList[] = $this->mark->set($data->mark); }
		if(isset($data->inserTime)){ $fieldList[] = $this->inserTime->set($data->inserTime); }
		if(isset($data->updateTime)){ $fieldList[] = $this->updateTime->set($data->updateTime); }
		if(isset($data->userInfo)){ $fieldList[] = $this->userInfo->set($data->userInfo); }
		return $fieldList;
	}

	public function where($expression)
	{
		return new Field(FieldTypeEnum::WHERE, '', null, true, " {$expression} ");
	}
}
