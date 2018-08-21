<?php

namespace CommonBundle\Enumeration;

class ApiResponseType extends BaseEnumeration
{
    const SUCCESSFUL = 1;

    const ERRONEOUS = 2;

    const EXCEPTIONAL = 3;

    protected $names = [
        self::SUCCESSFUL => 'Successful',
        self::ERRONEOUS => 'Erroneous',
        self::EXCEPTIONAL => 'Exceptional',
    ];

    /**
     * @return ApiResponseType
     */
    public static function successful()
    {
        return new self(self::SUCCESSFUL);
    }

    /**
     * @return ApiResponseType
     */
    public static function erroneous()
    {
        return new self(self::ERRONEOUS);
    }

    /**
     * @return ApiResponseType
     */
    public static function exceptional()
    {
        return new self(self::EXCEPTIONAL);
    }

    /**
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getValue() == self::SUCCESSFUL;
    }

    /**
     * @return boolean
     */
    public function isErroneous()
    {
        return $this->getValue() == self::ERRONEOUS;
    }

    /**
     * @return boolean
     */
    public function isExceptional()
    {
        return $this->getValue() == self::EXCEPTIONAL;
    }
}
