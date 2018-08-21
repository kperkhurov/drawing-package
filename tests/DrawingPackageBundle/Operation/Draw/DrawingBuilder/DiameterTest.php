<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use CommonBundle\Test\BaseAbstractTest;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Ellipse;

final class DiameterTest extends BaseAbstractTest
{
    /**
     * @test
     */
    public function build()
    {
        $builder = $this->createDiameter();

        $actualResult = $builder->build($this->createEllipse());

        self::assertEquals($this->getExpectedResult(), $actualResult);
    }

    /**
     * @return Diameter
     */
    private function createDiameter(): Diameter
    {
        return new Diameter();
    }

    /**
     * @return Ellipse
     */
    private function createEllipse(): Ellipse
    {
        return
            (new Ellipse())
                ->setHorizontal(12)
                ->setVertical(14)
                ->setX(2)
                ->setY(2)
            ;
    }

    /**
     * @return string
     */
    private function getExpectedResult(): string
    {
        return 'Ellipse (2,2) diameterH=12 diameterV=14';
    }
}
