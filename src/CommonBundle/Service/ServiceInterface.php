<?php

namespace CommonBundle\Service;

use CommonBundle\Dto\ApiRequestInterface;
use CommonBundle\Dto\ApiResponseInterface;
use Exception;

interface ServiceInterface
{
    /**
     * @param ApiRequestInterface $request
     * @return ApiResponseInterface
     * @throws Exception
     */
    public function behave(ApiRequestInterface $request): ApiResponseInterface;
}
