<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto;

use DrawingSdkPackageBundle\Operation\Enumeration\Widget;

class Ellipse implements WidgetInterface
{
    use CoordinateTrait, DiameterTrait;

    /**
     * {@inheritdoc}
     */
    public function type(): Widget
    {
        return Widget::ellipse();
    }
}
