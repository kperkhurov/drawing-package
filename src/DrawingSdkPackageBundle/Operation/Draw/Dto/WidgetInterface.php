<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto;

use DrawingSdkPackageBundle\Operation\Enumeration\Widget;

interface WidgetInterface
{
    /**
     * @return int
     */
    public function getX(): int;

    /**
     * @return int
     */
    public function getY(): int;

    /**
     * @return Widget
     */
    public function type(): Widget;
}
