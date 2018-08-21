<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;

abstract class Base implements DrawingBuilderInterface
{
    /**
     * {@inheritdoc}
     */
    public function build(WidgetInterface $widget): string
    {
        return
            strtr(
                "{widget} ({x},{y}) {characteristics}",
                [
                    '{widget}' => $widget->type()->getName(),
                    '{x}' => $widget->getX(),
                    '{y}' => $widget->getY(),
                    '{characteristics}' => $this->getCharacteristics($widget),
                ]
            );
    }

    /**
     * @param WidgetInterface $widget
     * @return string
     */
    abstract protected function getCharacteristics(WidgetInterface $widget): string;
}
