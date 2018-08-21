<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Extractor;

use CommonBundle\Extractor\ExtractorInterface;

final class Extractor implements ExtractorInterface
{
    /**
     * @var string[]
     */
    private $rectangles;

    /**
     * @param string[] $rectangles
     */
    public function __construct(array $rectangles)
    {
        $this->rectangles = $rectangles;
    }

    /**
     * @inheritDoc
     */
    public function extract(array $data): array
    {
        $list = [];

        foreach ($this->rectangles as $rectangle) {
            $rectangleParams = $data[$rectangle] ?? null;

            if (null !== $rectangleParams) {
                $list[$rectangle] = $this->extractParameters($rectangleParams);
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
            foreach (explode(',', $parameters) as $parameter) {
                list($name, $val) = explode('=', $parameter);

                $list[trim($name)] = trim($val);
            }
        }

        return $list;
    }
}
