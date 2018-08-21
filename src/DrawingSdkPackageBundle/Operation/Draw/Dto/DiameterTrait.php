<?php

namespace DrawingSdkPackageBundle\Operation\Draw\Dto;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

trait DiameterTrait
{
    /**
     * @var int
     *
     * @Assert\NotNull()
     * @Assert\Type("int")
     *
     * @Serializer\Type("int")
     */
    private $horizontal;

    /**
     * @var int
     *
     * @Assert\NotNull()
     * @Assert\Type("int")
     *
     * @Serializer\Type("int")
     */
    private $vertical;

    /**
     * @return int
     */
    public function getHorizontal(): int
    {
        return $this->horizontal;
    }

    /**
     * @param int $horizontal
     * @return $this
     */
    public function setHorizontal(int $horizontal)
    {
        $this->horizontal = $horizontal;
        return $this;
    }

    /**
     * @return int
     */
    public function getVertical(): int
    {
        return $this->vertical;
    }

    /**
     * @param int $vertical
     * @return $this
     */
    public function setVertical(int $vertical)
    {
        $this->vertical = $vertical;
        return $this;
    }
}
