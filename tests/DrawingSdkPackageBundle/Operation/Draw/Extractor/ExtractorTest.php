<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Extractor;

use CommonBundle\Test\BaseAbstractTest;
use DrawingSdkPackageBundle\Operation\Enumeration\Widget;

final class ExtractorTest extends BaseAbstractTest
{
    /**
     * @test
     */
    public function extract()
    {
        $extractor = $this->createExtractor();

        $actualResult = $extractor->extract($this->getWidgetsList());

        self::assertEquals($this->getExpectedResult(), $actualResult);
    }

    /**
     * @return Extractor
     */
    private function createExtractor(): Extractor
    {
        return new Extractor($this->getAllowedWidgetList(), $this->logger);
    }

    /**
     * @return string[]
     */
    private function getWidgetsList(): array
    {
        return
            [
                Widget::RECTANGLE => 'x=20, y=20, width=30, height=40',
                Widget::SQUARE => 'x=15, y=30, size=35',
                Widget::CIRCLE => '',
                Widget::ELLIPSE => '',
            ];
    }

    /**
     * @return string[]
     */
    private function getAllowedWidgetList(): array
    {
        return [Widget::RECTANGLE, Widget::SQUARE, Widget::CIRCLE];
    }

    /**
     * @return mixed[]
     */
    private function getExpectedResult(): array
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
                ]
            ];
    }
}
