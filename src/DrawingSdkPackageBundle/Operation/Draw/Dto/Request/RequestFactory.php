<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto\Request;

use CommonBundle\Dto\ApiRequestFactoryInterface;
use CommonBundle\Dto\Type\EmptyObjectType;

final class RequestFactory implements ApiRequestFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createRequest()
    {
        return new Request();
    }

    /**
     * {@inheritdoc}
     */
    public function createRequestFormType()
    {
        return EmptyObjectType::class;
    }
}
