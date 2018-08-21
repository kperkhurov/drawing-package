<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use CommonBundle\Test\BaseAbstractTest;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Circle;

final class SizeTest extends BaseAbstractTest
{
    /**
     * @test
     */
    public function build()
    {
        $builder = $this->createSize();

        $actualResult = $builder->build($this->createCircle());

        self::assertEquals($this->getExpectedResult(), $actualResult);
    }

    /**
     * @return Size
     */
    private function createSize(): Size
    {
        return new Size();
    }

    /**
     * @return Circle
     */
    private function createCircle(): Circle
    {
        return
            (new Circle())
                ->setX(2)
                ->setY(2)
                ->setSize(4)
            ;
    }

    /**
     * @return string
     */
    private function getExpectedResult(): string
    {
        return 'Circle (2,2) size=4';
    }
}
