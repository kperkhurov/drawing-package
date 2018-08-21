<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use CommonBundle\Test\BaseAbstractTest;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Circle;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Rectangle;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;
use DrawingSdkPackageBundle\Operation\Enumeration\Widget;

final class MappableTest extends BaseAbstractTest
{
    /**
     * @test
     */
    public function build()
    {
        $builder = $this->createBuilder(1, new Rectangle());

        $actualResult = $builder->build(new Rectangle());

        self::assertEquals(Widget::RECTANGLE, $actualResult);
    }

    /**
     * @test
     * @expectedException \DrawingPackageBundle\Operation\Draw\DrawingBuilder\Exception\CouldNotBuildDrawingException
     * @expectedExceptionMessage Unsupported widget type 'circle'
     */
    public function buildException()
    {
        $builder = $this->createBuilder(0, new Circle());

        $builder->build(new Circle());
    }

    /**
     * @param int $callCount
     * @param WidgetInterface $widget
     * @return Mappable
     */
    private function createBuilder(int $callCount, WidgetInterface $widget): Mappable
    {
        return
            new Mappable(
                $this->getDrawingBuilderMockList($callCount, $widget),
                $this->logger
            );
    }

    /**
     * @param int $callCount
     * @param WidgetInterface $widget
     * @return DrawingBuilderInterface[]
     */
    private function getDrawingBuilderMockList(int $callCount, WidgetInterface $widget): array
    {
        return
            [
                Widget::RECTANGLE => $this->createDrawingBuilderMock($callCount, $widget),
            ];
    }

    /**
     * @param int $callCount
     * @param WidgetInterface $widget
     * @return DrawingBuilderInterface
     */
    private function createDrawingBuilderMock(int $callCount, WidgetInterface $widget): DrawingBuilderInterface
    {
        $mock = $this->createMock(DrawingBuilderInterface::class);

        $mock
            ->expects($this->exactly($callCount))
            ->method('build')
            ->with(self::equalTo($widget))
            ->willReturn($widget->type()->getValue())
        ;

        return $mock;
    }
}
