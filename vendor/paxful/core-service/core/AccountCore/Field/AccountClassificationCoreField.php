<?php
namespace Core\AccountCore\Field;
use Libs\DataSource\Enum\FieldTypeEnum;
use Libs\DataSource\Model\Field;
use Libs\DataSource\Model\FieldInfoBasics;
class AccountClassificationCoreField{
 public FieldInfoBasics $id;
 public FieldInfoBasics $name;
 public FieldInfoBasics $icon;
 public FieldInfoBasics $path;
 public FieldInfoBasics $insertTime;
 public FieldInfoBasics $updateTime;
 public FieldInfoBasics $mark;
	public function __construct(){
		$this->id = new FieldInfoBasics('id','AccountClassification');
		$this->name = new FieldInfoBasics('name','AccountClassification');
		$this->icon = new FieldInfoBasics('icon','AccountClassification');
		$this->path = new FieldInfoBasics('path','AccountClassification');
		$this->insertTime = new FieldInfoBasics('insertTime','AccountClassification');
		$this->updateTime = new FieldInfoBasics('updateTime','AccountClassification');
		$this->mark = new FieldInfoBasics('mark','AccountClassification');
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
		if(isset($data->name)){ $fieldList[] = $this->name->set($data->name); }
		if(isset($data->icon)){ $fieldList[] = $this->icon->set($data->icon); }
		if(isset($data->path)){ $fieldList[] = $this->path->set($data->path); }
		if(isset($data->insertTime)){ $fieldList[] = $this->insertTime->set($data->insertTime); }
		if(isset($data->updateTime)){ $fieldList[] = $this->updateTime->set($data->updateTime); }
		if(isset($data->mark)){ $fieldList[] = $this->mark->set($data->mark); }
		return $fieldList;
	}

	public function where($expression)
	{
		return new Field(FieldTypeEnum::WHERE, '', null, true, " {$expression} ");
	}
}
