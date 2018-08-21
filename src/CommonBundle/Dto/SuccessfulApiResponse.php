<?php

namespace CommonBundle\Dto;

use CommonBundle\Enumeration\ApiResponseType;

trait SuccessfulApiResponse
{
    /**
     * @return ApiResponseType
     */
    public function obtainType()
    {
        return ApiResponseType::successful();
    }
}
