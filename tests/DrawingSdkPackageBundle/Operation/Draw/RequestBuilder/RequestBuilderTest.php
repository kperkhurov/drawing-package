<?php

namespace DrawingSdkPackageBundle\Operation\Draw\RequestBuilder;

use CommonBundle\Dto\Type\EmptyObjectType;
use CommonBundle\ObjectBuilder\ObjectBuilderInterface;
use CommonBundle\Test\BaseAbstractTest;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Rectangle;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Request\Request;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Square;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;
use DrawingSdkPackageBundle\Operation\Enumeration\Widget;

final class RequestBuilderTest extends BaseAbstractTest
{
    /**
     * @test
     */
    public function build()
    {
        $builder = $this->createRequestBuilder();

        $actualResult = $builder->build('', '', $this->getWidgetParametersList());

        self::assertEquals($this->createExpectedResult(), $actualResult);
    }

    /**
     * @return RequestBuilder
     */
    private function createRequestBuilder(): RequestBuilder
    {
        return new RequestBuilder($this->getAllowedWidgetList(), $this->createObjectBuilderMock());
    }

    /**
     * @return ObjectBuilderInterface
     */
    private function createObjectBuilderMock(): ObjectBuilderInterface
    {
        $mock = $this->createMock(ObjectBuilderInterface::class);

        $mock
            ->expects($this->exactly(2))
            ->method('build')
            ->withConsecutive(
                [new Rectangle(), new EmptyObjectType(), $this->getWidgetParametersList()[Widget::RECTANGLE]],
                [new Square(), new EmptyObjectType(), $this->getWidgetParametersList()[Widget::SQUARE]]
            )
            ->willReturnOnConsecutiveCalls($this->getWidgetList()[0], $this->getWidgetList()[1])
        ;

        return $mock;
    }

    /**
     * @return mixed[]
     */
    private function getWidgetParametersList(): array
    {
        return
            [
                Widget::RECTANGLE => [
                    'x' => 20,
                    'y' => 20,
                    'width' => 30,
                    'height' => 40,
                ],
                Widget::SQUARE => [
                    'x' => 15,
                    'y' => 30,
                    'size' => 35,
                ],
                Widget::CIRCLE => [
                    'width' => 30,
                    'height' => 40,
                    'size' => 35,
                ],
            ];
    }

    /**
     * @return string[]
     */
    private function getAllowedWidgetList(): array
    {
        return [
            Widget::RECTANGLE => new Rectangle(),
            Widget::SQUARE => new Square(),
        ];
    }

    /**
     * @return Request
     */
    private function createExpectedResult(): Request
    {
        return (new Request())->setWidgetList($this->getWidgetList());
    }

    /**
     * @return WidgetInterface[]
     */
    private function getWidgetList(): array
    {
        return
            [
                (new Rectangle())
                    ->setY(20)
                    ->setX(20)
                    ->setWidth(30)
                    ->setHeight(40)
                ,
                (new Square())
                    ->setY(15)
                    ->setX(30)
                    ->setSize(35)
                ,
            ];
    }
}
