<?php


namespace Libs\DataSource\Model;

class Field implements \Libs\DataSource\Interfaces\Field
{
    private int $type;
    private string $name;
    private $value;
    private bool $compileType;
    private string $compile;

    /**
     * Field constructor.
     * @param int $type
     * @param string $name
     * @param $value
     * @param bool $compileType
     * @param string $compile
     */
    public function __construct(int $type, string $name, $value, bool $compileType, string $compile)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->compileType = $compileType;
        $this->compile = $compile;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return \Libs\DataSource\Interfaces\Field
     */
    public function setType(int $type): \Libs\DataSource\Interfaces\Field
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return \Libs\DataSource\Interfaces\Field
     */
    public function setName(string $name): \Libs\DataSource\Interfaces\Field
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return \Libs\DataSource\Interfaces\Field
     */
    public function setValue($value): \Libs\DataSource\Interfaces\Field
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCompileType(): bool
    {
        return $this->compileType;
    }

    /**
     * @param bool $compileType
     * @return \Libs\DataSource\Interfaces\Field
     */
    public function setCompileType(bool $compileType): \Libs\DataSource\Interfaces\Field
    {
        $this->compileType = $compileType;
    }

    /**
     * @return string
     */
    public function getCompile(): string
    {
        return $this->compile;
    }

    /**
     * @param string $compile
     * @return \Libs\DataSource\Interfaces\Field
     */
    public function setCompile(string $compile): \Libs\DataSource\Interfaces\Field
    {
        $this->compile = $compile;
        return $this;
    }
}