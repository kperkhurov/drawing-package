<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use DrawingSdkPackageBundle\Operation\Draw\Dto\SizeTrait;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;

final class Size extends Base
{
    /**
     * {@inheritdoc}
     * @param SizeTrait $widget
     */
    protected function getCharacteristics(WidgetInterface $widget): string
    {
        return strtr("size={size}", ['{size}' => $widget->getSize()]);
    }
}
