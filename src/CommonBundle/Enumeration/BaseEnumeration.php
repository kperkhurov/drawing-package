<?php

namespace CommonBundle\Enumeration;

abstract class BaseEnumeration
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string[]
     */
    protected $names = [];

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    final public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    final public function getName(): string
    {
        return $this->names[$this->getValue()] ?? 'undefined value name';
    }
}
