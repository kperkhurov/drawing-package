<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto\Response;

use CommonBundle\Dto\ApiResponseInterface;
use CommonBundle\Dto\SuccessfulApiResponse;

class Response implements ApiResponseInterface
{
    use SuccessfulApiResponse;

    /**
     * @var string[]
     */
    private $drawingResult;

    /**
     * @return string[]
     */
    public function getDrawingResult(): array
    {
        return $this->drawingResult;
    }

    /**
     * @param string[] $drawingResult
     * @return $this
     */
    public function setDrawingResult(array $drawingResult)
    {
        $this->drawingResult = $drawingResult;
        return $this;
    }
}
