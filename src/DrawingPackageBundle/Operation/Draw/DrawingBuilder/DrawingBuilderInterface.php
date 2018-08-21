<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use DrawingPackageBundle\Operation\Draw\DrawingBuilder\Exception\CouldNotBuildDrawingException;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;

interface DrawingBuilderInterface
{
    /**
     * @param WidgetInterface $widget
     * @return string
     * @throws CouldNotBuildDrawingException
     */
    public function build(WidgetInterface $widget): string;
}
