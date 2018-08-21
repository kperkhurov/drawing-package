<?php

namespace DrawingSdkPackageBundle\Operation\Draw\RequestBuilder;

use CommonBundle\Dto\Type\EmptyObjectType;
use CommonBundle\ObjectBuilder\ObjectBuilderInterface;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Request\Request;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;

final class RequestBuilder implements ObjectBuilderInterface
{
    /**
     * @var WidgetInterface[]
     */
    private $widgetList;

    /**
     * @var ObjectBuilderInterface
     */
    private $objectBuilder;

    /**
     * @param WidgetInterface[] $rectangles
     * @param ObjectBuilderInterface $objectBuilder
     */
    public function __construct(array $rectangles, ObjectBuilderInterface $objectBuilder)
    {
        $this->widgetList = $rectangles;
        $this->objectBuilder = $objectBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function build($object, $objectFormType, array $data)
    {
        return (new Request())->setWidgetList($this->getWidgetList($data));
    }

    /**
     * @param WidgetInterface[] $data
     * @return WidgetInterface[]
     */
    private function getWidgetList(array $data): array
    {
        $list = [];

        foreach ($data as $name => $parameters) {
            $widget = $this->widgetList[$name] ?? null;

            if (null !== $widget) {
                $list[] = $this->objectBuilder->build($widget, new EmptyObjectType(), $parameters);
            }
        }

        return $list;
    }
}
