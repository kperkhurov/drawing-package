<?php

namespace DrawingPackageBundle\Operation\Draw\Service;

use CommonBundle\Service\ServiceInterface;
use CommonBundle\Test\BaseAbstractTest;
use DrawingPackageBundle\Operation\Draw\DrawingBuilder\DrawingBuilderInterface;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Circle;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Ellipse;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Rectangle;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Request\Request;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Response\Response;
use DrawingSdkPackageBundle\Operation\Enumeration\Widget;

final class ServiceTest extends BaseAbstractTest
{
    /**
     * @test
     */
    public function behave()
    {
        $service = $this->createService();

        $response = $service->behave($this->createRequest());

        self::assertEquals($this->getExpectedResult(), $response);
    }

    /**
     * @return ServiceInterface
     */
    private function createService(): ServiceInterface
    {
        return new Service($this->createSerializerMock());
    }

    /**
     * @return DrawingBuilderInterface
     */
    private function createSerializerMock(): DrawingBuilderInterface
    {
        $mock = $this->createMock(DrawingBuilderInterface::class);

        $mock
            ->expects($this->exactly(3))
            ->method('build')
            ->withConsecutive(
                [new Circle()],
                [new Ellipse()],
                [new Rectangle()]
            )
            ->willReturnOnConsecutiveCalls(Widget::CIRCLE, Widget::ELLIPSE, Widget::RECTANGLE)
        ;

        return $mock;
    }

    /**
     * @return Request
     */
    private function createRequest(): Request
    {
        return
            (new Request())
                ->setWidgetList(
                    [
                        new Circle(),
                        new Ellipse(),
                        new Rectangle(),
                    ]
                );
    }

    /**
     * @return Response
     */
    private function getExpectedResult(): Response
    {
        return
            (new Response())
                ->setDrawingResult(
                    [
                        Widget::CIRCLE,
                        Widget::ELLIPSE,
                        Widget::RECTANGLE
                    ]
                );
    }
}
