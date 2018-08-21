<?php

namespace DrawingPackageBundle\Operation\Draw\Service;

use CommonBundle\Dto\ApiRequestInterface;
use CommonBundle\Dto\ApiResponseInterface;
use CommonBundle\Service\ServiceInterface;
use DrawingPackageBundle\Operation\Draw\DrawingBuilder\DrawingBuilderInterface;
use DrawingPackageBundle\Operation\Draw\DrawingBuilder\Exception\CouldNotBuildDrawingException;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Request\Request;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Response\Response;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;

final class Service implements ServiceInterface
{
    /**
     * @var DrawingBuilderInterface
     */
    private $drawingBuilder;

    /**
     * @param DrawingBuilderInterface $drawingBuilder
     */
    public function __construct(DrawingBuilderInterface $drawingBuilder)
    {
        $this->drawingBuilder = $drawingBuilder;
    }

    /**
     * {@inheritdoc}
     * @param Request $request
     */
    public function behave(ApiRequestInterface $request): ApiResponseInterface
    {
        return (new Response())->setDrawingResult($this->getDrawingResult($request));
    }

    /**
     * @param Request $request
     * @return string[]
     * @throws CouldNotBuildDrawingException
     */
    private function getDrawingResult(Request $request): array
    {
        return
            array_map(
                function (WidgetInterface $widget) {
                    return $this->drawingBuilder->build($widget);
                },
                $request->getWidgetList()
            );
    }
}
