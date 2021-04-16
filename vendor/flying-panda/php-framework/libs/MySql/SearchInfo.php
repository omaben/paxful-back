<?php


namespace Libs\MySql;


use Libs\DataSource\Enum\FieldTypeEnum;
use Libs\DataSource\Model\Field;

class SearchInfo implements \Libs\DataSource\Interfaces\SearchInfo
{
    /**
     * @var array
     */
    private array $where;
    private array $orderBy;
    private array $groupBy;

    /**
     * SearchInfo constructor.
     * @param array $list
     */
    public function __construct(array $list = [])
    {
        $this->setList($list);
    }

    /**
     * @param array $fieldList
     * @return $this|\Libs\DataSource\Interfaces\SearchInfo
     */
    function setList(array $fieldList): \Libs\DataSource\Interfaces\SearchInfo
    {
        foreach ($fieldList as $item) {
            $this->addList($item);
        }
        return $this;
    }

    function addList(Field $field): \Libs\DataSource\Interfaces\SearchInfo
    {
        switch ($field->getType()) {
            case FieldTypeEnum::WHERE:
                $this->where[] = $field;
                break;
            case FieldTypeEnum::GROUP:
                $this->groupBy[] = $field->getCompile();
                break;
            case FieldTypeEnum::SORT:
                $this->orderBy[] = $field->getCompile();
                break;
        }
        return $this;
    }

    function equal(string $field, $v): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->where[] = new Field(FieldTypeEnum::FIELD, $field, $v, false, $field . " = ?");
        return $this;
    }

    function noEqual(string $field, $v): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->where[] = new Field(FieldTypeEnum::FIELD, $field, $v, false, $field . " != ?");
        return $this;
    }

    function greater(string $field, $v): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->where[] = new Field(FieldTypeEnum::FIELD, $field, $v, false, $field . " > ?");
        return $this;
    }

    function less(string $field, $v): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->where[] = new Field(FieldTypeEnum::FIELD, $field, $v, false, $field . " < ?");
        return $this;
    }

    function like(string $field, $v): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->where[] = new Field(FieldTypeEnum::FIELD, $field, $v, false, $field . " like ?");
        return $this;
    }

    function in(string $field, $v): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->where[] = new Field(FieldTypeEnum::FIELD, $field, $v, false, $field . " in (?)");
        return $this;
    }

    function notIn(string $field, $v): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->where[] = new Field(FieldTypeEnum::FIELD, $field, $v, false, $field . " not In (?)");
        return $this;
    }

    function addOrderByList(string $name, bool $sort)
    {
        if ($sort) {
            $this->orderBy[] = $name . " asc";
        } else {
            $this->orderBy[] = $name . " desc";
        }
    }

    function setOrderByList(array $orderBy): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    function getOrderByList(): array
    {
        return $this->orderBy;
    }

    function addGroupByList(string $name)
    {
        $this->groupBy[] = $name;
    }

    function setGroupByList(array $orderBy): \Libs\DataSource\Interfaces\SearchInfo
    {
        $this->groupBy = $orderBy;
        return $this;
    }

    function getGroupByList(): array
    {
        return $this->groupBy;
    }

    function execute(): array
    {
        $sql = "";
        $valueList = [];
        $compileList = [];

        if (!empty($this->where) && count($this->where) > 0) {
            $sql .= " where ";
            foreach ($this->where as $item) {
                if (!$item->isCompileType()) {
                    $valueList[] = $item->getValue();
                }
                $compileList[] = $item->GetCompile();
            }
        }
        $sql .= implode(" and ", $compileList);

        if (!empty($this->groupBy) && count($this->groupBy) > 0) {
            $sql += implode(" , ", $this->groupBy);
        }
        if (!empty($this->orderBy) && count($this->orderBy) > 0) {
            $sql += implode(" , ", $this->orderBy);
        }

        return [$sql, $valueList];
    }
}