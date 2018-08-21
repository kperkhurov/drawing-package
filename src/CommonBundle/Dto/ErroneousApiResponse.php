<?php

namespace CommonBundle\Dto;

use CommonBundle\Enumeration\ApiResponseType;

trait ErroneousApiResponse
{
    /**
     * @return ApiResponseType
     */
    public function obtainType()
    {
        return ApiResponseType::erroneous();
    }
}
