<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto;

use DrawingSdkPackageBundle\Operation\Enumeration\Widget;

class Rectangle implements WidgetInterface
{
    use CoordinateTrait, WidthHeightTrait;

    /**
     * {@inheritdoc}
     */
    public function type(): Widget
    {
        return Widget::rectangle();
    }
}
