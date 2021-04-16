<?php


namespace Libs\DataSource\Interfaces;


interface Field
{
    /**
     * @return int
     */
    public function getType(): int;

    /**
     * @param int $type
     * @return Field
     */
    public function setType(int $type): Field;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return Field
     */
    public function setName(string $name): Field;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     * @return Field
     */
    public function setValue($value): Field;

    /**
     * @return bool
     */
    public function isCompileType(): bool;

    /**
     * @param bool $compileType
     * @return Field
     */
    public function setCompileType(bool $compileType): Field;

    /**
     * @return string
     */
    public function getCompile(): string;

    /**
     * @param string $compile
     * @return Field
     */
    public function setCompile(string $compile): Field;

}