<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto;

use DrawingSdkPackageBundle\Operation\Enumeration\Widget;

class Circle implements WidgetInterface
{
    use CoordinateTrait, SizeTrait;

    /**
     * {@inheritdoc}
     */
    public function type(): Widget
    {
        return Widget::circle();
    }
}
