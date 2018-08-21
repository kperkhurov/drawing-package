<?php

namespace CommonBundle\Dto;

use CommonBundle\Enumeration\ApiResponseType;
use Throwable;

class ExceptionalApiResponse implements ApiResponseInterface
{
    /**
     * @var Throwable
     */
    private $exception;

    /**
     * @return Throwable
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Throwable $exception
     * @return static
     */
    public function setException(Throwable $exception)
    {
        $this->exception = $exception;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function obtainType()
    {
        return ApiResponseType::exceptional();
    }
}
