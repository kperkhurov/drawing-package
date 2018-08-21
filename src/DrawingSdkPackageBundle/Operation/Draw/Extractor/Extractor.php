<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Extractor;

use CommonBundle\Extractor\ExtractorInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

final class Extractor implements ExtractorInterface
{
    use LoggerAwareTrait;

    /**
     * @var string[]
     */
    private $widgetList;

    /**
     * @param string[] $widgetList
     * @param LoggerInterface $logger
     */
    public function __construct(array $widgetList, LoggerInterface $logger)
    {
        $this->setLogger($logger);

        $this->widgetList = $widgetList;
    }

    /**
     * @inheritDoc
     */
    public function extract(array $data): array
    {
        $list = [];

        foreach ($this->widgetList as $widget) {
            $widgetParams = $data[$widget] ?? null;

            if (null !== $widgetParams && stristr($widgetParams, ',') && stristr($widgetParams, '=')) {
                $list[$widget] = $this->extractParameters($widgetParams);
            } else {
                $this->logger->error(sprintf("Unsupported widget type '%s'", $widget));
            }
        }

        return $list;
    }

    /**
     * @param string $extractable
     * @return string[]
     */
    private function extractParameters(string $extractable): array
    {
        $list = [];

        foreach (explode(',', $extractable) as $parameters) {
            list($name, $val) = explode('=', $parameters);

            $list[trim($name)] = trim($val);
        }

        return $list;
    }
}
