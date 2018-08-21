<?php

namespace CommonBundle\ObjectBuilder;

use JMS\Serializer\ArrayTransformerInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Throwable;

final class ObjectBuilder implements ObjectBuilderInterface
{
    use LoggerAwareTrait;

    /**
     * @var ArrayTransformerInterface
     */
    private $arrayTransformer;

    /**
     * @param ArrayTransformerInterface $arrayTransformer
     * @param LoggerInterface $logger
     */
    public function __construct(ArrayTransformerInterface $arrayTransformer, LoggerInterface $logger)
    {
        $this->setLogger($logger);

        $this->arrayTransformer = $arrayTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function build($object, $objectFormType, array $data)
    {
        try {
            return $this->arrayTransformer->fromArray($data, get_class($object));
        } catch (Throwable $e) {
            $this->logger->warning(
                "Could not build object with '{error}'",
                ['exception' => $e, 'error' => $e->getMessage()]
            );

            return $object;
        }
    }
}
