<?php

namespace CommonBundle\Dto;

interface ApiRequestFactoryInterface
{
    /**
     * @return ApiRequestInterface
     */
    public function createRequest();

    /**
     * @return string
     */
    public function createRequestFormType();
}
