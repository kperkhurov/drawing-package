<?php

namespace DrawingSdkPackageBundle\Operation\Enumeration;

use CommonBundle\Enumeration\BaseEnumeration;

class Widget extends BaseEnumeration
{
    const RECTANGLE = 'rectangle';

    const SQUARE = 'square';

    const ELLIPSE = 'ellipse';

    const CIRCLE = 'circle';

    protected $names = [
        self::RECTANGLE => 'Rectangle',
        self::SQUARE => 'Square',
        self::ELLIPSE => 'Ellipse',
        self::CIRCLE => 'Circle',
    ];

    /**
     * @return Widget
     */
    public static function rectangle()
    {
        return new self(self::RECTANGLE);
    }

    /**
     * @return Widget
     */
    public static function square()
    {
        return new self(self::SQUARE);
    }

    /**
     * @return Widget
     */
    public static function ellipse()
    {
        return new self(self::ELLIPSE);
    }

    /**
     * @return Widget
     */
    public static function circle()
    {
        return new self(self::CIRCLE);
    }
}
