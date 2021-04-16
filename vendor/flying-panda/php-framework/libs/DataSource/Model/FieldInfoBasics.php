<?php


namespace Libs\DataSource\Model;


use Libs\DataSource\Enum\FieldTypeEnum;

class FieldInfoBasics
{
    public string $name = "";
    public array $max = [];
    public string $tableName;
    public string $tableNameMark;

    public function __construct(string $name, string $tableName)
    {
        $this->name = $name;
        $this->tableName = $tableName;
        $this->tableNameMark = lcfirst($tableName);
    }

    public function equal($val): Field
    {
        return new Field(FieldTypeEnum::WHERE, $this->name, $val, false, $this->name . " = ? ");
    }

    public function like($val): Field
    {
        return new Field(FieldTypeEnum::WHERE, $this->name, $val, false, $this->name . " like ? ");
    }

    public function less($val): Field
    {
        return new Field(FieldTypeEnum::WHERE, $this->name, $val, false, $this->name . " < ? ");
    }

    public function greater($val): Field
    {
        return new Field(FieldTypeEnum::WHERE, $this->name, $val, false, $this->name . " > ? ");
    }

    public function max(): Field
    {
        return new Field(FieldTypeEnum::FIELD, $this->name, null, false, $this->name . " max(" . $this->name . ") ");
    }

    public function min(): Field
    {
        return new Field(FieldTypeEnum::FIELD, $this->name, null, false, $this->name . " min(" . $this->name . ") ");
    }

    public function setExpression($Expression): Field
    {
        return new Field(FieldTypeEnum::FIELD, $this->name, null, true, $Expression);
    }

    public function in($val): Field
    {
        if (count($val) == 0) {
            return new Field(FieldTypeEnum::WHERE, $this->name, null, false, " false ");
        }
        $valList = implode(",", $val);
        return new Field(FieldTypeEnum::WHERE, $this->name, null, false, $this->name . " in (" . $valList . ") ");
    }

    public function orderAsc(): Field
    {
        return new Field(FieldTypeEnum::SORT, $this->name, true, false, " {$this->name} asc ");
    }

    public function orderDesc(): Field
    {
        return new Field(FieldTypeEnum::SORT, $this->name, false, false, " {$this->name} desc ");
    }

    public function groupBy($val): Field
    {
        return new Field(FieldTypeEnum::GROUP, $this->name, $val, false, $this->name);
    }

    public function set($val): Field
    {
        return new Field(FieldTypeEnum::FIELD, $this->name, $val, false, " ? ");
    }

    public function searchTransform($data): array
    {
        var_dump($this->name);
        if($this->name=="userinfo"){
           $name='equal_' . $this->name . '_' . $this->tableNameMark;
            var_dump($data->{'equal_' . $this->name . '_' . $this->tableNameMark});
            var_dump($data->{$name});
        }
        $result = [];
var_dump($data->{'equal_' . $this->name . '_' . $this->tableNameMark});
        if (isset($data->{'equal_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->equal($data->{'equal_' . $this->name . '_' . $this->tableNameMark});
        if (isset($data->{'like_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->like($data->{'like_' . $this->name . '_' . $this->tableNameMark});
        if (isset($data->{'less_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->less($data->{'less_' . $this->name . '_' . $this->tableNameMark});
        if (isset($data->{'greater_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->greater($data->{'greater_' . $this->name . '_' . $this->tableNameMark});
        if (isset($data->{'in_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->in($data->{'in_' . $this->name . '_' . $this->tableNameMark});
        if (isset($data->{'max_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->max();
        if (isset($data->{'min_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->min();
        if (isset($data->{'sortAsc_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->orderAsc();
        if (isset($data->{'sortDesc_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->orderDesc();
        if (isset($data->{'group_' . $this->name . '_' . $this->tableNameMark})) $result[] = $this->groupBy($data->{'group_' . $this->name . '_' . $this->tableNameMark});
        return $result;
    }
}