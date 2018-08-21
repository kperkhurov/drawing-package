<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidthHeightTrait;

final class WidthHeight extends Base
{
    /**
     * {@inheritdoc}
     * @param WidthHeightTrait $widget
     */
    protected function getCharacteristics(WidgetInterface $widget): string
    {
        return
            strtr(
                "width={width} height={height}",
                [
                    '{width}' => $widget->getWidth(),
                    '{height}' => $widget->getHeight(),
                ]
            );
    }
}
