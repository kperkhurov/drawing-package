<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

trait CoordinateTrait
{
    /**
     * @var int
     *
     * @Assert\NotNull()
     * @Assert\Type("int")
     *
     * @Serializer\Type("int")
     */
    private $x;

    /**
     * @var int
     *
     * @Assert\NotNull()
     * @Assert\Type("int")
     *
     * @Serializer\Type("int")
     */
    private $y;

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     * @return $this
     */
    public function setX(int $x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     * @return $this
     */
    public function setY(int $y)
    {
        $this->y = $y;

        return $this;
    }
}