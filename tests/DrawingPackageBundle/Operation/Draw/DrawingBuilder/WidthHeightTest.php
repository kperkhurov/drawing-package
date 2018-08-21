<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use CommonBundle\Test\BaseAbstractTest;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Rectangle;

final class WidthHeightTest extends BaseAbstractTest
{
    /**
     * @test
     */
    public function build()
    {
        $builder = $this->createBuilder();

        $actualResult = $builder->build($this->createRectangle());

        self::assertEquals($this->getExpectedResult(), $actualResult);
    }

    /**
     * @return WidthHeight
     */
    private function createBuilder(): WidthHeight
    {
        return new WidthHeight();
    }

    /**
     * @return Rectangle
     */
    private function createRectangle(): Rectangle
    {
        return
            (new Rectangle())
                ->setX(2)
                ->setY(2)
                ->setHeight(4)
                ->setWidth(4)
            ;
    }

    /**
     * @return string
     */
    private function getExpectedResult(): string
    {
        return 'Rectangle (2,2) width=4 height=4';
    }
}
