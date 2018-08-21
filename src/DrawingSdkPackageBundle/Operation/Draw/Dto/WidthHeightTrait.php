<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

trait WidthHeightTrait
{
    /**
     * @var int
     *
     * @Assert\NotNull()
     * @Assert\Type("int")
     *
     * @Serializer\Type("int")
     */
    private $width;

    /**
     * @var int
     *
     * @Assert\NotNull()
     * @Assert\Type("int")
     *
     * @Serializer\Type("int")
     */
    private $height;

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight(int $height)
    {
        $this->height = $height;

        return $this;
    }
}