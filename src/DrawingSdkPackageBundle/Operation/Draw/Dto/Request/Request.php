<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto\Request;

use CommonBundle\Dto\ApiRequestInterface;
use DrawingSdkPackageBundle\Operation\Draw\Dto\WidgetInterface;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Request implements ApiRequestInterface
{
    /**
     * @var WidgetInterface[]
     *
     * @Assert\NotBlank()
     * @Assert\Type("array")
     *
     * @Serializer\Type("array")
     */
    private $widgetList = [];

    /**
     * @return WidgetInterface[]
     */
    public function getWidgetList(): array
    {
        return $this->widgetList;
    }

    /**
     * @param WidgetInterface[] $widgetList
     * @return $this
     */
    public function setWidgetList(array $widgetList)
    {
        $this->widgetList = $widgetList;
        return $this;
    }
}
