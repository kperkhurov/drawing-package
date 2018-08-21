<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use DrawingSdkPackageBundle\Operation\Draw\Dto\DiameterTrait;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;

final class Diameter extends Base
{
    /**
     * {@inheritdoc}
     * @param DiameterTrait $widget
     */
    protected function getCharacteristics(WidgetInterface $widget): string
    {
        return
            strtr(
                "diameterH={horizontal} diameterV={vertical}",
                [
                    '{horizontal}' => $widget->getHorizontal(),
                    '{vertical}' => $widget->getVertical(),
                ]
            );
    }
}
