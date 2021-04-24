<?php
namespace Core\AccountCore\Field;
use Libs\DataSource\Enum\FieldTypeEnum;
use Libs\DataSource\Model\Field;
use Libs\DataSource\Model\FieldInfoBasics;
class AccountDetailCoreField{
 public FieldInfoBasics $id;
 public FieldInfoBasics $money;
 public FieldInfoBasics $notes;
 public FieldInfoBasics $picture;
 public FieldInfoBasics $userInfo;
 public FieldInfoBasics $classification;
 public FieldInfoBasics $path;
 public FieldInfoBasics $transactionNumber;
 public FieldInfoBasics $insertTime;
 public FieldInfoBasics $updateTime;
 public FieldInfoBasics $mark;
 public FieldInfoBasics $status;
	public function __construct(){
		$this->id = new FieldInfoBasics('id','AccountDetail');
		$this->money = new FieldInfoBasics('money','AccountDetail');
		$this->notes = new FieldInfoBasics('notes','AccountDetail');
		$this->picture = new FieldInfoBasics('picture','AccountDetail');
		$this->userInfo = new FieldInfoBasics('userInfo','AccountDetail');
		$this->classification = new FieldInfoBasics('classification','AccountDetail');
		$this->path = new FieldInfoBasics('path','AccountDetail');
		$this->transactionNumber = new FieldInfoBasics('transactionNumber','AccountDetail');
		$this->insertTime = new FieldInfoBasics('insertTime','AccountDetail');
		$this->updateTime = new FieldInfoBasics('updateTime','AccountDetail');
		$this->mark = new FieldInfoBasics('mark','AccountDetail');
		$this->status = new FieldInfoBasics('status','AccountDetail');
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
		if(isset($data->money)){ $fieldList[] = $this->money->set($data->money); }
		if(isset($data->notes)){ $fieldList[] = $this->notes->set($data->notes); }
		if(isset($data->picture)){ $fieldList[] = $this->picture->set($data->picture); }
		if(isset($data->userInfo)){ $fieldList[] = $this->userInfo->set($data->userInfo); }
		if(isset($data->classification)){ $fieldList[] = $this->classification->set($data->classification); }
		if(isset($data->path)){ $fieldList[] = $this->path->set($data->path); }
		if(isset($data->transactionNumber)){ $fieldList[] = $this->transactionNumber->set($data->transactionNumber); }
		if(isset($data->insertTime)){ $fieldList[] = $this->insertTime->set($data->insertTime); }
		if(isset($data->updateTime)){ $fieldList[] = $this->updateTime->set($data->updateTime); }
		if(isset($data->mark)){ $fieldList[] = $this->mark->set($data->mark); }
		if(isset($data->status)){ $fieldList[] = $this->status->set($data->status); }
		return $fieldList;
	}

	public function where($expression)
	{
		return new Field(FieldTypeEnum::WHERE, '', null, true, " {$expression} ");
	}
}
