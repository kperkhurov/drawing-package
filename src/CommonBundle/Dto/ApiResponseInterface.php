<?php

namespace CommonBundle\Dto;

use CommonBundle\Enumeration\ApiResponseType;

interface ApiResponseInterface
{
    /**
     * @return ApiResponseType
     */
    public function obtainType();
}
