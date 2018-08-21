<?php

namespace DrawingPackageBundle\Operation\Draw\DrawingBuilder;

use DrawingPackageBundle\Operation\Draw\DrawingBuilder\Exception\CouldNotBuildDrawingException;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

final class Mappable implements DrawingBuilderInterface
{
    use LoggerAwareTrait;

    /**
     * @var DrawingBuilderInterface[]
     */
    private $widgetBuilderMap = [];

    /**
     * @param DrawingBuilderInterface[] $widgetBuilderMap
     * @param LoggerInterface $logger
     */
    public function __construct(array $widgetBuilderMap, LoggerInterface $logger)
    {
        $this->setLogger($logger);

        $this->widgetBuilderMap = $widgetBuilderMap;
    }

    /**
     * {@inheritdoc}
     */
    public function build(WidgetInterface $widget): string
    {
        $widgetType = $widget->type()->getValue();

        $builder = $this->widgetBuilderMap[$widgetType] ?? null;

        if (null === $builder) {
            $this->logger->error($this->getErrorMessage($widgetType));
            throw new CouldNotBuildDrawingException($this->getErrorMessage($widgetType));
        }

        return $builder->build($widget);
    }

    /**
     * @param string $widgetType
     * @return string
     */
    private function getErrorMessage(string $widgetType): string
    {
        return sprintf("Unsupported widget type '%s'", $widgetType);
    }
}
